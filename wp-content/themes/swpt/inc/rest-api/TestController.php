<?php

namespace School;

use JsonException;
use WP_REST_Controller;
use WP_REST_Request;

class TestController extends WP_REST_Controller {

	public function __construct() {
		$this->namespace = 'school/v1';
		$this->rest_base = 'test';
	}

	/**
	 * @return void
	 */
	public function register_routes(): void {
		/**
		 * Check Test
		 */
		register_rest_route( $this->namespace, "/$this->rest_base/check-test/", [
			'callback'            => [ $this, 'check_test' ],
			'methods'             => 'POST',
			'permission_callback' => '__return_true',
		] );

		/**
		 * Check internal exam
		 */
		register_rest_route( $this->namespace, "/$this->rest_base/check-internal-exam/", [
			'callback'            => [ $this, 'check_internal_exam' ],
			'methods'             => 'POST',
			'permission_callback' => '__return_true',
		] );

		/**
		 * Reset progress
		 */
		register_rest_route( $this->namespace, "/$this->rest_base/reset-progress/", [
			'callback'            => [ $this, 'reset_progress' ],
			'methods'             => 'POST',
			'permission_callback' => '__return_true',
		] );
	}

	/**
	 * @param WP_REST_Request $request
	 *
	 * @return void
	 */
	public function reset_progress( WP_REST_Request $request ) {
		$body = $request->get_params();
		$user = wp_get_current_user();
		if ( $user->exists() ) {
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

				update_user_meta( $user->ID, 'user_study_state', $user_study_state );
			}

			wp_send_json_success();
		}

		wp_send_json_error();
	}

	/**
	 * @param WP_REST_Request $request
	 *
	 * @return void
	 */
	public function check_test( WP_REST_Request $request ) {
		$body     = $request->get_params();
		$response = array();
		if ( ! empty( $body ) ) {
			$user = wp_get_current_user();
			if ( $user->exists() ) {
				$user_study_state      = school_get_user_study_state( $user );
				$option_id             = $body['option_id'];
				$count_correct_answers = 0;
				$count_questions       = 0;

				if ( isset( $user_study_state[ $option_id ] ) ) {
					$user_study_state[ $option_id ]['count_passed'] += 1;
				} else {
					$user_study_state[ $option_id ] = array(
						'id'              => $option_id,
						'count_questions' => 0,
						'best_result'     => 0,
						'count_passed'    => 1,
					);
				}

				foreach ( $body as $key => $param ) {
					if ( $key !== '_wpnonce' && $key !== '_wp_http_referer' && $key !== 'option_id' ) {
						$answers              = school_get_acf_field( 'answers', $key );
						$correct_answer_index = null;
						$count_questions ++;
						foreach ( $answers as $index => $answer ) {
							if ( $answer['is_answer_correct'] ) {
								$correct_answer_index = $index;
							}
						}

						if ( $answers[ $param ]['is_answer_correct'] ) {
							$count_correct_answers ++;
						}

						$response[] = [
							'is_answer_correct' => $answers[ $param ]['is_answer_correct'],
							'correct_answer'    => $correct_answer_index
						];
					}
				}

				if ( $count_correct_answers > $user_study_state[ $option_id ]['best_result'] ) {
					$user_study_state[ $option_id ]['best_result'] = $count_correct_answers;
				}

				$user_study_state[ $option_id ]['count_questions'] = $count_questions;
				update_user_meta( $user->ID, 'user_study_state', $user_study_state );
			}
		}
		wp_send_json_success( $response );
	}

	/**
	 * @param WP_REST_Request $request
	 *
	 * @return void
	 */
	public function check_internal_exam( WP_REST_Request $request ) {
		$body     = $request->get_params();
		$response = array();
		if ( ! empty( $body ) ) {
			$user = wp_get_current_user();
			if ( $user->exists() ) {
				$user_exam_state       = get_user_meta( $user->ID, 'user_exam_state', true ) ?: array();
				$count_correct_answers = 0;
				$best_result_questions = [];

				$user_exam_state['count_passed'] += 1;

				foreach ( $body as $key => $param ) {
					if ( $key !== '_wpnonce' && $key !== '_wp_http_referer' && $key !== 'option_id' ) {
						$best_result_questions[ $key ] = [
							'title'             => get_post( $key )->post_title,
							'is_answer_correct' => false,
						];
						$answers                       = school_get_acf_field( 'answers', $key );
						$correct_answer_index          = null;
						foreach ( $answers as $index => $answer ) {
							if ( $answer['is_answer_correct'] ) {
								$correct_answer_index = $index;
							}
						}

						if ( $answers[ $param ]['is_answer_correct'] ) {
							$count_correct_answers ++;
							$best_result_questions[ $key ]['is_answer_correct'] = true;
						}

						$response[] = [
							'is_answer_correct' => $answers[ $param ]['is_answer_correct'],
							'correct_answer'    => $correct_answer_index
						];
					}
				}

				// Fallback for old users
				$user_exam_state['best_result_date']      = $user_exam_state['best_result_date'] ?? '';
				$user_exam_state['best_result_questions'] = $user_exam_state['best_result_questions'] ?? [];

				$user_exam_state = [
					'current_exam'          => [
						'questions'       => [],
						'timestamp_start' => ''
					],
					'best_result'           => max( $count_correct_answers, $user_exam_state['best_result'] ),
					'best_result_date'      => $count_correct_answers > $user_exam_state['best_result'] ? time() : $user_exam_state['best_result_date'],
					'best_result_questions' => $count_correct_answers > $user_exam_state['best_result'] ? $best_result_questions : $user_exam_state['best_result_questions'],
					'count_passed'          => $user_exam_state['count_passed'] ++,
				];

				update_user_meta( $user->ID, 'user_exam_state', $user_exam_state );
			}
		}
		wp_send_json_success( $response );
	}
}

