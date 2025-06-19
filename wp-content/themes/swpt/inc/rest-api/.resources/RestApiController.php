<?php

namespace SWPT;

use JsonException;
use WP_REST_Controller;
use WP_REST_Request;

class RestApiController extends WP_REST_Controller {

	public function __construct() {
		$this->namespace = 'swpt/v1';
		$this->rest_base = 'rest-base';
	}

	/**
	 * Registers REST API routes for this namespace and base endpoint.
	 *
	 * @return void
	 */
	public function register_routes(): void {
		register_rest_route( $this->namespace, "/$this->rest_base/route/", [
			'callback'            => [ $this, 'callback' ],
			'methods'             => 'POST',
			'permission_callback' => '__return_true',
		] );
	}

	/**
	 * @param WP_REST_Request $request
	 *
	 * @return void
	 */
	public function callback( WP_REST_Request $request ):void {
		$params = $request->get_params();
		wp_send_json_success();
	}
}

