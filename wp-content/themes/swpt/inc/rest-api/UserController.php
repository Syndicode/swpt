<?php

namespace School;

use JsonException;
use WP_REST_Controller;
use WP_REST_Request;

class UserController extends WP_REST_Controller {

	public function __construct() {
		$this->namespace = 'school/v1';
		$this->rest_base = 'user';
	}

	/**
	 * @return void
	 */
	public function register_routes(): void {
		/**
		 * Sign-up
		 */
		register_rest_route( $this->namespace, "/$this->rest_base/sign-up/", [
			'callback'            => [ $this, 'sign_up' ],
			'methods'             => 'POST',
			'permission_callback' => '__return_true',
		] );

		/**
		 * Sign-in
		 */
		register_rest_route( $this->namespace, "/$this->rest_base/sign-in/", [
			'callback'            => [ $this, 'sign_in' ],
			'methods'             => 'POST',
			'permission_callback' => '__return_true',
		] );
	}

	/**
	 * @param WP_REST_Request $request
	 *
	 * @return void
	 */
	public function sign_in( WP_REST_Request $request ) {
		if ( ! empty( $params['login'] ) ) {
			wp_send_json_error();
		}

		$params = $request->get_params();
		$auth   = wp_authenticate( sanitize_email( $params['email'] ), $params['password'] );

		if ( ! is_wp_error( $auth ) ) {
			wp_clear_auth_cookie();
			wp_set_current_user( $auth->ID );
			wp_set_auth_cookie( $auth->ID );

			wp_send_json_success();
		}

		wp_send_json_error( [
			'message'    => 'Під час входу сталась помилка, спробуйте пізніше',
			'error_type' => 'sign_in_error'
		] );
	}

	/**
	 * @param WP_REST_Request $request
	 *
	 * @return void
	 */
	public function sign_up( WP_REST_Request $request ) {
		$params = $request->get_params();
		if ( ! empty( $params['first_name'] ) ) {
			wp_send_json_error();
		}

		$user_email = sanitize_email( $params['email'] );

		if ( email_exists( $user_email ) ) {
			wp_send_json_error( [
				'message'    => 'Email ' . $user_email . ' вже зарежєстровано в системі',
				'error_type' => 'email_registered'
			] );
		}

		$userdata = [
			'user_login'           => $user_email,
			'user_pass'            => $params['password'],
			'user_email'           => $user_email,
			'display_name'         => $params['check_spam_field'] . ' ' . $params['last_name'],
			'first_name'           => $params['check_spam_field'],
			'last_name'            => $params['last_name'],
			'description'          => '',
			'rich_editing'         => 'false',
			'syntax_highlighting'  => 'false',
			'comment_shortcuts'    => 'false',
			'admin_color'          => 'fresh',
			'show_admin_bar_front' => 'false',
			'role'                 => 'student',
		];

		$user_id = wp_insert_user( $userdata );

		if ( ! is_wp_error( $user_id ) ) {
			$user_study_state = array();
			$chapters         = get_terms( array(
				'taxonomy'   => 'chapter',
				'hide_empty' => false,
			) );

			if ( ! empty( $chapters ) ) {
				foreach ( $chapters as $chapter ) {
					if ( $chapter->parent !== 0 ) {
						$questions = get_posts( array(
							'numberposts' => - 1,
							'post_type'   => 'question',
							'tax_query'   => array(
								array(
									'taxonomy' => 'chapter',
									'field'    => 'term_id',
									'terms'    => $chapter->term_id
								)
							)
						) );

						$user_study_state[ $chapter->term_id ] = [
							'id'              => $chapter->term_id,
							'count_questions' => is_countable( $questions ) ? count( $questions ) : 0,
							'best_result'     => 0,
							'count_passed'    => 0
						];
					}
				}

				update_user_meta( $user_id, 'user_study_state', $user_study_state );
				update_user_meta( $user_id, 'user_exam_state', [
					'current_exam'          => [
						'questions'       => [],
						'timestamp_start' => ''
					],
					'best_result'           => 0,
					'best_result_date'      => '',
					'best_result_questions' => [],
					'count_passed'          => 0,
				] );
			}

			wp_send_json_success();
		}

		wp_send_json_error( [
			'message'    => 'Під час реєстрації сталась помилка, спробуйте пізніше',
			'error_type' => 'sign_up_error'
		] );
	}
}

