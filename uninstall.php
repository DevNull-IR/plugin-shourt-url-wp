<?php

if (! function_exists("uninstall_wp_f1r")){
    register_deactivation_hook( __FILE__ , 'uninstall_wp_f1r' );
    function uninstall_wp_f1r(){
        global $wpdb; 
        $table_name = $wpdb->prefix . 'f1r_shourter'; 
        $sql = "DROP TABLE IF EXISTS $table_name"; 
        $wpdb->query($sql); 
        delete_option("linktoken"); 
        delete_option("token_wp_f1r"); 
        delete_option("viewWhere"); 
        delete_option("token_wp_f1r"); 
        delete_option("wp_token_f1r_api");
        delete_option("wp_token_f1r_api_radio");

    }
}

uninstall_wp_f1r();