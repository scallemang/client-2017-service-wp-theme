<?php 

	//Post Owner or Admin
	//Returns boolean
	function var_profile_access() {
		$auth = [];
		$pass = false;
		$loggedIn = wp_get_current_user();

		$auth['loggedIn'] = $loggedIn;
		$auth['postAuthor'] =  get_the_author_meta('ID');
		$auth['isAdmin'] = var_is_admin_user();

		if($auth['loggedIn']->ID === $auth['postAuthor'] 
			|| $auth['isAdmin'] ) {
			$pass = true;
		}

		return $auth;
	}

	//Is this account an Admin
	//Returns boolean
	function var_is_admin_user() {
		$loggedIn = wp_get_current_user();
		return isset($loggedIn->caps['administrator']);;
	}

	//Logout Redirect Filter
	add_action('wp_logout','auto_redirect_after_logout');
	function auto_redirect_after_logout(){
		wp_redirect( home_url() );
		exit();
	}

?>