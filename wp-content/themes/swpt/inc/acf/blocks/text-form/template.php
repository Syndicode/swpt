<?php
/**
 * Text/Form Block Template.
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
$text                 = school_get_acf_field( 'text' );
$text_color           = school_get_acf_field( 'text_color' );
$image                = school_get_acf_field( 'image' );
$horizontal_align     = school_get_acf_field( 'horizontal_align' );
$text_align           = school_get_acf_field( 'text_align' );
$order                = school_get_acf_field( 'order' );
$view_is_row          = school_get_acf_field( 'view_is_row' );
$column_max_width     = school_get_acf_field( 'column_max_width' );
$width_ratio          = school_get_acf_field( 'width_ratio' );
$show_gradient_layer  = school_get_acf_field( 'show_gradient_layer' );
$gradient_tone        = school_get_acf_field( 'gradient_tone' );
$gradient_direction   = school_get_acf_field( 'gradient_direction' );
$background_color     = school_get_acf_field( 'background_color' );
$margin_bottom        = school_get_acf_field( 'margin_bottom' );
$form                 = school_get_acf_field( 'form' );
$form_cta_style       = school_get_acf_field( 'form_cta_style' );

if ( $is_preview ) :
	$heading_level = 'span';
endif;

?>
<?php if ( $is_visible || $is_preview ) : ?>
	<!-- TEXT/FORM start -->
	<section
		class="section section--mb-<?= $margin_bottom; ?>
		<?php if ( ! empty( $background_color ) ) : ?>section--with-bg<?php endif; ?> text-form
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
		<div
			class="wrapper text-form__wrapper text-form__wrapper--<?= $view_is_row ? 'row' : 'column'; ?> <?php if ( $view_is_row ) : ?>text-form__wrapper--<?= $width_ratio; ?> text-form__wrapper--<?= $horizontal_align; ?><?php endif; ?> text-form__wrapper--<?= $order; ?>">
			<div class="text-form__text-holder text-form__text-holder--<?= $text_align; ?>"
				 <?php if ( ! $view_is_row ) : ?>style="max-width: <?= $column_max_width; ?>%;" <?php endif; ?>>
				<?php if ( ! empty( $heading ) ) : ?>
					<?= '<' . $heading_level . ' class="heading heading--' . $heading_style . '" style="color: ' . $heading_color . ';">' . $heading . '</' . $heading_level . '>'; ?>
				<?php endif; ?>
				<?php if ( ! empty( $caption ) ) : ?>
					<p class="caption" style="color: <?= $caption_color; ?>;">
						<?= $caption; ?>
					</p>
				<?php endif; ?>
				<?php if ( ! empty( $text ) ) : ?>
					<div class="text" style="color: <?= $text_color; ?>;">
						<?= $text; ?>
					</div>
				<?php endif; ?>
			</div>
			<div data-form_cta_style="<?= $form_cta_style; ?>" class="text-form__form-holder"
				 <?php if ( ! $view_is_row ) : ?>style="max-width: <?= $column_max_width; ?>%;" <?php endif; ?>>
				<?= do_shortcode( '[contact-form-7 id="' . $form . '"]' ); ?>
			</div>
		</div>
	</section>
	<!-- TEXT/FORM end -->
	<script>
		(() => {
			const cta = document.querySelector('form .button');
			const formHolder = document.querySelector('.text-form__form-holder');
			if (cta) {
				cta.className = 'button button--' + formHolder.getAttribute('data-form_cta_style');
			}
		})();
	</script>
<?php endif; ?>
