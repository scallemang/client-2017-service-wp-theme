<?php

add_action( 'wp_enqueue_scripts', 'salient_child_enqueue_styles');

function salient_child_enqueue_styles() {

    wp_enqueue_style( 'parent-style',
        get_template_directory_uri() . '/style.css',
        array('font-awesome')
    );

    wp_enqueue_style('child-style',
        get_stylesheet_directory_uri() . '/assets/css/style.css'
    );

    wp_enqueue_script('child-scripts',
        get_stylesheet_directory_uri() . '/assets/js/script.js',
        array('jquery'),
        NULL,
        true
    );

    if ( is_rtl() ) {
        wp_enqueue_style(  'salient-rtl',
            get_template_directory_uri(). '/rtl.css',
            array(),
            '1',
            'screen'
        );
    }
}

?>