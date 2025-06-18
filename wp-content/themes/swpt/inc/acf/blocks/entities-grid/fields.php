<?php
/**
 * Entities Grid Block Fields.
 *
 * @package school
 */

use StoutLogic\AcfBuilder\FieldsBuilder;

$fields = new FieldsBuilder( 'entities-grid' );

$fields->addMessage( 'block-name', '<span style="font-weight: bold; font-size: 32px">Entities Grid</span>', array(
	'label' => __( 'Block name', 'school' ),
) );

$fields->addTab( 'general', array(
	'label' => __( 'General', 'school' ),
) );

$fields->addTrueFalse( 'is_visible', array(
	'label'         => __( 'Is Visible?', 'school' ),
	'ui'            => 1,
	'ui_on_text'    => __( 'Yes', 'school' ),
	'ui_off_text'   => __( 'No', 'school' ),
	'default_value' => 1
) );

$fields->addTrueFalse( 'is_animation_enabled', array(
	'label'         => __( 'Enable animations?', 'school' ),
	'ui'            => 1,
	'ui_on_text'    => __( 'Yes', 'school' ),
	'ui_off_text'   => __( 'No', 'school' ),
	'default_value' => 0
) );

$fields->addText( 'heading', array(
	'label' => __( 'Heading', 'school' ),
) );

$fields->addColorPicker( 'heading_color', array(
	'label'         => __( 'Heading Color', 'school' ),
	'default_value' => '#000000',
) );

$fields->addSelect( 'heading_level', array(
	'label'         => __( 'Heading Level (SEO)', 'school' ),
	'choices'       => array(
		'h1' => __( 'H1', 'school' ),
		'h2' => __( 'H2', 'school' ),
		'h3' => __( 'H3', 'school' ),
		'h4' => __( 'H4', 'school' ),
		'h5' => __( 'H5', 'school' ),
		'h6' => __( 'H6', 'school' ),
	),
	'return_format' => 'value',
	'default_value' => 'h2',
	'wrapper'       => array(
		'width' => '50',
	)
) );

$fields->addSelect( 'heading_style', array(
	'label'         => __( 'Heading Level (Style)', 'school' ),
	'choices'       => array(
		'h1' => __( 'H1', 'school' ),
		'h2' => __( 'H2', 'school' ),
		'h3' => __( 'H3', 'school' ),
		'h4' => __( 'H4', 'school' ),
		'h5' => __( 'H5', 'school' ),
		'h6' => __( 'H6', 'school' ),
	),
	'return_format' => 'value',
	'default_value' => 'h2',
	'wrapper'       => array(
		'width' => '50',
	)
) );

$fields->addTextarea( 'caption', array(
	'label'     => __( 'Caption', 'school' ),
	'rows'      => 3,
	'new_lines' => 'br',
) );

$fields->addColorPicker( 'caption_color', array(
	'label'         => __( 'Caption color', 'school' ),
	'default_value' => '#000000',
) );

$fields->addSelect( 'header_text_align', array(
	'label'         => __( 'Header Text alignment', 'school' ),
	'choices'       => array(
		'left'   => __( 'Left', 'school' ),
		'center' => __( 'Center', 'school' ),
		'right'  => __( 'Right', 'school' ),
	),
	'default_value' => 'center',
) );

$fields->addLink( 'cta', array(
	'label' => __( 'CTA', 'school' ),
) );

$fields->addSelect( 'cta_style', array(
	'label'   => __( 'CTA Style', 'school' ),
	'choices' => array(
		'purple-white' => __('Purple/White', 'school'),
		'purple-black' => __('Purple/Black', 'school'),
		'purple-border' => __('Purple border', 'school'),
		'white-purple' => __('White/Purple', 'school'),
		'white-black' => __('White/Black', 'school'),
	),
) );

$fields->addSelect( 'cta_align', array(
	'label'         => __( 'CTA alignment', 'school' ),
	'choices'       => array(
		'left'   => __( 'Left', 'school' ),
		'center' => __( 'Center', 'school' ),
		'right'  => __( 'Right', 'school' ),
	),
	'default_value' => 'center',
) );

