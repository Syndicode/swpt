<?php
/**
 * Create Contacts option page
 *
 * @return void
 */
function acf_create_colors_options_page(): void {
	acf_add_options_page( array(
		'page_title'  => __( 'Colors', 'school' ),
		'menu_title'  => __( 'Colors', 'school' ),
		'parent_slug' => 'themes.php',
	) );
}

add_action( 'acf/init', 'acf_create_colors_options_page' );

