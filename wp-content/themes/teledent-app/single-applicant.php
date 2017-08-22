<?php
	// Form and Header setup
		acf_form_head(); 
		get_header(); 
		acf_enqueue_uploader();
	
	//Validate if this user can access this profile
	if(var_profile_access()) :
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
								'submit_value'	=> 'Create my account',
								'return' => '/dashboard'
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
		echo '<script>window.location = "/registration";</script>';
	}
	get_footer(); 
?>