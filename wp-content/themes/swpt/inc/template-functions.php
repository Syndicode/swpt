<?php

if ( ! function_exists( 'swpt_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @return void
	 * @since 1.0.0
	 *
	 */
	function swpt_setup(): void {
		/*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         */
		load_theme_textdomain( 'starter-theme', TEMPLATE_DIR_URI . '/languages' );

		/*
		 * Let WordPress manage the document title.
		 * This theme does not use a hard-coded <title> tag in the document head,
		 * WordPress will provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/**
		 * Add post-formats support.
		 */
		add_theme_support(
			'post-formats',
			[
				'link',
				'aside',
				'gallery',
				'image',
				'quote',
				'status',
				'video',
				'audio',
				'chat',
			]
		);

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		/*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
		add_theme_support(
			'html5',
			[
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
				'navigation-widgets',
			]
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Add support for custom line height controls.
		add_theme_support( 'custom-line-height' );

		// Add support for experimental link color control.
		add_theme_support( 'experimental-link-color' );

		// Add support for experimental cover block spacing.
		add_theme_support( 'custom-spacing' );

		add_theme_support( 'editor-color-palette', array(
			array(
				'name'  => __( 'Cyan', 'school' ),
				'slug'  => "color-cyan",
				'color' => '#1995AD',
			)
		) );

		/**
		 * Register custom nav menus
		 */
		register_nav_menus(
			[
				'primary' => esc_html__( 'Primary menu', 'starter-theme' ),
				'footer'  => esc_html__( 'Footer menu', 'starter-theme' ),
			]
		);

	}
}
add_action( 'after_setup_theme', 'swpt_setup' );


/**
 * Insert hmr into head for live reload
 *
 * @return void
 */
function swpt_vite_head_module(): void {
	if ( wp_get_environment_type() === 'development' ) {
		echo '<script type="module" src="' . VITE_SERVER . VITE_ENTRY_POINT . '"></script>';
	}
}

add_action( 'wp_head', 'swpt_vite_head_module' );

/**
 * Insert hmr into admin head for live reload
 * Important! This will reload the entire admin page on style/script change. Use only when styling admin pages, do not use when editing content.
 *
 * @return void
 */
function swpt_vite_admin_head_module(): void {
	if ( wp_get_environment_type() === 'development' ) {
		echo '<script type="module" src="' . VITE_SERVER . '/source/admin.js' . '"></script>';
	}
}

add_action( 'admin_head', 'swpt_vite_admin_head_module' );


/**
 * Enqueue scripts and styles.
 *
 * @return void
 * @throws JsonException
 * @since 1.0.0
 *
 */
function swpt_scripts(): void {
	if ( wp_get_environment_type() !== 'development' ) {
		$theme_version = wp_get_theme()->get( 'Version' );

		wp_enqueue_style( 'starter-theme-styles', swpt_vite_asset( 'source/main.css' ), [], $theme_version );
		wp_enqueue_script( 'starter-theme-scripts', swpt_vite_asset( 'source/main.js' ), [], $theme_version, true );
	}

	/**
	 * Remove default WP styles
	 */
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
	wp_dequeue_style( 'wc-blocks-style' );
	wp_dequeue_style( 'classic-theme-styles' );
}

add_action( 'wp_enqueue_scripts', 'swpt_scripts' );

/**
 * Enqueue admin scripts and styles.
 *
 * @return void
 * @throws JsonException
 * @since 1.0.0
 */
function swpt_admin_scripts(): void {
	if ( wp_get_environment_type() !== 'development' ) {
		$theme_version = wp_get_theme()->get( 'Version' );

		wp_enqueue_style( 'starter-theme-admin-styles', swpt_vite_asset( 'source/admin.css' ), [], $theme_version );
		wp_enqueue_script( 'starter-theme-admin-scripts', swpt_vite_asset( 'source/admin.js' ), [], $theme_version, true );
	}
}

add_action( 'admin_enqueue_scripts', 'swpt_admin_scripts' );

/**
 * Defer loading of JavaScript assets
 *
 * @param $tag
 * @param $handle
 *
 * @return array|mixed|string|string[]
 */
function swpt_defer_scripts( $tag, $handle ): mixed {
	$excluded = [
		'jquery-core',
		'jquery-migrate',
	];

	if ( is_admin() || swpt_is_login_page() || in_array( $handle, $excluded, true ) ) {
		return $tag;
	}

	return str_replace( 'src', 'defer src', $tag );
}

add_filter( 'script_loader_tag', 'swpt_defer_scripts', 10, 2 );

/**
 * Add "is-IE" class to body if the user is on Internet Explorer.
 *
 * @return void
 * @since 1.0.0
 *
 */
function swpt_add_ie_class(): void {
	?>
	<script>
		if (-1 !== navigator.userAgent.indexOf('MSIE') || -1 !== navigator.appVersion.indexOf('Trident/')) {
			document.body.classList.add('is-IE');
		}
	</script>
	<?php
}

add_action( 'wp_footer', 'swpt_add_ie_class' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 * @since 1.0.0
 *
 */
function swpt_body_classes( array $classes ): array {

	// Helps detect if JS is enabled or not.
	$classes[] = 'no-js';

	return $classes;
}

add_filter( 'body_class', 'swpt_body_classes' );

/**
 * Adds custom class to the array of posts classes.
 *
 * @param array $classes An array of CSS classes.
 *
 * @return array
 * @since 1.0.0
 *
 */
function swpt_post_classes( array $classes ): array {
	$classes[] = 'entry';

	return $classes;
}

add_filter( 'post_class', 'swpt_post_classes', 10, 3 );

/**
 * Remove the `no-js` class from body if JS is supported.
 *
 * @return void
 * @since 1.0.0
 *
 */
function swpt_supports_js(): void {
	echo '<script>document.body.classList.remove("no-js");</script>';
}

add_action( 'wp_footer', 'swpt_supports_js' );

/**
 * Add SVG support to media uploader
 *
 * @param $mimes
 *
 * @return array
 */
function swpt_mime_types( $mimes ): array {
	$mimes['svg'] = 'image/svg+xml';

	return $mimes;
}

add_filter( 'upload_mimes', 'swpt_mime_types' );

/**
 * Add required validation to ACF fields in Gutenberg
 *
 * @return void
 */
function swpt_validate_acf_fields(): void {
	foreach ( $_POST as $key => $value ) {
		if ( ! empty( $value ) && str_starts_with( $key, 'acf' ) ) {
			acf_validate_values( $value, $key );
		}
	}
}

add_action( 'acf/validate_save_post', 'swpt_validate_acf_fields', 5 );

/**
 * Clean up WordPress default tags, styles and scripts
 *
 * @return void
 */
function swpt_cleanup(): void {
	/**
	 * Cleanup <head> from unneeded stuff
	 */
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'feed_links_extra', 3 );
	remove_action( 'wp_head', 'feed_links', 2 );
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'wp_shortlink_wp_head' );
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head' );
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	remove_action( 'wp_head', 'adjacent_post_rel_link_wp_head', 10, 0 );

	/**
	 * Remove emoji support
	 */
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );

	/**
	 * Removes oembed discovery links
	 */
	remove_action( 'wp_head', 'rest_output_link_wp_head' );
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
	remove_action( 'wp_head', 'wp_oembed_add_host_js' );

	/**
	 * Remove unwanted SVG filter injection WP
	 */
	remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
	remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );
}

