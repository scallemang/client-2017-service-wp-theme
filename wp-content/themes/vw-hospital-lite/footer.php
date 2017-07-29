<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package VW Hospital Lite
 */
?>
    <div class="footer1">
      <div class="footer-content">
        <div class="container">
          <div class="row footer-sec">
          <?php if( esc_html(get_theme_mod('vw_hospital_lite_contact_info_footer','')) != '' || esc_html( get_theme_mod('vw_hospital_lite_contact_add','') ) != '' || esc_html( get_theme_mod('vw_hospital_lite_contact_call','') ) != '' || esc_html( get_theme_mod('vw_hospital_lite_contact_email','') ) ) { ?>
              <div class="col-md-3">
                <div class="contact-info-footer">
                  
                  <div class="section-title"><h5><?php echo esc_html(get_theme_mod('vw_hospital_lite_contact_info_footer','')); ?></h5></div>

                  <?php if(esc_html( get_theme_mod('vw_hospital_lite_contact_add','') ) != '') { ?>

                    <p><span class="dashicons dashicons-location"></span> <?php echo esc_html( get_theme_mod('vw_hospital_lite_contact_add','')); ?></p>

                  <?php }  if(esc_html( get_theme_mod('vw_hospital_lite_contact_call','') ) != '') { ?>
                  <p><span class="dashicons dashicons-phone"></span> <?php echo esc_html( get_theme_mod('vw_hospital_lite_contact_call','') ); ?></p>
                  
                  <?php } if(esc_html( get_theme_mod('vw_hospital_lite_contact_email','') ) != '') { ?>
                    <p><span class="dashicons dashicons-email-alt"></span> <?php echo esc_html( get_theme_mod('vw_hospital_lite_contact_email','')); ?></p>
                  <?php } ?>
                    
                </div>
              </div>
            <?php  $vw_hospital_lite_div_width = 3;
             } else { $vw_hospital_lite_div_width = 4; } ?>

            <div class="col-md-<?php echo intval($vw_hospital_lite_div_width); ?>">
              <div class="why-choose-us">
                <div class="section-title">
                  <?php dynamic_sidebar( 'footer-1' ); ?> 
                </div>                    
              </div>
            </div>
            <div class="col-md-<?php echo intval($vw_hospital_lite_div_width); ?>">
              <div class="latest-event">
                <?php dynamic_sidebar( 'footer-2' ); ?>
              </div>
            </div>
            <div class="col-md-<?php echo intval($vw_hospital_lite_div_width); ?>">
              <div class="subs-newletter">
                <?php dynamic_sidebar( 'footer-3' ); ?>        
              </div>
              <div class="clear"></div>
            </div>
        </div>
      </div>
      <div class="inner">
          <div class="copyright text-center">
            <p><?php echo esc_html( get_theme_mod('vw_hospital_lite_footer_copy','') ); ?> <?php _e('Design & Developed by ','vw-hospital-lite'); ?><a href="http://www.vwthemes.com" target="_blank"><?php _e('VWThemes','vw-hospital-lite'); ?></a></p>               
          </div>
          <div class="clear"></div>           
      </div>
    </div>
    <?php wp_footer(); ?>
  </body>
</html>