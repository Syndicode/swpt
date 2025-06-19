<?php
/**
 * Entities Grid Block Fields.
 *
 * @package swpt
 */

use StoutLogic\AcfBuilder\FieldsBuilder;

$fields = new FieldsBuilder( 'entities-grid' );

$fields->addMessage( 'block-name', '<span style="font-weight: bold; font-size: 32px">Entities Grid</span>', array(
	'label' => __( 'Block name', 'swpt' ),
) );

$fields->addTab( 'general', array(
	'label' => __( 'General', 'swpt' ),
) );

$fields->addTrueFalse( 'is_visible', array(
	'label'         => __( 'Is Visible?', 'swpt' ),
	'ui'            => 1,
	'ui_on_text'    => __( 'Yes', 'swpt' ),
	'ui_off_text'   => __( 'No', 'swpt' ),
	'default_value' => 1
) );

$fields->addTrueFalse( 'is_animation_enabled', array(
	'label'         => __( 'Enable animations?', 'swpt' ),
	'ui'            => 1,
	'ui_on_text'    => __( 'Yes', 'swpt' ),
	'ui_off_text'   => __( 'No', 'swpt' ),
	'default_value' => 0
) );

$fields->addText( 'heading', array(
	'label' => __( 'Heading', 'swpt' ),
) );

$fields->addColorPicker( 'heading_color', array(
	'label'         => __( 'Heading Color', 'swpt' ),
	'default_value' => '#000000',
) );

$fields->addSelect( 'heading_level', array(
	'label'         => __( 'Heading Level (SEO)', 'swpt' ),
	'choices'       => array(
		'h1' => __( 'H1', 'swpt' ),
		'h2' => __( 'H2', 'swpt' ),
		'h3' => __( 'H3', 'swpt' ),
		'h4' => __( 'H4', 'swpt' ),
		'h5' => __( 'H5', 'swpt' ),
		'h6' => __( 'H6', 'swpt' ),
	),
	'return_format' => 'value',
	'default_value' => 'h2',
	'wrapper'       => array(
		'width' => '50',
	)
) );

$fields->addSelect( 'heading_style', array(
	'label'         => __( 'Heading Level (Style)', 'swpt' ),
	'choices'       => array(
		'h1' => __( 'H1', 'swpt' ),
		'h2' => __( 'H2', 'swpt' ),
		'h3' => __( 'H3', 'swpt' ),
		'h4' => __( 'H4', 'swpt' ),
		'h5' => __( 'H5', 'swpt' ),
		'h6' => __( 'H6', 'swpt' ),
	),
	'return_format' => 'value',
	'default_value' => 'h2',
	'wrapper'       => array(
		'width' => '50',
	)
) );

$fields->addTextarea( 'caption', array(
	'label'     => __( 'Caption', 'swpt' ),
	'rows'      => 3,
	'new_lines' => 'br',
) );

$fields->addColorPicker( 'caption_color', array(
	'label'         => __( 'Caption color', 'swpt' ),
	'default_value' => '#000000',
) );

$fields->addSelect( 'header_text_align', array(
	'label'         => __( 'Header Text alignment', 'swpt' ),
	'choices'       => array(
		'left'   => __( 'Left', 'swpt' ),
		'center' => __( 'Center', 'swpt' ),
		'right'  => __( 'Right', 'swpt' ),
	),
	'default_value' => 'center',
) );

$fields->addLink( 'cta', array(
	'label' => __( 'CTA', 'swpt' ),
) );

$fields->addSelect( 'cta_style', array(
	'label'   => __( 'CTA Style', 'swpt' ),
	'choices' => array(
		'purple-white' => __('Purple/White', 'swpt'),
		'purple-black' => __('Purple/Black', 'swpt'),
		'purple-border' => __('Purple border', 'swpt'),
		'white-purple' => __('White/Purple', 'swpt'),
		'white-black' => __('White/Black', 'swpt'),
	),
) );

$fields->addSelect( 'cta_align', array(
	'label'         => __( 'CTA alignment', 'swpt' ),
	'choices'       => array(
		'left'   => __( 'Left', 'swpt' ),
		'center' => __( 'Center', 'swpt' ),
		'right'  => __( 'Right', 'swpt' ),
	),
	'default_value' => 'center',
) );

$fields->addTab( 'entities_tab', array(
	'label' => __( 'Entities', 'swpt' ),
) );

$fields->addSelect( 'entities_text_align', array(
	'label'         => __( 'Entities Text alignment', 'swpt' ),
	'choices'       => array(
		'left'   => __( 'Left', 'swpt' ),
		'center' => __( 'Center', 'swpt' ),
		'right'  => __( 'Right', 'swpt' ),
	),
	'default_value' => 'left',
) );

$fields->addColorPicker( 'entities_color', array(
	'label'         => __( 'Entities Color', 'swpt' ),
	'default_value' => '#000000',
) );

$fields->addSelect( 'grid_columns', array(
	'label'         => __( 'Number of columns', 'swpt' ),
	'choices'       => array(
		'2' => __( '2', 'swpt' ),
		'3' => __( '3', 'swpt' ),
		'4' => __( '4', 'swpt' ),
		'5' => __( '5', 'swpt' ),
		'6' => __( '6', 'swpt' ),
	),
	'default_value' => '3',
) );

$fields->addRepeater( 'entities', array(
	'label'        => __( 'Entities', 'swpt' ),
	'button_label' => 'Add Entity',
	'layout'       => 'block',
) )
       ->addImage( 'image', array(
	       'label'        => __( 'Icon/Image File', 'swpt' ),
	       'return_value' => 'array',
       ) )
       ->addNumber( 'image_width', array(
	       'label' => __( 'Icon Width', 'swpt' ),
       ) )
       ->addText( 'title', array(
	       'label' => __( 'Title', 'swpt' ),
       ) )
       ->addTextarea( 'caption', array(
	       'label' => __( 'Caption', 'swpt' ),
       ) )
       ->addLink( 'cta', array(
	       'label' => __( 'Entity CTA', 'swpt' ),
       ) );

$fields->addTab( 'background', array(
	'label' => __( 'BG', 'swpt' ),
) );

$fields->addColorPicker( 'background_color', array(
	'label' => __( 'Background color', 'swpt' ),
) );

$fields->addTrueFalse( 'show_gradient_layer', array(
	'label'         => __( 'Show Gradient layer?', 'swpt' ),
	'ui'            => 1,
	'ui_on_text'    => __( 'Yes', 'swpt' ),
	'ui_off_text'   => __( 'No', 'swpt' ),
	'default_value' => 0
) );

$fields->addColorPicker( 'gradient_tone', array(
	'label'             => __( 'Gradient tone', 'swpt' ),
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
	'label'             => __( 'Height', 'swpt' ),
	'choices'           => array(
		'top'          => __( 'To Top', 'swpt' ),
		'bottom'       => __( 'To Bottom', 'swpt' ),
		'left'         => __( 'To Left', 'swpt' ),
		'bottom_left'  => __( 'To Bottom Left', 'swpt' ),
		'top_left'     => __( 'To Top Left', 'swpt' ),
		'right'        => __( 'To Right', 'swpt' ),
		'bottom_right' => __( 'To Bottom Right', 'swpt' ),
		'top_right'    => __( 'To Top Right', 'swpt' ),
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
	'label'         => __( 'Bottom Indent', 'swpt' ),
	'choices'       => array(
		'none'     => __( 'None', 'swpt' ),
		'standard' => __( 'Standard', 'swpt' ),
	),
	'default_value' => 'standard',
) );

$fields->setLocation( 'block', '==', 'acf/entities-grid' );

return $fields;
