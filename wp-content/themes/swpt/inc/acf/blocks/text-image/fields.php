<?php
/**
 * Text Image Block Fields.
 *
 * @package swpt
 */

use StoutLogic\AcfBuilder\FieldsBuilder;

$fields = new FieldsBuilder( 'text-image' );

$fields->addMessage( 'block-name', '<span style="font-weight: bold; font-size: 32px">TEXT / IMAGE</span>', array(
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

$fields->addTextarea( 'text', array(
	'label'     => __( 'Text', 'swpt' ),
	'rows'      => 5,
	'new_lines' => 'br',
) );

$fields->addColorPicker( 'text_color', array(
	'label'         => __( 'Text color', 'swpt' ),
	'default_value' => '#000000',
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

$fields->addColorPicker( 'cta_color', array(
	'label'             => __( 'CTA Color', 'swpt' ),
	'conditional_logic' => array(
		array(
			array(
				'field'    => 'cta_style',
				'operator' => '==',
				'value'    => 'simple'
			),
		),
	),
) );

$fields->addImage( 'image', array(
	'label'         => __( 'Image', 'swpt' ),
	'required'      => true,
	'return_format' => 'id',
) );

$fields->addTab( 'align', array(
	'label' => __( 'Align', 'swpt' ),
) );

$fields->addSelect( 'order', array(
	'label'         => __( 'Text/Image order', 'swpt' ),
	'choices'       => array(
		'text-image' => __( 'Text/Image', 'swpt' ),
		'image-text' => __( 'Image/Text', 'swpt' ),
	),
	'default_value' => 'text-image',
) );

$fields->addSelect( 'width_ratio', array(
	'label'         => __( 'Text/Image Width Ratio', 'swpt' ),
	'choices'       => array(
		'1-1' => __( '1:1', 'swpt' ),
		'2-3' => __( '2:3', 'swpt' ),
		'3-2' => __( '3:2', 'swpt' ),
	),
	'default_value' => '1:1',
) );

$fields->addSelect( 'text_align', array(
	'label'         => __( 'Text alignment', 'swpt' ),
	'choices'       => array(
		'left'   => __( 'Left', 'swpt' ),
		'center' => __( 'Center', 'swpt' ),
		'right'  => __( 'Right', 'swpt' ),
	),
	'default_value' => 'center',
) );

$fields->addSelect( 'horizontal_align', array(
	'label'         => __( 'Vertical alignment', 'swpt' ),
	'choices'       => array(
		'top'    => __( 'Top', 'swpt' ),
		'middle' => __( 'Middle', 'swpt' ),
		'bottom' => __( 'Bottom', 'swpt' ),
	),
	'default_value' => 'middle',
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

$fields->setLocation( 'block', '==', 'acf/text-image' );

return $fields;
