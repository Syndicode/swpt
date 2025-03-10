<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

function acf_add_post_type_group_fields(): void {
	$fields = new FieldsBuilder( 'group', array(
		'title' => __( 'Group information', 'school' ),
	) );

	$fields->addTrueFalse( 'is_access_enabled', array(
		'label'         => __( 'Enable access to courses?', 'school' ),
		'ui'            => true,
		'default_value' => 1
	) );

	$fields->addUser( 'members', array(
		'label'         => __( 'Group members', 'school' ),
		'required'      => 1,
		'allow_null'    => 0,
		'multiple'      => 1,
		'return_format' => 'ID'
	) );

	$fields->setLocation( 'post_type', '==', 'group' );

	acf_add_local_field_group( $fields->build() );
}

add_action( 'acf/init', 'acf_add_post_type_group_fields' );
