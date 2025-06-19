<?php
$phones    = swpt_get_acf_field( 'contacts_phones', 'option' );
$copyright = swpt_get_acf_field( 'footer_copyright', 'option' );
?>

<footer class="footer">
	<div class="wrapper footer__wrapper">
		<div class="footer__layer">
			<a href="<?= home_url(); ?>" class="footer__logo">
				<img src="<?= TEMPLATE_DIR_URI; ?>/assets/images/swpt-logo-light.svg"
					 alt="<?= get_option( 'blogname' ); ?>" class="footer__logo-image">
			</a>
			<div class="footer__address">
				© 2014—2025 Syndicode. All rights reserved
			</div>
		</div>
		<?php if ( ! empty( $phones ) ) : ?>
			<div class="footer__layer">
				<?php foreach ($phones as $phone) : ?>
					<a href="tel:<?= str_replace( [ ' ', '-', '(', ')' ], '', $phone['phone'] ); ?>"
					   class="footer__phone"><?= $phone['phone']; ?> <span><?= $phone['note']; ?></span></a><br>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
	<?php if ( ! empty( $copyright ) ) : ?>
		<p class="footer__copy">
			<?= $copyright; ?>
		</p>
	<?php endif; ?>
</footer>
