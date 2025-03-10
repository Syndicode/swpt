<?php
/**
 * Option page Settings
 *
 * @package school
 */

use StoutLogic\AcfBuilder\FieldsBuilder;

/**
 * @return void
 * @throws \StoutLogic\AcfBuilder\FieldNameCollisionException
 */
function acf_add_options_page_fonts_fields(): void {

	$fields = new FieldsBuilder( 'fonts' );

	$fields->addRepeater( 'fonts', array(
		'layout' => 'block',
		'button_label' => 'Add Font',
	));
}

add_action( 'acf/init', 'acf_add_options_page_fonts_fields' );
