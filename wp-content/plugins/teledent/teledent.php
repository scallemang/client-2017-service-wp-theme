<?php
/*
Plugin Name: Teledent
Plugin URI: http://wordpress.org/plugins/ontario-brewers-map/
Description: Building out Teledent post types, form functionality and admin options for easy portability between themes.
Author: The Variables Co.
Version: 0.1
Author URI: http://www.thevariables.com
*/
/*
Copyright 2017  M. Leslie Bent  (email : les.bent@brainrider.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

*/

if(!class_exists('Teledent')) {
	class Teledent {

		/* Construct the plugin object */
		public function __construct() {
			// Initialize Settings
				require_once(sprintf("%s/settings.php", dirname(__FILE__)));
				$Teledent_Settings = new Teledent_Settings();

			// Register custom post types
				require_once(sprintf("%s/post-types/applicants_template.php", dirname(__FILE__)));
				require_once(sprintf("%s/post-types/offices_template.php", dirname(__FILE__)));
				require_once(sprintf("%s/post-types/orders_template.php", dirname(__FILE__)));

				$Post_Type_Applicant = new Post_Type_Applicant();
				$Post_Type_Office = new Post_Type_Office();
				$Post_Type_Order = new Post_Type_Order();

				$plugin = plugin_basename(__FILE__);
				add_filter("plugin_action_links_$plugin", array( $this, 'plugin_settings_link' ));

			//Register Shortcodes that will trigger above function, add WP action
				function teledent_sc_login() {
					add_shortcode( 'teledent-login', 'teledent_form_login' );
				}

				function teledent_sc_registration() {
					add_shortcode( 'teledent-registration', 'teledent_form_registration' );
				}

				function teledent_sc_profile_update() {}
				function teledent_sc_profile_view_list() {}
				function teledent_sc_profile_view_single() {}

				function teledent_sc_calendar_update() {}
				function teledent_sc_calendar_view() {}

				function teledent_sc_order_update() {}
				function teledent_sc_order_view_list() {}
				function teledent_sc_order_view_single() {}


				add_action( 'init', 'teledent_sc_login' );
				add_action( 'init', 'teledent_sc_registration' );


			//App Init, triggered by shortcode handling function
				function t_init() {

					//build mark-up and enqueue dependencies
					t_enqueue();

					//Make ajaxurl global variable via wordpress hooks
					//print '<script>var ajaxurl = "' . admin_url('admin-ajax.php') . '"; window.ajaxurl = ajaxurl;</script>';

				}

			//Register AJAX callback functions
				add_action( 'wp_ajax_prepDomAction', 'teledent_fn_createApplicant' );
				add_action( 'wp_ajax_nopriv_prepDomAction', 'teledent_fn_createApplicant' );

				add_action( 'wp_ajax_createOffice', 'teledent_fn_createOffice' );
				add_action( 'wp_ajax_nopriv_createOffice', 'teledent_fn_createOffice' );

				add_action( 'wp_ajax_uploadFile', 'teledent_fn_upload' );
				add_action( 'wp_ajax_nopriv_uploadFile', 'teledent_fn_upload' );

			//Define Shortcode handlers
				function teledent_form_login($atts) {}
			
			//Define Shortcode handler function, and set global attributes
				function teledent_form_registration($atts) {
					t_init();
					print file_get_contents(plugins_url( '/templates/registration.php', __FILE__ ));

				}


			//Prep Data Object to pass to DOM


				function teledent_fn_startSignup() {
					return username_exists( $email_address );
				}

				function teledent_fn_upload() {
				  $meta = $_GET;
				  $filename = $meta['file']['name'];
				  $destination = $meta['targetPath'] . $filename;
				  move_uploaded_file( $_FILES['file']['tmp_name'] , $destination );

				  var_dump($_GET);
				}


				function teledent_fn_createApplicant() {

					extract($_GET);

					if( null == username_exists( $email_address ) ) {

					  // Generate the password and create the user
					  $password = wp_generate_password( 12, false );
					  $user_id = wp_create_user( $email_address, $password, $email_address );

					  // Set the role
					  $user = new WP_User( $user_id );
					  $user->set_role( $user_type );

					  //Make new Applicant Post Type
						$post_meta = array(
							'applicant_type' => $user_type,
							'applicant_first_name' => $first_name,
							'applicant_last_name' => $last_name,
							'applicant_gender' => $gender,
							'applicant_primary_phone' => $primary_phone,
							'applicant_secondary_phone' => $secondary_phone,
							'applicant_email' => $email_address,
							'applicant_address' => $address,
							'applicant_city' => $city,
							'applicant_province' => $province,
							'applicant_postal_code' => $postal_code,
							'applicant_work_types' => json_decode($work_types),
							'applicant_contract_type' => json_decode($contract_type),
							'applicant_commute' => $commute,
							'applicant_locations' => json_decode($locations),
							'applicant_salary' => $salary
						);

						$post_content = $last_name . ', ' . $first_name . ' - ' . $email_address; 

						$new_post = array(
							'post_content' => $post_content,
							'post_status' => 'draft',
							'post_date' => date('Y-m-d H:i:s'),
							'post_author' => $user_id,
							'post_title' => $post_content,
							'post_type' => $user_type,
							'meta_input' => $post_meta
						);
				
						$applicant_post_id = wp_insert_post($new_post);

						// Set the nickname
						wp_update_user(
							array(
						  		'ID'          =>    $user_id,
						  		'user_nicename'    =>    $applicant_post_id,
						  		'first_name'    =>    $first_name,
						  		'last_name'    =>    $last_name,
						  		'description'    =>    $post_content
							)
						);

					  // Email the user
					  wp_mail( $email_address, 'Welcome!', 'Your Password: ' . $password );

					}

					wp_die(); // this is required
				}

					function teledent_fn_createOffice() {

					extract($_GET);

					if( null == username_exists( $email_address ) ) {

					  // Generate the password and create the user
					  $password = wp_generate_password( 12, false );
					  $user_id = wp_create_user( $email_address, $password, $email_address );

					  // Set the role
					  $user = new WP_User( $user_id );
					  $user->set_role( $user_type );

					  //Make new Applicant Post Type
						$post_meta = array(
							'applicant_type' => $user_type,
							'applicant_office_name' => $office_name,
							'applicant_contact_name' => $contact_name,
							'applicant_primary_phone' => $primary_phone,
							'applicant_secondary_phone' => $secondary_phone,
							'applicant_email' => $email_address,
							'applicant_address' => $address,
							'applicant_city' => $city,
							'applicant_work_types' => json_decode($work_types),
							'applicant_contract_type' => json_decode($contract_type),
							'applicant_salary' => $salary
						);

						$post_content = $office_name . ', ' . $city . ' - ' . $email_address; 

						$new_post = array(
							'post_content' => $post_content,
							'post_status' => 'draft',
							'post_date' => date('Y-m-d H:i:s'),
							'post_author' => $user_id,
							'post_title' => $post_content,
							'post_type' => $user_type,
							'meta_input' => $post_meta
						);
				
						$applicant_post_id = wp_insert_post($new_post);

						// Set the nickname
						wp_update_user(
							array(
						  		'ID'          =>    $user_id,
						  		'user_nicename'    =>    $applicant_post_id,
						  		'first_name'    =>    $first_name,
						  		'last_name'    =>    $last_name,
						  		'description'    =>    $post_content
							)
						);

					  // Email the user
					  wp_mail( $email_address, 'Welcome!', 'Your Password: ' . $password );

					}

					wp_die(); // this is required
				}


			//Enqueue scripts
				function t_enqueue() {
					wp_enqueue_style( 'teledent-bootstrap', plugins_url( '/dist/css/bootstrap.min.css', __FILE__ ), false ); 
					wp_enqueue_style( 'teledent-bootstrap-theme', plugins_url( '/dist/css/bootstrap-theme.min.css', __FILE__ ), false ); 
					wp_enqueue_style( 'teledent-styles', plugins_url( '/dist/css/screen.css', __FILE__ ) );


					wp_enqueue_script( 'teledent-deps', plugins_url( '/dist/js/plugins.js', __FILE__ ), false );
					wp_enqueue_script( 'teledent-main', plugins_url( '/dist/js/main.js', __FILE__ ), false );
	
					// in JavaScript, object properties are accessed as ajax_object.ajax_url, ajax_object.we_value
					wp_localize_script( 'ajax-script', 'ajax_object',
						array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'we_value' => 1234 ) );

				}

			//Take JSON breaking characters out of response.
				function string_sanitize($s) {
					$result = htmlentities($s);
					$result = preg_replace('/^(&quot;)(.*)(&quot;)$/', "$2", $result);
					$result = preg_replace('/^(&laquo;)(.*)(&raquo;)$/', "$2", $result);
					$result = preg_replace('/^(&#8220;)(.*)(&#8221;)$/', "$2", $result);
					$result = preg_replace('/^(&#39;)(.*)(&#39;)$/', "$2", $result);
					$result = html_entity_decode($result);
					return $result;
				}

				

			

		} // END public function __construct

		/* Activate the plugin */
		public static function activate() {
			// Do nothing
		} // END public static function activate

		/* Deactivate the plugin */
		public static function deactivate() {
			// Do nothing
		} // END public static function deactivate

		// Add the settings link to the plugins page
		function plugin_settings_link($links) {
			$settings_link = '<a href="options-general.php?page=teledent">Settings</a>';
			array_unshift($links, $settings_link);
			return $links;
		}


	} // END class Teledent
} // END if(!class_exists('Teledent'))

if(class_exists('Teledent')) {
	// Installation and uninstallation hooks
	register_activation_hook(__FILE__, array('Teledent', 'activate'));
	register_deactivation_hook(__FILE__, array('Teledent', 'deactivate'));

	// instantiate the plugin class
	$teledent = new Teledent();
}
