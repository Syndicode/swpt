<?php

use SWPT\RestApiController;

//require_once TEMPLATE_DIR . '/inc/rest-api/Controller.php';

function swpt_rest_api_init(): void {
//	$controller = new Controller();
//	$controller->register_routes();
}

add_action( 'rest_api_init', 'swpt_rest_api_init' );
