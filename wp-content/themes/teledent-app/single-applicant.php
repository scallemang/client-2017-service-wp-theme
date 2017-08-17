<?php acf_form_head(); ?>
<?php get_header(); ?>

<?php if ( have_posts() ) : while (have_posts()) : the_post(); ?>
<!-- BEGIN #main-content -->
<div id="main-content">
	<div class="container" >
		<div class="row main-row">
			<div id="page-<?php get_the_ID(); ?>" <?php post_class('col-12'); ?>>
				<?php 

					acf_form(array(
						'post_id'	=> get_the_ID(),
						'post_title'	=> false,
						'submit_value'	=> 'Update the post!'
					));  
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