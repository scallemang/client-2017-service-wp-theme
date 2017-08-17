<?php
	function apidemo_scripts() {
		if(is_page('restapi')) {
			wp_enqueue_script(
				'teledent-api',
				get_stylesheet_directory_uri() . '/inc/json-api.js',
				array('wp-api', 'jquery'),
				time(),
				true
			);
		}
	}
	add_action( 'wp_enqueue_scripts', 'apidemo_scripts') ;

	function local_script_rest() {
		wp_localize_script( 
			'wp-api', 
			'wpApiSettings', 
			array(
		    'root' => esc_url_raw( rest_url() ),
		    'nonce' => wp_create_nonce( 'wp_rest' )
		) );
	}

	add_action( 'wp_enqueue_scripts', 'local_script_rest' );
	add_action( 'admin_enqueue_scripts', 'local_script_rest' );

?>