add_action( 'init', 'swpt_cleanup' );

/**
 * Restrict blocks for specific Post types
 *
 * @param bool|array $allowed_blocks
 * @param WP_Block_Editor_Context $editor_context
 *
 * @return bool|array
 */
function school_allowed_block_types( bool|array $allowed_blocks, WP_Block_Editor_Context $editor_context ): bool|array {
	return array(
		'acf/accordion',
		'acf/contacts',
		'acf/entities-grid',
		'acf/files',
		'acf/gallery',
		'acf/hero',
		'acf/rich-text',
		'acf/text-form',
		'acf/text-image',
	);
}

add_filter( 'allowed_block_types_all', 'school_allowed_block_types', 10, 2 );

/**
 * Disable autop for Contact Form 7 Forms
 */
add_filter( 'wpcf7_autop_or_not', '__return_false' );

/**
 * @param array $vars
 *
 * @return array
 */
function school_add_query_vars( array $vars ): array {
	$vars[] = 'sign-in';
	$vars[] = 'sign-up';
	$vars[] = 'profile';
	$vars[] = 'testing';
	$vars[] = 'internal-exam';

	return $vars;
}

add_filter( 'query_vars', 'school_add_query_vars' );


/**
 * @return void
 */
function school_add_rewrite_rule(): void {
	add_rewrite_rule( '^sign-in?', 'index.php?sign-in=1', 'top' );
	add_rewrite_rule( '^sign-up?', 'index.php?sign-up=1', 'top' );
	add_rewrite_rule( '^profile?', 'index.php?profile=1', 'top' );
	add_rewrite_rule( '^testing?', 'index.php?testing=1', 'top' );
	add_rewrite_rule( '^internal-exam?', 'index.php?internal-exam=1', 'top' );

}

add_action( 'init', 'school_add_rewrite_rule' );

/**
 * @param string $template
 *
 * @return string
 */
