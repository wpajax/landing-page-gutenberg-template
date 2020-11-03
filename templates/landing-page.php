<?php
/**
 * Template inclusion file template.
 *
 * @package wpandajax
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'you are way off' );
}
global $post;
?>
<!doctype html>

<html lang="en">
	<head>
		<meta charset="utf-8">

		<?php
		/**
		 * Perform any actions before the wp_head hook.
		 *
		 * @since 1.0.0
		 */
		do_action( 'wpajax_twenty_twenty_one_before_header' );

		wp_head();

		/**
		 * Perform any actions before the wp_head hook.
		 *
		 * @since 1.0.0
		 */
		do_action( 'wpajax_twenty_twenty_one_after_header' );

		// Get background color change.
		$maybe_change_background_color = get_post_meta( $post->ID, '_wpajax_set_body_color', true );
		if ( $maybe_change_background_color ) {
			if ( 7 === strlen( $maybe_change_background_color ) ) {
				?>
				<style>
					body {
						background-color: <?php echo esc_html( $maybe_change_background_color ); ?> !important;
					}
				</style>
				<?php
			}
		}
		?>
	</head>
	<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
		<?php
			echo do_blocks( $post->post_content );
			wp_footer();
		?>
	</body>
</html>
