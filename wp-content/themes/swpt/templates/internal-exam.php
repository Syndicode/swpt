<?php get_header();
//$current_user        = wp_get_current_user();
if ( $current_user->exists() && ( current_user_can( 'take_course' ) || current_user_can( 'manage_options' ) ) ) :?>
	<?php
	$groups = get_posts( array(
		'numberposts' => - 1,
		'post_type'   => 'group',
	) );

	$is_access_enabled = current_user_can( 'manage_options' );
	$user_group        = null;
	foreach ( $groups as $group ) :
		$members = get_field( 'members', $group->ID );
		if ( ! empty( $members ) && in_array( $current_user->ID, $members ) ):
			$is_access_enabled = get_field( 'is_access_enabled', $group->ID );
		endif;
	endforeach; ?>

	<?php if ( $is_access_enabled ) : ?>

		<?php
		$count_questions = 10;
		$time_out        = 1800;
		$questions       = [];
		$is_time_out     = false;
		$user_exam_state = get_user_meta( $current_user->ID, 'user_exam_state', true ) ?: array();

		// Fallback for old users
		if ( empty( $user_exam_state ) ) :
			$user_exam_state = [
				'current_exam'          => [
					'questions'       => [],
					'timestamp_start' => ''
				],
				'best_result'           => 0,
				'best_result_date'      => '',
				'best_result_questions' => [],
				'count_passed'          => 0,
			];
		elseif ( ! isset( $user_exam_state['best_result_date'], $user_exam_state['best_result_questions'] ) ) :
			$user_exam_state['best_result_date']      = '';
			$user_exam_state['best_result_questions'] = [];
		endif;

		if ( ! empty( $user_exam_state['current_exam']['questions'] ) && time() - (int) $user_exam_state['current_exam']['timestamp_start'] < $time_out ) :
			$questions = get_posts( [
				'numberposts' => $count_questions,
				'post_type'   => 'question',
				'post__in'    => $user_exam_state['current_exam']['questions'],
			] );
		elseif ( ! empty( $user_exam_state['current_exam']['questions'] ) && time() - (int) $user_exam_state['current_exam']['timestamp_start'] >= $time_out ) :
			$is_time_out     = true;
			$user_exam_state = [
				'current_exam'          => [
					'questions'       => [],
					'timestamp_start' => ''
				],
				'best_result'           => $user_exam_state['best_result'],
				'best_result_date'      => $user_exam_state['best_result_date'],
				'best_result_questions' => $user_exam_state['best_result_questions'],
				'count_passed'          => $user_exam_state['count_passed'] + 1,
			];
			update_user_meta( $current_user->ID, 'user_exam_state', $user_exam_state );
		elseif ( empty( $user_exam_state['current_exam']['questions'] ) ) :
			$questions       = get_posts( [
				'numberposts' => $count_questions,
				'post_type'   => 'question',
				'order'       => 'ASC',
				'orderby'     => 'rand',
			] );
			$user_exam_state = [
				'current_exam'          => [
					'questions'       => array_map( fn( $question ): int => $question->ID, $questions ),
					'timestamp_start' => time(),
				],
				'best_result'           => $user_exam_state['best_result'],
				'best_result_date'      => $user_exam_state['best_result_date'],
				'best_result_questions' => $user_exam_state['best_result_questions'],
				'count_passed'          => $user_exam_state['count_passed'],
			];
			update_user_meta( $current_user->ID, 'user_exam_state', $user_exam_state );
		endif; ?>

		<section id="sign-in" class="section section--mb-none hero hero--small hero--middle"
				 style="background-color: #fff;">
			<div class="hero__wrapper hero__wrapper--center">
				<h1 class="hero__heading heading heading--h2" style="color: #1995ad;">Внутрішній іспит</h1>
				<p class="caption"
				   style="color: #000;"><?= $current_user->first_name ?> <?= $current_user->last_name ?></p>
			</div>
		</section>

		<?php if ( $is_time_out ) : ?>
			<p class="caption" style="text-align: center">Час останньої спроби вийшов. Спробуйте ще раз.</p>
			<div class="section__cta-holder section__cta-holder--align-center"  style="margin-bottom: 60px;">
				<a href="/internal-exam/" class="button button--cyan" type="button">Перезапустити іспит</a>
			</div>
		<?php elseif ( ! empty( $questions ) ) : ?>
			<section class="section section--mb-standard">
				<div class="wrapper">
					<div class="questions">
						<div class="questions__response">
							<span class="questions__response-title">Ваш результат:</span> <span
								class="questions__response-value"></span>
						</div>
						<?php if ( ! empty( $user_exam_state['current_exam']['timestamp_start'] ) ) : ?>
							<div class="questions__timer" id="internal-exam-timer"
								 data-timestamp="<?= $user_exam_state['current_exam']['timestamp_start'] ?>">
							</div>
						<?php endif; ?>
						<form id="internal-exam" class="questions__form">
							<?php foreach ( $questions as $question ) :
								$answers = get_field( 'answers', $question->ID ); ?>
								<div class="questions__item">
									<?php if ( ! empty( $answers ) ) : ?>
										<h2 class="heading heading--simple questions__title"><?= $question->post_title; ?></h2>
										<div class="answers">
											<?php foreach ( $answers as $key => $answer ) : ?>
												<div class="answers__item">
													<label class="answers__label">
														<input type="radio" name="<?= $question->ID; ?>"
															   value="<?= $key; ?>">
														<span><?= $answer['text']; ?></span>
													</label>
												</div>
											<?php endforeach; ?>
										</div>
									<?php endif; ?>
								</div>
							<?php endforeach; ?>
							<?php wp_nonce_field( 'wp_rest' ); ?>
							<button class="button button--cyan questions__submit" type="submit">Здати на перевірку
							</button>
						</form>
						<p class="questions__note">Повернутись до <a href="/testing/">переліку Тестів</a></p>
					</div>
				</div>
			</section>
		<?php endif; ?>
	<?php else : ?>
		<?php $phones = school_get_acf_field( 'contacts_phones', 'option' ); ?>
		<section class="section section--with-bg">
			<div class="wrapper" style="min-height: 40vh; padding-top: 100px;">
				<h1 class="heading heading--h4" style="color: #1995ad">Ви не можете переглядати цю сторінку. </h1>
				<p class="caption">Для проходження тестування і внутрішнього екзамену, будь ласка, зверніться до
					адміністрації:</p>
				<p class="caption"><?php foreach ( $phones as $phone ): ?>
						<a href="tel:<?= str_replace( [ ' ', '-', '(', ')' ], '', $phone['phone'] ); ?>"
						   style="color: inherit; text-decoration: none"><?= $phone['phone']; ?></a><br>
					<?php endforeach; ?>
				</p>
			</div>
		</section>
	<?php endif; ?>
<?php endif; ?>
<div class="loader loader--light">
	<span class="loader__component"></span>
</div>
<?php get_footer(); ?>
