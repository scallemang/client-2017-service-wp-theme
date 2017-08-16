<?php
    // Register custom post types
    require_once(sprintf("%s/post-types/applicants.php", dirname(__FILE__)));
    require_once(sprintf("%s/post-types/offices.php", dirname(__FILE__)));
    // require_once(sprintf("%s/post-types/orders.php", dirname(__FILE__)));
    require_once(sprintf("%s/post-types/applications.php", dirname(__FILE__)));

    $Post_Type_Applicant = new Post_Type_Applicant();
    $Post_Type_Office = new Post_Type_Office();
    // $Post_Type_Order = new Post_Type_Order();
    $Post_Type_Application = new Post_Type_Application();


	function remove_yoast_metabox() {
	    remove_meta_box('wpseo_meta', 'applicant', 'normal');
	    remove_meta_box('wpseo_meta', 'office', 'normal');
	    remove_meta_box('wpseo_meta', 'order', 'normal');
	    remove_meta_box('wpseo_meta', 'application', 'normal');
	}
	
	add_action( 'add_meta_boxes', 'remove_yoast_metabox',11 );


 ?>