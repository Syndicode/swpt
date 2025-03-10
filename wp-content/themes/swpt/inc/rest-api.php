<?php

use School\TestController;
use School\UserController;

require_once TEMPLATE_DIR . '/inc/rest-api/TestController.php';
require_once TEMPLATE_DIR . '/inc/rest-api/UserController.php';

add_action( 'rest_api_init', function () {
	$test = new TestController();
	$test->register_routes();

	$user = new UserController();
	$user->register_routes();
} );
