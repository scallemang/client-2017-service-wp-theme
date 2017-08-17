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
?>