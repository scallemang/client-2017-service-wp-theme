<?php
/**
 * The template for displaying home page.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package VW Hospital Lite
 */

get_header(); ?>

<?php /*--OUR SERVICES--*/?>
<section id="our-services">
	<div class="innerlightbox">
		<div class="container">  
			<div class="col-md-8">
			<?php if ( have_posts() ) :
	        /* Start the Loop */
	          while ( have_posts() ) : the_post(); ?>
					<div class="page-box">
		            	<h4><a href="<?php echo esc_url(get_permalink()); ?>" title="<?php the_title_attribute(); ?>"><?php the_title();?></a></h4>	
						<div class="date-box"><?php the_time( get_option( 'date_format' ) ); ?></div>
						
						<div class="box-image">
						  <?php 
							if(has_post_thumbnail()) { 
							  the_post_thumbnail(); 
							}
						  ?>
						
						</div>
						
		           		<div class="box-content">
							<?php the_excerpt();?>
						</div>
						
						<div class="cat-box">
							<?php foreach((get_the_category()) as $category) { echo $category->cat_name . ' '; } ?>
						</div>
		        	</div>
				
			        <?php endwhile; ?>
					<div class="navigation">
					<?php
	                    // Previous/next page navigation.
	                    the_posts_pagination( array(
	                        'prev_text'          => __( 'Previous page', 'vw-hospital-lite' ),
	                        'next_text'          => __( 'Next page', 'vw-hospital-lite' ),
	                        'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'vw-hospital-lite' ) . ' </span>',
	                    ) );
	                ?>
		    	</div>
			  </div>
			  <div class="col-md-3 col-md-offset-1">
				<?php get_sidebar('page'); ?>
			  </div>
	            
	          <?php else :
	            get_template_part( 'no-results', 'archive' ); 
	          endif; 
	      ?>  
  		</div> 
    </div>
</section>
<?php get_footer(); ?>