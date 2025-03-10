<?php $queried_object = get_queried_object();
if ( $queried_object instanceof WP_Term ) :
	if ( $queried_object->parent === 0 ) :
		wp_redirect( '/', 301 );
	endif; ?>
	<?php $current_user = wp_get_current_user();
	if ( $current_user->exists() && ( current_user_can( 'take_course' ) || current_user_can( 'manage_options' ) ) ) :
		get_header();
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
		endforeach;
		if ( $is_access_enabled ) : ?>

			<!--			<h1>--><?php //= $current_user->display_name; ?><!--</h1>-->
			<?php $parent_chapter = get_term( $queried_object->parent ); ?>
			<section id="chapter-<?= $queried_object->term_id; ?>"
					 class="section section--mb-none hero hero--small hero--middle"
					 style="background-color: #ffffff;">
				<div class="hero__wrapper hero__wrapper--center">
					<h1 class="hero__heading heading heading--h3"
						style="color: #1995ad;"><?= $parent_chapter->name; ?></h1>
					<p class="caption"><?= $queried_object->name; ?></p>
				</div>
			</section>
			<section class="section section--mb-standard">
				<div class="wrapper">
					<?php $questions = get_posts( array(
						'numberposts' => - 1,
						'post_type'   => 'question',
						'order'       => 'ASC',
						'tax_query'   => array(
							array(
								'taxonomy' => 'chapter',
								'field'    => 'id',
								'terms'    => $queried_object->term_id,
							),
						),
					) );

					if ( ! empty( $questions ) ) : ?>

						<div class="questions">
							<div class="questions__response">
								<span class="questions__response-title">Ваш результат:</span> <span
									class="questions__response-value"></span>
							</div>
							<form id="test" class="questions__form">
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
								<input type="hidden" name="option_id" value="<?= $queried_object->term_id; ?>">
								<button class="button button--cyan questions__submit" type="submit">Перевірити</button>
							</form>
							<p class="questions__note">Повернутись до <a href="/testing/">переліку Тестів</a></p>
						</div>
					<?php endif; ?>
				</div>
			</section>
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
	<?php else : ?>
		<?php wp_redirect( '/', 301 ); ?>
	<?php endif; ?>
<?php endif; ?>
<div class="loader loader--light">
	<span class="loader__component"></span>
</div>
<?php get_footer() ?>
