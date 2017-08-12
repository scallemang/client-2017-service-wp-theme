<?php
    
    add_action( 'wp_enqueue_scripts', 'salient_child_enqueue_styles');

    function salient_child_enqueue_styles() {

        //Enherit Salient styles
        wp_enqueue_style( 'parent-style',
            get_template_directory_uri() . '/style.css',
            array('font-awesome')
        );

        if ( is_rtl() ) {
            wp_enqueue_style(  'salient-rtl',
                get_template_directory_uri(). '/rtl.css',
                array(),
                '1',
                'screen'
            );
        }

        //Enqueue Theme Styles
        wp_enqueue_style( 'teledent-bootstrap', 
        	get_stylesheet_directory_uri() . '/dist/css/bootstrap.css', 
        	false); 
        
        wp_enqueue_style( 'teledent-bootstrap-theme', 
        	get_stylesheet_directory_uri() .  '/dist/css/bootstrap-theme.css', 
        	false ); 
        
        wp_enqueue_style( 'teledent-styles', 
        	get_stylesheet_directory_uri() .  '/dist/css/screen.css' );

        //Enqueue Theme Scripts
        wp_enqueue_script( 'teledent-deps', 
        	get_stylesheet_directory_uri() . '/dist/js/plugins.js', 
        	false );

        wp_enqueue_script( 'teledent-main', 
        	get_stylesheet_directory_uri() . '/dist/js/main.js', 
        	false );

    }
 ?>