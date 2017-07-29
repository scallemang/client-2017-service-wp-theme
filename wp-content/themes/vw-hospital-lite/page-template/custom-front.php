<?php
/**
 * Template Name: Custom Home
 */

get_header(); ?>

<?php /** slider section **/ ?>
	<?php
		// Get pages set in the customizer (if any)
		$pages = array();
		for ( $count = 1; $count <= 5; $count++ ) {
		$mod = intval( get_theme_mod( 'vw_hospital_lite_slidersettings-page-' . $count ));
		if ( 'page-none-selected' != $mod ) {
		  $pages[] = $mod;
		}
		}
		if( !empty($pages) ) :
		  $args = array(
		    'posts_per_page' => 5,
		    'post_type' => 'page',
		    'post__in' => $pages,
		    'orderby' => 'post__in'
		  );
		  $query = new WP_Query( $args );
		  if ( $query->have_posts() ) :
		    $count = 1;
		    ?>
			<div class="slider-main">
		    	<div id="slider" class="nivoSlider">
			      <?php
			        $vw_hospital_lite_n = 0;
					while ( $query->have_posts() ) : $query->the_post();
					  
					  $vw_hospital_lite_n++;
					  $vw_hospital_lite_slideno[] = $vw_hospital_lite_n;
					  $vw_hospital_lite_slidetitle[] = get_the_title();
					  $vw_hospital_lite_slidelink[] = esc_url(get_permalink());
					  ?>
					    <img src="<?php the_post_thumbnail_url('full'); ?>" title="#slidecaption<?php echo esc_attr( $vw_hospital_lite_n ); ?>" />
					  <?php
					$count++;
					endwhile;
			      ?>
			    </div>

		    <?php
		    $vw_hospital_lite_k = 0;
		      foreach( $vw_hospital_lite_slideno as $vw_hospital_lite_sln ){ ?>
		      <div id="slidecaption<?php echo esc_attr( $vw_hospital_lite_sln ); ?>" class="nivo-html-caption">
		        <div class="slide-cap  ">
		          <div class="container">
		            <h2><?php echo esc_html($vw_hospital_lite_slidetitle[$vw_hospital_lite_k] ); ?></h2>
		            <a class="read-more" href="<?php echo esc_url($vw_hospital_lite_slidelink[$vw_hospital_lite_k] ); ?>"><?php _e( 'Learn More','vw-hospital-lite' ); ?></a>
		          </div>
		        </div>
		      </div>
		        <?php $vw_hospital_lite_k++;
		    	wp_reset_postdata();
		    } ?>
			</div>
		    <?php else : ?>
		      <div class="header-no-slider"></div>
		    <?php
		  endif;
		endif;
	?>

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