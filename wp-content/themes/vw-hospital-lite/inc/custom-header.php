<?php
/**
 * @package VW Hospital Lite
 * Setup the WordPress core custom header feature.
 *
 * @uses vw_hospital_lite_header_style()
*/

if ( ! function_exists( 'vw_hospital_lite_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see vw_hospital_lite_custom_header_setup().
 */
function vw_hospital_lite_header_style() {
	$header_text_color = get_header_textcolor();
	?>
	<style type="text/css">
	<?php
		//Check if user has defined any header image.
		if ( get_header_image() ) :
	?>
		.header{
			background: url(<?php echo get_header_image(); ?>) no-repeat;
			background-position: center top;
		}
	<?php endif; ?>	
	</style>
	<?php
}
endif; // vw_hospital_lite_header_style