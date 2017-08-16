<?php 
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

function set_default_admin_color($user_id) {
    $args = array(
        'ID' => $user_id,
        'admin_color' => 'blue'
    );
    wp_update_user( $args );
}

add_action('user_register', 'set_default_admin_color');


if ( !current_user_can('manage_options') )
remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );

?>