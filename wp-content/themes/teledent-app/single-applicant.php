<?php acf_form_head(); ?>
<?php get_header(); ?>

<h2> Single Applicant</h2>

<?php if ( have_posts() ) : while (have_posts()) : the_post(); ?>
<!-- BEGIN #main-content -->
<div id="main-content">
	<div class="container" >
		<div class="row main-row">
			<div id="page-<?php the_ID(); ?>" <?php post_class('col-12'); ?>>
				<?php 

					the_field('first_name'); 
					the_field('last_name'); 

					acf_form(array(
						'post_id'	=> the_ID(),
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