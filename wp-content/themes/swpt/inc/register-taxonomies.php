<?php

function swpt_register_taxonomies(): void {
	$taxonomies       = [];
	$taxonomies_files = glob( get_template_directory() . '/inc/taxonomies/*.php' );

	foreach ( $taxonomies_files as $file ) {
		$taxonomies[] = require( $file );
	}

	foreach ( $taxonomies as $taxonomy ) {
		if ( isset( $taxonomy['taxonomy'] ) && isset( $taxonomy['args'] ) ) {
			register_taxonomy( $taxonomy['taxonomy'], $taxonomy['object_type'], $taxonomy['args'] );
		}
	}
}

add_action( 'init', 'swpt_register_taxonomies' );
