<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package VW Hospital Lite
 */

get_header(); ?>

	<content ng-app="teledent">

		<?php echo do_shortcode('[form-login]'); ?>

	</content>

<?php get_footer(); ?>
