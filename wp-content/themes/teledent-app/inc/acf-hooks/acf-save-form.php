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

			// // bail early if no ACF data
			// if( empty($_POST['acf']) ) {		    
			//     return;
			// }

			// // array of field values
			// $fields = $_POST['acf'];

			// echo "<script>console.log(".json_encode($fields).");</script>";

			// $user = wp_get_current_user();

         //    // Sync User/Post       
         //    if($fields['dental_office_name']):
	        //     wp_update_user(
	        //         array(
	        //             'ID'          =>    $user->ID,
	        //             'user_nicename'    =>    $post_id,
	        //             'first_name'    =>    $fields['dental_office_name'],
	        //             'last_name'    =>    $fields['dental_office_name'],
	        //             'description'    =>    $fields['dental_office_name']
	        //         )
	        //     );
	        // elseif($fields['applicant_first_name']):
	        //     wp_update_user(
	        //         array(
	        //             'ID'          =>    $user->ID,
	        //             'user_nicename'    =>    $post_id,
	        //             'first_name'    =>    $fields['applicant_first_name'],
	        //             'last_name'    =>    $fields['applicant_last_name'],
	        //             'description'    =>    $fields['dental_office_name']
	        //         )
	        //     );
	        // endif;
	}

	add_action('acf/save_post', 'my_acf_save_post', 20);
?>