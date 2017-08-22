<?php
    //G'day, the functions are wired up here
    include('inc/enqueue.php'); // include scripts and styles in wp template
    include('inc/post-types.php'); // build post-types
    include('inc/json-api.php'); //sam's playground for now.
    include('inc/utilities.php'); // php text functions for content handling   
    include('inc/ajax-fn-registration.php'); //registration process ajax functions
    include('inc/auth.php'); //handle site security for sections of the site
    include('inc/acf-hooks/acf-save-form.php'); //handle site security for sections of the site

?>