<?php
/**
 * Overrides the page/singular template.
 *
 * @package wpajax
 */

namespace WPAndAjax\Includes;

/**
 * Loads in the right template file based on the post meta options.
 */
class Template {
	/**
	 * Class runner.
	 *
	 * @since 1.0.0
	 */
	public function run() {
		add_filter( 'template_include', array( $this, 'maybe_load_template' ) );
	}

	/**
	 * Load a custom full-screen template for the twentty twenty one theme.
	 *
	 * @param string $template Template to be loaded from theme.
	 */
	public function maybe_load_template( $template ) {
		if ( is_admin() || is_admin() && defined( 'DOING_AJAX' ) && DOING_AJAX ) {
			return $template;
		}
		// Make sure we're at the right level of content.
		if ( ! is_page() && ! is_singular() ) {
			return $template;
		}

		// Get the post ID. Could also use get_queried_object_id? Less reliable IMO.
		global $post;
		if ( ! isset( $post->ID ) ) {
			return $template;
		}
		$post_id = $post->ID;

		// Try to get post meta. False so we expect an array.
		$maybe_enable_landing_page_template = get_post_meta( $post_id, '_wpajax_enable_landing_template', false );

		// If post ID is invalid, get_post_meta should return false. Return.
		if ( ! $maybe_enable_landing_page_template && ! is_array( $maybe_enable_landing_page_template ) ) {
			return $template;
		}

		// Array check.
		if ( ! is_array( $maybe_enable_landing_page_template ) ) {
			return $template;
		}

		// Now lets get the first value of the array.
		$maybe_post_meta_value = false;
		if ( isset( $maybe_enable_landing_page_template[0] ) ) {
			$maybe_post_meta_value = current( $maybe_enable_landing_page_template );
		}

		// Validate boolean.
		$maybe_post_meta_value = filter_var( $maybe_post_meta_value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE );
		if ( is_null( $maybe_post_meta_value ) || false === $maybe_post_meta_value ) {
			return $template;
		}

		$maybe_template = WPAJAX_LANDING_DIR . 'templates/landing-page.php';

		if ( file_exists( $maybe_template ) ) {
			return $maybe_template;
		}

		return $template;
	}
}
