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

	//FORM SAVE - POST
	function my_acf_save_post( $post_id ) {   

			// bail early if no ACF data
			if( empty($_POST['acf']) ) {		    
			    return;
			}

			// array of field values
			$fields = $_POST['acf'];
			$user = wp_get_current_user();

			// var_dump($fields);

            // Sync User/Post       
            if(isset($fields['field_5995a94c94b13'])):
	            wp_update_user(
	                array(
	                    'ID'          =>    $user->ID,
	                    'user_nicename'    =>    $post_id,
	                    'first_name'    =>    $fields['field_5995a94c94b13'], //office name
	                    'last_name'    =>    $fields['field_5995a94c954c8'], //primary contact name
	                    'description'    =>    $fields['field_5995a94c94b13'] . ', ' . $fields['field_5995bd634653e'] //office, address
	                )
	            );
	        elseif(isset($fields['field_5994c9e2cf59a'])):
	            wp_update_user(
	                array(
	                    'ID'          =>    $user->ID,
	                    'user_nicename'    =>    $post_id,
	                    'first_name'    =>    $fields['field_5994c9e2cf59a'], //first name
	                    'last_name'    =>    $fields['field_5994c9e8cf59c'], //last name
	                    'description'    =>    $fields['field_5994c9e2cf59a'] . ' ' . $fields['field_5994c9e8cf59c'] . ', ' . $fields['field_5994ca01cf59d'] //name, postal
	                )
	            );
	        endif;

	}

	add_action('acf/save_post', 'my_acf_save_post', 20);
?>