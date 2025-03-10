<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

function acf_add_post_type_question_fields(): void {
	$fields = new FieldsBuilder( 'question', array(
		'title' => __( 'Question information', 'school' ),
	) );

	$fields->addRepeater( 'answers', array(
		'label'        => __( 'Answer options', 'school' ),
		'required'     => true,
		'button_label' => __( 'Add Answer option', 'school' ),
		'min'          => 2,
	) )
	       ->addTextarea( 'text', array(
		       'label' => __( 'Text', 'school' ),
		       'rows'  => 3,
		       'wrapper' => array(
				   'width' => '70'
		       ),
	       ) )
	       ->addTrueFalse( 'is_answer_correct', array(
		       'label'       => __( 'Correct answer?', 'school' ),
		       'ui'          => true,
		       'ui_on_text'  => __( 'Correct', 'school' ),
		       'ui_off_text' => __( 'Incorrect', 'school' ),
		       'default' => 0,
		       'wrapper' => array(
			       'width' => '30'
		       ),


	       ) );

	$fields->addTaxonomy('chapter', array(
		'label'        => __( 'Chapter', 'school' ),
		'taxonomy' => 'chapter',
		'field_type' => 'checkbox',
		'allow_null' => 0,
		'add_term' => 0,
		'save_terms' => 1,
		'load_terms' => 1,
		'return_format' => 'id',
		'multiple' => 1,
	));

	$fields->setLocation( 'post_type', '==', 'question' );

	acf_add_local_field_group( $fields->build() );
}

add_action( 'acf/init', 'acf_add_post_type_question_fields' );
