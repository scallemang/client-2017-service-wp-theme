<?php
/**
 * @package WordPress
 * @subpackage Highend
 */
/*
Template Name: Registration Template
*/
?>
<?php get_header(); ?>

<?php if ( have_posts() ) : while (have_posts()) : the_post(); ?>

	<!-- BEGIN #main-content -->
<div id="main-content" ng-app="teledent">
	<div class="container">
		<div class="row main-row">
			<div id="page-<?php the_ID(); ?>" <?php post_class('col-12'); ?>>
				<?php 
					the_content();
					include(locate_template('templates/registration.php'));	
				?>
			</div>
			
		</div>
		<!-- END .row -->
	</div>
	<!-- END .container -->
</div>
<!-- END #main-content -->

<?php endwhile; endif; ?>
<?php get_footer(); ?>