<?php
/**
 * Entities Grid Block Template.
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
$gallery              = school_get_acf_field( 'gallery' );
$grid_full_width      = school_get_acf_field( 'grid_full_width' );
$grid_columns         = school_get_acf_field( 'grid_columns' );
$show_gradient_layer  = school_get_acf_field( 'show_gradient_layer' );
$gradient_tone        = school_get_acf_field( 'gradient_tone' );
$gradient_direction   = school_get_acf_field( 'gradient_direction' );
$background_color     = school_get_acf_field( 'background_color' );
$margin_bottom        = school_get_acf_field( 'margin_bottom' );

if ( $is_preview ) :
	$heading_level = 'span';
endif;

?>
<?php if ( $is_visible || $is_preview ) : ?>
	<!-- GALLERY start -->
	<section
		class="section section--mb-<?= $margin_bottom; ?>
		<?php if ( ! empty( $background_color ) ) : ?>section--with-bg<?php endif; ?> gallery
		<?php if ( ! $is_visible ) : ?>is-not-visible<?php endif; ?>
		<?php if ( ! $is_preview && $is_animation_enabled ) : ?>animate<?php endif; ?>"
		<?php if ( ! empty( $background_color ) ) : ?>style="background-color: <?= $background_color; ?>;"<?php endif; ?>>
		<?php if ( $show_gradient_layer ): ?>
			<div class="gradient-layer"
				 style="background: linear-gradient(to <?= str_replace( '_', ' ', $gradient_direction ); ?>, <?= $gradient_tone; ?>, rgba(0,0,0,0) )"
				 aria-hidden="true"></div>
		<?php endif; ?>
		<div class="wrapper gallery__wrapper">
			<header class="section__header section__header--align-<?= $header_text_align; ?> gallery__section-header">
				<?php if ( ! empty( $heading ) ) : ?>
					<?= '<' . $heading_level . ' class="heading heading--' . $heading_style . '" style="color: ' . $heading_color . ';">' . $heading . '</' . $heading_level . '>'; ?>
				<?php endif; ?>
				<?php if ( ! empty( $caption ) ) : ?>
					<p class="gallery__caption caption" style="color: <?= $caption_color; ?>;">
						<?= $caption; ?>
					</p>
				<?php endif; ?>
			</header>
		</div>
		<div class="wrapper gallery__wrapper <?php if ( $grid_full_width ) : ?>gallery__wrapper--full<?php endif; ?>">
			<?php if ( ! empty( $gallery ) ) : ?>
				<ul class="gallery__list gallery__list--col-<?= $grid_columns; ?>">
					<?php foreach ( $gallery as $image ) : ?>
						<li class="gallery__item">
							<a href="<?= $image['url']; ?>" data-fancybox="gallery-<?= $block_id; ?>"
							   data-caption="<?= $image['caption']; ?>">
								<?= wp_get_attachment_image( $image['ID'], 'full', false, array(
									'class' => 'gallery__image',
								) ); ?>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>
	</section>
	<!-- GALLERY end -->
<?php endif; ?>
