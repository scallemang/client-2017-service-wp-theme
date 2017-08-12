<?php
    // Register custom post types
        require_once(sprintf("%s/post-types/applicants.php", dirname(__FILE__)));
        require_once(sprintf("%s/post-types/offices.php", dirname(__FILE__)));
        require_once(sprintf("%s/post-types/orders.php", dirname(__FILE__)));

        $Post_Type_Applicant = new Post_Type_Applicant();
        $Post_Type_Office = new Post_Type_Office();
        $Post_Type_Order = new Post_Type_Order();
 ?>