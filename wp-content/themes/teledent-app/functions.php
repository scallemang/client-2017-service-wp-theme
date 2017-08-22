<?php

	//ACF don't allow JavaScript
	function my_kses_post( $value ) {
		// is array
		if( is_array($value) ) {
			return array_map('my_kses_post', $value);
		
		}	
		// return
		return wp_kses_post( $value );
	}
	add_filter('acf/update_value', 'my_kses_post', 10, 1);

    //G'day, the functions are wired up here
    include('inc/enqueue.php'); // include scripts and styles in wp template
    include('inc/post-types.php'); // build post-types
    include('inc/json-api.php'); //sam's playground for now.
    include('inc/utilities.php'); // php text functions for content handling   
    include('inc/ajax-fn-registration.php'); //registration process ajax functions
    include('inc/auth.php'); //handle site security for sections of the site

?>