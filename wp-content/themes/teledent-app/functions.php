<?php

add_action( 'wp_enqueue_scripts', 'salient_child_enqueue_styles');

function salient_child_enqueue_styles() {

    wp_enqueue_style( 'parent-style',
        get_template_directory_uri() . '/style.css',
        array('font-awesome')
    );

    // wp_enqueue_style('child-style',
    //     get_stylesheet_directory_uri() . '/dist/css/style.css'
    // );

    // wp_enqueue_script('child-scripts',
    //     get_stylesheet_directory_uri() . '/dist/js/script.js',
    //     array('jquery'),
    //     NULL,
    //     true
    // );

    if ( is_rtl() ) {
        wp_enqueue_style(  'salient-rtl',
            get_template_directory_uri(). '/rtl.css',
            array(),
            '1',
            'screen'
        );
    }

    wp_enqueue_style( 'teledent-bootstrap', get_stylesheet_directory_uri() . '/dist/css/bootstrap.css', false); 
    wp_enqueue_style( 'teledent-bootstrap-theme', get_stylesheet_directory_uri() .  '/dist/css/bootstrap-theme.css', false ); 
    wp_enqueue_style( 'teledent-styles', get_stylesheet_directory_uri() .  '/dist/css/screen.css' );

    wp_enqueue_script( 'teledent-deps', get_stylesheet_directory_uri() . '/dist/js/plugins.js', false );
    wp_enqueue_script( 'teledent-main', get_stylesheet_directory_uri() . '/dist/js/main.js', false );

}


    // Register custom post types
        require_once(sprintf("%s/post-types/applicants_template.php", dirname(__FILE__)));
        require_once(sprintf("%s/post-types/offices_template.php", dirname(__FILE__)));
        require_once(sprintf("%s/post-types/orders_template.php", dirname(__FILE__)));

        $Post_Type_Applicant = new Post_Type_Applicant();
        $Post_Type_Office = new Post_Type_Office();
        $Post_Type_Order = new Post_Type_Order();


        add_action( 'wp_ajax_prepDomAction', 'teledent_fn_createApplicant' );
        add_action( 'wp_ajax_nopriv_prepDomAction', 'teledent_fn_createApplicant' );

        add_action( 'wp_ajax_createOffice', 'teledent_fn_createOffice' );
        add_action( 'wp_ajax_nopriv_createOffice', 'teledent_fn_createOffice' );

        add_action( 'wp_ajax_uploadFile', 'teledent_fn_upload' );
        add_action( 'wp_ajax_nopriv_uploadFile', 'teledent_fn_upload' );


    function teledent_fn_startSignup() {
        return username_exists( $email_address );
    }

    function teledent_fn_upload() {
      $meta = $_GET;
      $filename = $meta['file']['name'];
      $destination = $meta['targetPath'] . $filename;
      move_uploaded_file( $_FILES['file']['tmp_name'] , $destination );
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


// //Enqueue scripts
//     function t_enqueue() {
//         wp_enqueue_style( 'teledent-bootstrap', get_template_directory_uri( '/dist/css/bootstrap.min.css', __FILE__ ), false ); 
//         wp_enqueue_style( 'teledent-bootstrap-theme', get_template_directory_uri( '/dist/css/bootstrap-theme.min.css', __FILE__ ), false ); 
//         wp_enqueue_style( 'teledent-styles', get_template_directory_uri( '/dist/css/screen.css', __FILE__ ) );


//         wp_enqueue_script( 'teledent-deps', get_template_directory_uri( '/dist/js/plugins.js', __FILE__ ), false );
//         wp_enqueue_script( 'teledent-main', get_template_directory_uri( '/dist/js/main.js', __FILE__ ), false );

//         // in JavaScript, object properties are accessed as ajax_object.ajax_url, ajax_object.we_value
//         wp_localize_script( 'ajax-script', 'ajax_object',
//             array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'we_value' => 1234 ) );

//     }

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


?>