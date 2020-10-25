<?php
/**
 * Enqueue assets.
 *
 * @package wpajax-landing
 */

namespace WPAndAjax\Includes;

/**
 * Enqueue class.
 */
class Enqueue {

	/**
	 * Class runner.
	 *
	 * @since 1.0.0
	 */
	public function run() {
		add_action( 'enqueue_block_editor_assets', array( $this, 'editor_enqueue_assets' ) );
	}

	/**
	 * Enqueue block assets.
	 *
	 * @since 1.0.0
	 */
	public function editor_enqueue_assets() {
		// Register the block script.
		wp_enqueue_script(
			'wpajax-gutenberg-sidebar',
			WPAJAX_LANDING_URL . 'dist/sidebar.js',
			array(
				'wp-blocks',
				'wp-i18n',
				'wp-element',
				'wp-editor',
				'wp-plugins',
				'wp-edit-post',
				'wp-data',
			),
			WPAJAX_LANDING_VERSION,
			true
		);

		wp_set_script_translations(
			'wpajax-gutenberg-sidebar',
			'landing-page-gutenberg-template',
			WPAJAX_LANDING_DIR . 'languages/'
		);
	}
}