function school_template_include( string $template ): string {
	if ( get_query_var( 'sign-in' ) && file_exists( WP_CONTENT_DIR . '/themes/school/templates/sign-in.php' ) ) {
		return WP_CONTENT_DIR . '/themes/school/templates/sign-in.php';
	}

	if ( get_query_var( 'sign-up' ) && file_exists( WP_CONTENT_DIR . '/themes/school/templates/sign-up.php' ) ) {
		return WP_CONTENT_DIR . '/themes/school/templates/sign-up.php';
	}

	if ( get_query_var( 'profile' ) && file_exists( WP_CONTENT_DIR . '/themes/school/templates/profile.php' ) ) {
		return WP_CONTENT_DIR . '/themes/school/templates/profile.php';
	}

	if ( get_query_var( 'testing' ) && file_exists( WP_CONTENT_DIR . '/themes/school/templates/testing.php' ) ) {
		return WP_CONTENT_DIR . '/themes/school/templates/testing.php';
	}

	if ( get_query_var( 'internal-exam' ) && file_exists( WP_CONTENT_DIR . '/themes/school/templates/internal-exam.php' ) ) {
		return WP_CONTENT_DIR . '/themes/school/templates/internal-exam.php';
	}

	return $template;
}

add_filter( 'template_include', 'school_template_include', 100, 1 );

/**
 * @param array $title_parts
 *
 * @return array
 */
function school_modify_page_title( array $title_parts ): array {
	global $wp;

	// Page Title for Sign-up template
	if ( home_url( $wp->request ) === home_url() . '/sign-up' ) {
		$title_parts['title'] = 'Реєстрація - ' . $title_parts['title'];
	}

	// Page Title for Sign-in template
	if ( home_url( $wp->request ) === home_url() . '/sign-in' ) {
		$title_parts['title'] = 'Увійти - ' . $title_parts['title'];
	}

	// Page Title for Profile template
	if ( home_url( $wp->request ) === home_url() . '/profile' ) {
		$title_parts['title'] = 'Кабінет - ' . $title_parts['title'];
	}

	// Page Title for Testing template
	if ( home_url( $wp->request ) === home_url() . '/testing' ) {
		$title_parts['title'] = 'Тестування - ' . $title_parts['title'];
	}

	// Page Title for Internal exam template
	if ( home_url( $wp->request ) === home_url() . '/internal-exam' ) {
		$title_parts['title'] = 'Внутрішній іспит - ' . $title_parts['title'];
	}

	return $title_parts;
}

add_filter( 'document_title_parts', 'school_modify_page_title' );

/**
 * @return void
 */
function school_on_theme_deactivate(): void {
	remove_role( 'student' );
}

add_action( 'switch_theme', 'school_on_theme_deactivate' );

/**
 * @return void
 */
function school_on_theme_activate(): void {
	add_role( 'student', __( 'Student', 'school;' ), array(
			'take_course' => true,
		)
	);
}

add_action( 'after_switch_theme', 'school_on_theme_activate' );

/**
 * @return string
 */
function school_default_group_title_filter(): string {
	global $post_type;
	if ( 'group' === $post_type ) {

		return date( 'd-m-Y' );
	}

	return '';
}

add_filter( 'default_title', 'school_default_group_title_filter' );

if ( ! current_user_can( 'manage_options' ) ) {
	add_filter( 'show_admin_bar', '__return_false' );
}

/**
 * @param WP_User $user
 *
 * @return array
 */
function school_get_user_study_state( WP_User $user ): array {
	$user_study_state = get_user_meta( $user->ID, 'user_study_state', true ) ?: array();

	return is_array( $user_study_state ) ? $user_study_state : array();
}

/**
 * @param WP_User $user
 *
 * @return void
 */
function school_update_user_study_state( WP_User $user ): void {
	$user_study_state = get_user_meta( $user->ID, 'user_study_state', true ) ?: array();

	if ( ! is_array( $user_study_state ) ) {
		$user_study_state = array();
	}

	$chapters = get_terms( array(
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

				$user_study_state[ $chapter->term_id ] = array(
					'id'              => $chapter->term_id,
					'count_questions' => is_countable( $questions ) ? count( $questions ) : 0,
					'best_result'     => isset( $user_study_state[ $chapter->term_id ] ) ? $user_study_state[ $chapter->term_id ]['best_result'] : 0,
					'count_passed'    => isset( $user_study_state[ $chapter->term_id ] ) ? $user_study_state[ $chapter->term_id ]['count_passed'] : 0
				);
			}
		}
	}

	update_user_meta( $user->ID, 'user_study_state', $user_study_state );
}

/**
 * @param array $cats
 * @param array $into
 * @param int $parent_id
 *
 * @return void
 */
function school_sort_terms_hierarchically( array &$cats, array &$into, int $parent_id = 0 ): void {
	foreach ( $cats as $i => $cat ) {
		if ( $cat->parent == $parent_id ) {
			$into[ $cat->term_id ] = $cat;
			unset( $cats[ $i ] );
		}
	}

	foreach ( $into as $topCat ) {
		$topCat->children = array();
		school_sort_terms_hierarchically( $cats, $topCat->children, $topCat->term_id );
	}
}

function school_get_hierarchical_chapters(): array {
	$chapters = get_terms( array(
		'taxonomy'   => 'chapter',
		'hide_empty' => false,
		'orderby'    => 'id',
	) );

	if ( ! empty( $chapters ) ) {
		$sorted_chapters = array();
		school_sort_terms_hierarchically( $chapters, $sorted_chapters );

		return $sorted_chapters;
	}

	return array();
}
