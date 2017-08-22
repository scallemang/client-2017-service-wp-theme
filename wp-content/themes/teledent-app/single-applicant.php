<?php acf_form_head(); ?>
<?php get_header(); 

	$loggedIn = wp_get_current_user(); 
	$postAuthor = get_the_author_meta('ID');
	$isAdmin = isset($loggedIn->caps['administrator']);

	if($loggedIn->ID === $postAuthor || $isAdmin ) {
		if ( have_posts() ) : while (have_posts()) : the_post(); ?>
		<!-- BEGIN #main-content -->
		<div id="main-content">
			<div class="container" >
				<div class="row main-row">
					<div id="page-<?php get_the_ID(); ?>" <?php post_class('col-12'); ?>>
						<?php 
							acf_form(array(
								'post_id'	=> get_the_ID(),
								'post_title'	=> false,
								'submit_value'	=> 'Create my account'
							));  
						?>      
					</div>
				</div>
				<!-- END .row -->
			</div>
			<!-- END .container -->
		</div>
		<!-- END #main-content -->
		<?php endwhile; endif; 
	} else {
		//echo '<script>window.location = "/registration";</script>';
	}
?>
<?php get_footer(); ?>