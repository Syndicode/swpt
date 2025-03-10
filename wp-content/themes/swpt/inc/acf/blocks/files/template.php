<?php
/**
 * Files Block Template.
 *
 * @var array $block The block settings and attributes.
 * @var string $content The block inner HTML (empty).
 * @var bool $is_preview True during backend preview render.
 * @var int $post_id The post ID the block is rendering content against.
 *          This is either the post ID currently being displayed inside a query loop,
 *          or the post ID of the post hosting this block.
 * @var array $context The context provided to the block by the post or it's parent block.
 */
$block_id             = ( isset( $block['anchor'] ) && ! empty( $block['anchor'] ) ) ? $block['anchor'] : $block['id'];
$is_visible           = school_get_acf_field( 'is_visible' );
$is_animation_enabled = school_get_acf_field( 'is_animation_enabled' );
$heading              = school_get_acf_field( 'heading' );
$heading_color        = school_get_acf_field( 'heading_color' );
$heading_level        = school_get_acf_field( 'heading_level' );
$heading_style        = school_get_acf_field( 'heading_style' );
$caption              = school_get_acf_field( 'caption' );
$caption_color        = school_get_acf_field( 'caption_color' );
$header_text_align    = school_get_acf_field( 'header_text_align' );
$show_gradient_layer  = school_get_acf_field( 'show_gradient_layer' );
$gradient_tone        = school_get_acf_field( 'gradient_tone' );
$gradient_direction   = school_get_acf_field( 'gradient_direction' );
$background_color     = school_get_acf_field( 'background_color' );
$background_image     = school_get_acf_field( 'background_image' );
$margin_bottom        = school_get_acf_field( 'margin_bottom' );
$cta                  = school_get_acf_field( 'cta' );
$cta_align            = school_get_acf_field( 'cta_align' );
$cta_style            = school_get_acf_field( 'cta_style' );
$files                = school_get_acf_field( 'files' );
$is_all_files_visible = school_get_acf_field( 'is_all_files_visible' );
$files_count          = school_get_acf_field( 'files_count' );

?>
<?php if ( $is_visible || $is_preview ) : ?>
	<!-- FILES start -->
	<section
		class="section section--mb-<?= $margin_bottom; ?>
		<?php if ( ! empty( $background_color ) ) : ?>section--with-bg<?php endif; ?> files
		<?php if ( ! $is_visible ) : ?>is-not-visible<?php endif; ?>
		<?php if ( ! $is_preview && $is_animation_enabled ) : ?>animate<?php endif; ?>"
		<?php if ( ! empty( $background_color ) ) : ?>style="background-color: <?= $background_color; ?>;"<?php endif; ?>>
		<?php if ( ! empty( $background_image ) ) :
			echo wp_get_attachment_image( $background_image['id'], 'full', false, array(
				'class' => 'section__background-image',
			) );
		endif; ?>
		<?php if ( $show_gradient_layer ): ?>
			<div class="gradient-layer"
				 style="background: linear-gradient(to <?= str_replace( '_', ' ', $gradient_direction ); ?>, <?= $gradient_tone; ?>, rgba(0,0,0,0) )"
				 aria-hidden="true"></div>
		<?php endif; ?>
		<div class="wrapper files__wrapper">
			<?php if ( ! empty( $heading ) || ! empty( $caption ) ) : ?>
				<header class="section__header section__header--align-<?= $header_text_align; ?>">
					<?php if ( ! empty( $heading ) ) : ?>
						<?= '<' . $heading_level . ' class="heading heading--' . $heading_style . '" style="color: ' . $heading_color . ';">' . $heading . '</' . $heading_level . '>'; ?>
					<?php endif; ?>
					<?php if ( ! empty( $caption ) ) : ?>
						<p class="caption" style="color: <?= $caption_color; ?>;">
							<?= $caption; ?>
						</p>
					<?php endif; ?>
				</header>
			<?php endif; ?>
			<?php if ( ! empty( $files ) ) : ?>
				<div class="files__list">
					<?php
					$index = 1;
					foreach ( $files as $file ) : ?>
						<div class="files__item-holder">
							<a href="<?= $file['file']['url']; ?>" target="_blank" class="files__item"
							   <?php if ( ! $is_all_files_visible && $index > $files_count ): ?>style="display: none;"<?php endif; ?>>
								<?php if ( ! empty( $file['title'] ) ) : ?>
									<span class="heading heading--h6 files__title"><?= $file['title']; ?></span>
								<?php endif; ?>
								<?php if ( ! empty( $file['caption'] ) ) : ?>
									<span class="files__caption"><?= $file['caption']; ?></span>
								<?php endif; ?>
								<?= get_template_part( 'template-parts/blocks/file-icon-type', null, array( 'type' => $file['type'] ) ); ?>
							</a>
						</div>
						<?php $index ++;
					endforeach; ?>
				</div>
				<?php if ( ! empty( $files ) && ! $is_all_files_visible && count( $files ) > $files_count ) : ?>
					<button class="files__toggle">Дивитись усі документи</button>
				<?php endif; ?>
			<?php endif; ?>
			<?php if ( ! empty( $cta ) ) : ?>
				<div class="section__cta-holder section__cta-holder--align-<?= $cta_align; ?>">
					<a href="<?= $cta['url']; ?>" target="<?= $cta['target']; ?>"
					   class="button button--<?= $cta_style; ?> section__cta">
						<?= $cta['title']; ?>
					</a>
				</div>
			<?php endif; ?>
		</div>
	</section>
	<!-- FILES end -->
<?php endif; ?>

<script>
	const filesToggle = document.querySelector('.files__toggle');
	if (filesToggle) {
		const files = document.querySelectorAll('.files__item');
		filesToggle.addEventListener('click', () => {
			files.forEach((file) => {
				file.style.display = 'flex';
			});
			filesToggle.style.display = 'none';
		});
	}
</script>
