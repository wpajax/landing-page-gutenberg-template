<?php
/**
 * Add meta boxes to post types.
 *
 * @package wpajax
 */

namespace WPAndAjax\Includes;

/**
 * Meta Box class
 */
class Meta_Boxes {
	/**
	 * Class runner.
	 *
	 * @since 1.0.0
	 */
	public function run() {
		add_action( 'init', array( $this, 'register_meta_boxes' ) );
	}

	/**
	 * Register Meta Boxes.
	 */
	public function register_meta_boxes() {
		/**
		 * Meta for enabling/disabling the full-screen template.
		 */
		register_post_meta(
			'',
			'_wpajax_enable_landing_template',
			array(
				'show_in_rest'  => true,
				'type'          => 'boolean',
				'auth_callback' => function () {
					return current_user_can( 'edit_posts' );
				},
			)
		);

		/**
		 * Meta for enabling/disabling the theme's stylesheet (optional).
		 */
		register_post_meta(
			'',
			'_wpajax_disable_theme_stylesheet',
			array(
				'show_in_rest'  => true,
				'type'          => 'boolean',
				'auth_callback' => function () {
					return current_user_can( 'edit_posts' );
				},
			)
		);

		/**
		 * Meta for body class to add (optional).
		 */
		register_post_meta(
			'',
			'_wpajax_set_body_class',
			array(
				'show_in_rest'  => true,
				'type'          => 'string',
				'auth_callback' => function () {
					return current_user_can( 'edit_posts' );
				},
			)
		);

		/**
		 * Meta for background color of landing page (optional)
		 */
		register_post_meta(
			'',
			'_wpajax_set_body_class',
			array(
				'show_in_rest'  => true,
				'type'          => 'string',
				'auth_callback' => function () {
					return current_user_can( 'edit_posts' );
				},
			)
		);

		/**
		 * Meta for mode. Values are email_only, email_multiple, email_tld, email_collection.
		 */
		register_post_meta(
			'',
			'_effmr_mode',
			array(
				'show_in_rest'  => true,
				'type'          => 'string',
				'auth_callback' => function () {
					return current_user_can( 'edit_posts' );
				},
			)
		);
	}
}
