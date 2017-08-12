<?php

    //1. CHECK UNIQUE EMAIL, prevalidate - so nice for the user!
    add_action( 'wp_ajax_emailCheck', 'teledent_fn_emailCheck' );
    add_action( 'wp_ajax_nopriv_emailCheck', 'teledent_fn_emailCheck' );

    function teledent_fn_emailCheck() {
        $isUnique = true;
        extract($_GET);

        if( null == username_exists( $email_address ) ) {
            $isUnique = true;
        } else {
            $isUnique = false;
        }

        print_r($isUnique);

        wp_die(); 
    }

    //2. CREATE ACCOUNT - username and password generated, no posts or emails generated
    add_action( 'wp_ajax_createAccount', 'teledent_fn_createAccount' );
    add_action( 'wp_ajax_nopriv_createAccount', 'teledent_fn_createAccount' );

    function teledent_fn_createAccount() {

        extract($_GET);
        if( null == username_exists( $email_address ) ) {
            // Generate the password and create the user
            
            $password = wp_generate_password( 12, false );
            $user_id = wp_create_user( $email_address, $password, $email_address );

            // Set the role
            $user = new WP_User( $user_id );
            $user->set_role( $user_type );

            wp_clear_auth_cookie();
            wp_set_current_user ( $user_id );
            wp_set_auth_cookie  ( $user_id );

            emailWelcomeApplicant($email_address, $password, $user_type);

            exit();
        }

        wp_die(); // this is required
    }

    /* CREATE APPLICANT PROFILE 
    * Insert collected data into applicant profile 
    * Email user (welcome, with email) and Teledent (notice with resume)
    */

    add_action( 'wp_ajax_createApplicant', 'teledent_fn_createApplicant' );
    add_action( 'wp_ajax_nopriv_createApplicant', 'teledent_fn_createApplicant' );
        
        function teledent_fn_createApplicant() {

            extract($_GET);

            // Set the role
            $user = wp_get_current_user();

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
                'post_author' => $user->ID,
                'post_title' => $post_content,
                'post_type' => $user_type,
                'meta_input' => $post_meta
            );

            $applicant_post_id = wp_insert_post($new_post);

            // Set the nickname
            wp_update_user(
                array(
                    'ID'          =>    $user->ID,
                    'user_nicename'    =>    $applicant_post_id,
                    'first_name'    =>    $first_name,
                    'last_name'    =>    $last_name,
                    'description'    =>    $post_content
                )
            );

            // Email Teledent          
            emailNotifyAdminNewApplicant($email_address, $user);

            wp_die(); // this is required
        }


        function emailWelcomeApplicant($email_address, $password, $user_type) {

            $email_subject = 'Your Teledent Account';
            $email_body = 'Welcome to Teledent Dental Services!' . "\r\n";
            $email_body .= 'Your email and log-in account is: ' . $email_address . "\r\n";
            $email_body .= 'Your password is: ' . $password . "\r\n";
            $email_body .= 'Sign in to your account to find and apply for job postings: http:// '. "\r\n";
            $headers = 'From: Teledent Dental Placement Services <no-reply@teledent.com>' . "\r\n";

            wp_mail( $email_address, 
                $email_subject, 
                $email_body, 
                $headers
            );
        }

        function emailNotifyAdminNewApplicant($user) {

            $email_subject = 'New Teledent Applicant (resume attached)';
            $attachments = array( WP_CONTENT_DIR . '/uploads/resumes/1/sam.jpg' );
            $headers = 'From: Teledent Dental Placement Services <no-reply@teledent.com>' . "\r\n";

            wp_mail( 'thevariables+teledent@gmail.com', 
                $email_subject, 
                $email_body, 
                $headers, 
                $attachments
            );

        }

    // CREATE OFFICE PROFILE - insert collected data into applicant profile
    add_action( 'wp_ajax_createOffice', 'teledent_fn_createOffice' );
    add_action( 'wp_ajax_nopriv_createOffice', 'teledent_fn_createOffice' );
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
                'applicant_work_types' => $work_types,
                'applicant_contract_type' => $contract_type,
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
        }

        wp_die(); // this is required
    }

 ?>