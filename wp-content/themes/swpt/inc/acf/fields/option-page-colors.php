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
function acf_add_options_page_colors_fields(): void {

	$fields = new FieldsBuilder( 'colors' );

	$fields->addRepeater( 'fonts', array(
		'layout' => 'block',
		'button_label' => 'Add Font',
	));

	$fields->setLocation( 'options_page', '==', 'acf-options-colors' );
	acf_add_local_field_group( $fields->build() );
}

add_action( 'acf/init', 'acf_add_options_page_colors_fields' );