$fields->addTab( 'entities_tab', array(
	'label' => __( 'Entities', 'school' ),
) );

$fields->addSelect( 'entities_text_align', array(
	'label'         => __( 'Entities Text alignment', 'school' ),
	'choices'       => array(
		'left'   => __( 'Left', 'school' ),
		'center' => __( 'Center', 'school' ),
		'right'  => __( 'Right', 'school' ),
	),
	'default_value' => 'left',
) );

$fields->addColorPicker( 'entities_color', array(
	'label'         => __( 'Entities Color', 'school' ),
	'default_value' => '#000000',
) );

$fields->addSelect( 'grid_columns', array(
	'label'         => __( 'Number of columns', 'school' ),
	'choices'       => array(
		'2' => __( '2', 'school' ),
		'3' => __( '3', 'school' ),
		'4' => __( '4', 'school' ),
		'5' => __( '5', 'school' ),
		'6' => __( '6', 'school' ),
	),
	'default_value' => '3',
) );

$fields->addRepeater( 'entities', array(
	'label'        => __( 'Entities', 'school' ),
	'button_label' => 'Add Entity',
	'layout'       => 'block',
) )
       ->addImage( 'image', array(
	       'label'        => __( 'Icon/Image File', 'school' ),
	       'return_value' => 'array',
       ) )
       ->addNumber( 'image_width', array(
	       'label' => __( 'Icon Width', 'school' ),
       ) )
       ->addText( 'title', array(
	       'label' => __( 'Title', 'school' ),
       ) )
       ->addTextarea( 'caption', array(
	       'label' => __( 'Caption', 'school' ),
       ) )
       ->addLink( 'cta', array(
	       'label' => __( 'Entity CTA', 'school' ),
       ) );

$fields->addTab( 'background', array(
	'label' => __( 'BG', 'school' ),
) );

$fields->addColorPicker( 'background_color', array(
	'label' => __( 'Background color', 'school' ),
) );

$fields->addTrueFalse( 'show_gradient_layer', array(
	'label'         => __( 'Show Gradient layer?', 'school' ),
	'ui'            => 1,
	'ui_on_text'    => __( 'Yes', 'school' ),
	'ui_off_text'   => __( 'No', 'school' ),
	'default_value' => 0
) );

$fields->addColorPicker( 'gradient_tone', array(
	'label'             => __( 'Gradient tone', 'school' ),
	'conditional_logic' => array(
		array(
			array(
				'field'    => 'show_gradient_layer',
				'operator' => '==',
				'value'    => 1
			),
		),
	),
	'enable_opacity'    => 1,
	'default_value'     => '#000000',
) );

$fields->addSelect( 'gradient_direction', array(
	'label'             => __( 'Height', 'school' ),
	'choices'           => array(
		'top'          => __( 'To Top', 'school' ),
		'bottom'       => __( 'To Bottom', 'school' ),
		'left'         => __( 'To Left', 'school' ),
		'bottom_left'  => __( 'To Bottom Left', 'school' ),
		'top_left'     => __( 'To Top Left', 'school' ),
		'right'        => __( 'To Right', 'school' ),
		'bottom_right' => __( 'To Bottom Right', 'school' ),
		'top_right'    => __( 'To Top Right', 'school' ),
	),
	'conditional_logic' => array(
		array(
			array(
				'field'    => 'show_gradient_layer',
				'operator' => '==',
				'value'    => 1
			),
		),
	),
	'default_value'     => 'left',
) );

$fields->addSelect( 'margin_bottom', array(
	'label'         => __( 'Bottom Indent', 'school' ),
	'choices'       => array(
		'none'     => __( 'None', 'school' ),
		'standard' => __( 'Standard', 'school' ),
	),
	'default_value' => 'standard',
) );

$fields->setLocation( 'block', '==', 'acf/entities-grid' );

return $fields;
