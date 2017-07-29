<?php
/**
 * Template Name: Contact
 */

get_header(); ?>
<div id="content-vw" class="container">
    <div class="middle-align">	
		<div class="col-md-4 contact-info">
			<h3><?php echo __("FIND US HERE","vw-hospital-lite"); ?></h3>
			<div class="contact-location">
				<span class="head"><?php echo __("LOCATION 1:","vw-hospital-lite"); ?></span> <br>
 					<?php echo get_theme_mod('vw_hospital_lite_contact_add',''); ?>
 			</div>	
			<div class="contact-call">
				<span class="head"><?php echo __("SUPPORT CALL:","vw-hospital-lite"); ?></span> <br>
					<?php echo esc_html( get_theme_mod('vw_hospital_lite_contact_call','') ); ?>
			</div>			
			<div class="contact-email">
				<span class="head"><?php echo __("EMAIL ADDRESS","vw-hospital-lite"); ?></span> <br>
				<?php echo esc_html( antispambot( get_theme_mod('vw_hospital_lite_contact_email','') ) ); ?>
			</div>
		</div>       
		<div class="col-md-8">
			<?php while ( have_posts() ) : the_post(); ?>
				<h1><?php the_title();?></h1>
                <?php the_content();?>                
            <?php endwhile; // end of the loop. ?>          
        </div>        
        <div class="clear"></div>    
	</div>
</div>
<?php get_footer(); ?>