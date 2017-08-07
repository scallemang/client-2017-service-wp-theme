<?php
$current_user = wp_get_current_user();
	if ( $current_user->ID ) {
	 	echo 'Username: ' . $current_user->user_login . '<br />';
	    echo 'User email: ' . $current_user->user_email . '<br />';
	    echo 'User first name: ' . $current_user->user_firstname . '<br />';
	    echo 'User last name: ' . $current_user->user_lastname . '<br />';
	    echo 'User display name: ' . $current_user->display_name . '<br />';
	    echo 'User ID: ' . $current_user->ID . '<br />';
	} else {
	    echo 'LOG IN FORM HERE';
	}
?>