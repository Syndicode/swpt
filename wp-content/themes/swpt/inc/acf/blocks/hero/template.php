<?php
/**
 * Breadcrumbs Block Template.
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
$is_visible           = swpt_get_acf_field( 'is_visible' );
$is_animation_enabled = swpt_get_acf_field( 'is_animation_enabled' );
$heading              = swpt_get_acf_field( 'heading' );
$heading_color        = swpt_get_acf_field( 'heading_color' );
$heading_level        = swpt_get_acf_field( 'heading_level' );
$heading_style        = swpt_get_acf_field( 'heading_style' );
$show_gradient_layer  = swpt_get_acf_field( 'show_gradient_layer' );
$gradient_tone        = swpt_get_acf_field( 'gradient_tone' );
$gradient_direction   = swpt_get_acf_field( 'gradient_direction' );
$background_color     = swpt_get_acf_field( 'background_color' );
$height               = swpt_get_acf_field( 'height' );
$horizontal_align     = swpt_get_acf_field( 'horizontal_align' );
$vertical_align       = swpt_get_acf_field( 'vertical_align' );
$caption              = swpt_get_acf_field( 'caption' );
$caption_color        = swpt_get_acf_field( 'caption_color' );
$cta                  = swpt_get_acf_field( 'cta' );
$cta_style            = swpt_get_acf_field( 'cta_style' );
$secondary_cta        = swpt_get_acf_field( 'secondary_cta' );
$secondary_cta_style  = swpt_get_acf_field( 'secondary_cta_style' );
$background_image     = swpt_get_acf_field( 'background_image' );
$margin_bottom        = swpt_get_acf_field( 'margin_bottom' );

if ( $is_preview ) :
	$heading_level = 'span';
endif;

?>
<?php if ( $is_visible || $is_preview ) : ?>
	<!-- HERO start -->
	<section id="<?= $block_id; ?>"
			 class="section section--mb-<?= $margin_bottom; ?> hero hero--<?= $height; ?> hero--<?= $horizontal_align; ?>
		<?php if ( ! $is_visible ) : ?>is-not-visible<?php endif; ?>
		<?php if ( ! $is_preview && $is_animation_enabled ) : ?>animate<?php endif; ?>"
			 <?php if ( ! empty( $background_color ) ) : ?>style="background-color: <?= $background_color; ?>;"<?php endif; ?>>
		<?php if ( ! empty( $background_image ) ) :
			echo wp_get_attachment_image( $background_image['id'], 'full', false, array(
				'class' => 'hero__background-image',
			) );
		endif; ?>
		<?php if ( $show_gradient_layer ): ?>
			<div class="gradient-layer"
				 style="background: linear-gradient(to <?= str_replace( '_', ' ', $gradient_direction ); ?>, <?= $gradient_tone; ?>, rgba(0,0,0,0) )"
				 aria-hidden="true"></div>
		<?php endif; ?>
		<div class="hero__wrapper hero__wrapper--<?= $vertical_align; ?>">
			<?php if ( ! empty( $heading ) ) : ?>
				<?= '<' . $heading_level . ' class="hero__heading heading heading--' . $heading_style . '" style="color: ' . $heading_color . ';">' . $heading . '</' . $heading_level . '>'; ?>
			<?php endif; ?>
			<?php if ( ! empty( $caption ) ) : ?>
				<p class="hero__caption caption"
				   <?php if ( ! empty( $caption_color ) ) : ?>style="color: <?= $caption_color; ?>;"<?php endif; ?>>
					<?= $caption ?>
				</p>
			<?php endif; ?>
			<?php if ( ! empty( $cta ) || ! empty( $secondary_cta ) ) : ?>
				<div class="hero__ctas">
					<?php if ( ! empty( $cta ) ) : ?>
						<a href="<?= $cta['url']; ?>" target="<?= $cta['target']; ?>"
						   class="button button--<?= $cta_style; ?> hero__cta"><?= $cta['title']; ?></a>
					<?php endif; ?>
					<?php if ( ! empty( $secondary_cta ) ) : ?>
						<a href="<?= $secondary_cta['url']; ?>" target="<?= $secondary_cta['target']; ?>"
						   class="button button--<?= $secondary_cta_style; ?> hero__cta"><?= $secondary_cta['title']; ?></a>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>
	</section>
	<!-- HERO end -->
<?php endif; ?>
