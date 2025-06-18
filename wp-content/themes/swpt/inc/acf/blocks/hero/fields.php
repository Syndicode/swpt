<?php
/**
 * Hero Block Fields.
 *
 * @package school
 */

use StoutLogic\AcfBuilder\FieldsBuilder;

$fields = new FieldsBuilder( 'hero' );

$fields->addMessage( 'block-name', '<span style="font-weight: bold; font-size: 32px">HERO</span>', array(
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

$fields->addTextarea( 'heading', array(
	'label' => __( 'Heading', 'school' ),
	'new_lines' => 'br',
	'rows' => 3,
) );

$fields->addColorPicker( 'heading_color', array(
	'label' => __( 'Heading Color', 'school' ),
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
	'label' => __( 'Caption color', 'school' ),
) );

$fields->addTab( 'Align', array(
	'label' => __( 'View', 'school' ),
) );

$fields->addSelect( 'height', array(
	'label'         => __( 'Height', 'school' ),
	'choices'       => array(
		'full'   => __( 'Full (100% screen height)', 'school' ),
		'large'  => __( 'Large (75% screen height)', 'school' ),
		'medium' => __( 'Medium (50% screen height)', 'school' ),
		'small'  => __( 'Small (Auto block height)', 'school' ),
	),
	'default_value' => 'small',
) );

$fields->addSelect( 'vertical_align', array(
	'label'         => __( 'Horizontal alignment', 'school' ),
	'choices'       => array(
		'left'   => __( 'Left', 'school' ),
		'center' => __( 'Center', 'school' ),
		'right'  => __( 'Right', 'school' ),
	),
	'default_value' => 'center',
	'wrapper'       => array(
		'width' => '50',
	),
) );

$fields->addSelect( 'horizontal_align', array(
	'label'         => __( 'Vertical alignment', 'school' ),
	'choices'       => array(
		'top'    => __( 'Top', 'school' ),
		'middle' => __( 'Middle', 'school' ),
		'bottom' => __( 'Bottom', 'school' ),
	),
	'default_value' => 'middle',
	'wrapper'       => array(
		'width' => '50',
	),
) );

$fields->addTab( 'ctas', array(
	'label' => __( 'CTAs', 'school' ),
) );

$fields->addLink( 'cta', array(
	'label'   => __( 'Primary CTA', 'school' ),
) );

$fields->addSelect( 'cta_style', array(
	'label'   => __( 'Primary CTA Style', 'school' ),
	'choices' => array(
		'purple-white' => __('Purple/White', 'school'),
		'purple-black' => __('Purple/Black', 'school'),
		'purple-border' => __('Purple border', 'school'),
		'white-purple' => __('White/Purple', 'school'),
		'white-black' => __('White/Black', 'school'),
	),
) );

$fields->addLink( 'secondary_cta', array(
	'label'   => __( 'Secondary CTA', 'school' ),
) );

$fields->addSelect( 'secondary_cta_style', array(
	'label'   => __( 'Secondary CTA Style', 'school' ),
	'choices' => array(
		'purple-white' => __('Purple/White', 'school'),
		'purple-black' => __('Purple/Black', 'school'),
		'purple-border' => __('Purple border', 'school'),
		'white-purple' => __('White/Purple', 'school'),
		'white-black' => __('White/Black', 'school'),
	),
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

$fields->addImage( 'background_image', array(
	'label' => __( 'Background image', 'school' ),
) );

$fields->addSelect( 'margin_bottom', array(
	'label'         => __( 'Bottom Indent', 'school' ),
	'choices'       => array(
		'none'     => __( 'None', 'school' ),
		'standard' => __( 'Standard', 'school' ),
	),
	'default_value' => 'standard',
) );

$fields->setLocation( 'block', '==', 'acf/hero' );

return $fields;
