<?php
	function update_contact_methods( $contact_methods ) {

		var_dump($contact_methods);

	    unset( $contact_methods['googleplus']);
	    unset( $contact_methods['twitter']);
	    unset( $contact_methods['facebook']);
	    unset( $contact_methods['bio']);
	    unset( $contact_methods['website']);

	    return $contact_methods;

	}
	add_filter( 'user_contactmethods', 'update_contact_methods' );