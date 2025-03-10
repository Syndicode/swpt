<?php
/**
 * Text Image Block Fields.
 *
 * @package school
 */

use StoutLogic\AcfBuilder\FieldsBuilder;

$fields = new FieldsBuilder( 'contacts' );

$fields->addMessage( 'block-name', '<span style="font-weight: bold; font-size: 32px">CONTACTS</span>', array(
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

$fields->addTab( 'contacts_tab', array(
	'label' => __( 'Contacts', 'school' ),
) );

$fields->addRepeater( 'contacts', array(
	'label' => __( 'Contacts', 'school' ),
	'layout'       => 'block',
) )
       ->addText( 'heading', array(
	       'label' => __( 'Heading', 'school' ),
       ) )
       ->addColorPicker( 'heading_color', array(
	       'label'         => __( 'Heading Color', 'school' ),
	       'default_value' => '#000000',
       ) )
       ->addSelect( 'heading_level', array(
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
       ) )
       ->addSelect( 'heading_style', array(
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
       ) )
       ->addTextarea( 'map_iframe', array(
	       'label' => __( 'Map iframe', 'school' ),
	       'rows'  => 3,
       ) )
       ->addTextarea( 'address', array(
	       'label' => __( 'Address', 'school' ),
	       'rows'  => 3,
       ) )
       ->addTextarea( 'phones', array(
	       'label' => __( 'Phones', 'school' ),
	       'rows'  => 3,
       ) )
       ->addTextarea( 'emails', array(
	       'label' => __( 'Emails', 'school' ),
	       'rows'  => 3,
       ) )
       ->addTextarea( 'information', array(
	       'label' => __( 'Additional information', 'school' ),
	       'rows'  => 3,
       ) );

$fields->addTab( 'align', array(
	'label' => __( 'Align', 'school' ),
) );

$fields->addTrueFalse( 'view_is_row', array(
	'label'         => __( 'View: Row/Column', 'school' ),
	'ui'            => 1,
	'ui_on_text'    => __( 'Row', 'school' ),
	'ui_off_text'   => __( 'Column', 'school' ),
	'default_value' => 1
) );

$fields->addText( 'column_max_width', array(
	'label'             => __( 'Column max width', 'school' ),
	'conditional_logic' => array(
		array(
			array(
				'field'    => 'view_is_row',
				'operator' => '==',
				'value'    => 0
			),
		),
	),
	'default_value'     => 80
) );

$fields->addSelect( 'order', array(
	'label'         => __( 'Text/Map order', 'school' ),
	'choices'       => array(
		'text-map' => __( 'Text/Map', 'school' ),
		'map-text' => __( 'Map/Text', 'school' ),
	),
	'default_value' => 'text-image',
) );

$fields->addSelect( 'width_ratio', array(
	'label'             => __( 'Text/Image Width Ratio', 'school' ),
	'choices'           => array(
		'1-1' => __( '1:1', 'school' ),
		'2-3' => __( '2:3', 'school' ),
		'3-2' => __( '3:2', 'school' ),
	),
	'conditional_logic' => array(
		array(
			array(
				'field'    => 'view_is_row',
				'operator' => '==',
				'value'    => 1
			),
		),
	),
	'default_value'     => '2-3',
) );

$fields->addSelect( 'text_align', array(
	'label'         => __( 'Text alignment', 'school' ),
	'choices'       => array(
		'left'   => __( 'Left', 'school' ),
		'center' => __( 'Center', 'school' ),
		'right'  => __( 'Right', 'school' ),
	),
	'default_value' => 'center',
) );

$fields->addSelect( 'horizontal_align', array(
	'label'         => __( 'Vertical alignment', 'school' ),
	'choices'       => array(
		'top'    => __( 'Top', 'school' ),
		'middle' => __( 'Middle', 'school' ),
		'bottom' => __( 'Bottom', 'school' ),
	),
	'default_value' => 'middle',
) );

$fields->addTab( 'background', array(
	'label' => __( 'BG', 'school' ),
) );

$fields->addColorPicker( 'background_color', array(
	'label' => __( 'Background color', 'school' ),
) );

$fields->addImage( 'background_image', array(
	'label' => __( 'Background image', 'school' ),
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

$fields->setLocation( 'block', '==', 'acf/contacts' );

return $fields;
