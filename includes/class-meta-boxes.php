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
				'sanitize_callback' => 'rest_sanitize_boolean',
				'show_in_rest'      => true,
				'type'              => 'boolean',
				'auth_callback'     => function () {
					return current_user_can( 'edit_posts' );
				},
			)
		);

		/**
		 * Meta for background color of landing page (optional)
		 */
		register_post_meta(
			'',
			'_wpajax_set_body_color',
			array(
				'sanitize_callback' => 'sanitize_text_field',
				'show_in_rest'      => true,
				'single'            => true,
				'type'              => 'string',
				'auth_callback'     => function () {
					return current_user_can( 'edit_posts' );
				},
			)
		);
	}
}
