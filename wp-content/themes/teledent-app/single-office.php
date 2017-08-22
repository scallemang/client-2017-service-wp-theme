<?php
	// Form and Header setup
		acf_form_head(); 
		get_header(); 
		acf_enqueue_uploader();
	
	//Validate if this user can access this profile
	if(var_profile_access()) :
		if ( have_posts() ) : while (have_posts()) : the_post(); 

	
	//FORM SAVE


	function my_acf_save_post( $post_id ) {
	    
	    // get new value
	    $value = get_field('my_field');
	    
	    
	    // do something
	    echo '<script>alert("After submit")</script>';

	}

	add_action('acf/save_post', 'my_acf_save_post', 20);


	?>
		
		<div id="main-content">
			<div class="container" >
				<?php include(locate_template('templates-parts/profile-subnav.php')); ?>
				<div class="row main-row">
					<div id="page-<?php get_the_ID(); ?>" <?php post_class('col-12'); ?>>
						<?php 
							acf_form(array(
								'post_id'	=> get_the_ID(),
								'post_title'	=> false,
								'submit_value'	=> __("Create my account", 'acf'),
									'html_submit_button'	=> '<input type="submit" class="acf-button button button-primary button-large" value="%s" />',
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
	else: ?>
		<div id="main-content">
			<div class="container" >
				<div class="row main-row">
					<div id="page-<?php get_the_ID(); ?>" <?php post_class('col-12'); ?>>
						<h2>Ooops...</h2>
						<p>This page is private. You are either not logged in, or not authorized to see this profile.</p>
						<p>You will be redirected shortly, or view the <a href="/">homepage</a>.</p>       
					</div>
				</div>
				<!-- END .row -->
			</div>
			<!-- END .container -->
		</div>
	<?php endif;
	get_footer(); 
?>