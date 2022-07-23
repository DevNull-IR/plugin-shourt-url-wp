<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://f1r.ir/
 * @since             4.0
 * @package           Shourter_url
 *
 * @wordpress-plugin
 * Plugin Name:       wp f1r
 * Plugin URI:        https://f1r.ir/
 * Description:       plugin shourter links sponserd PreCode, f1r.ir. It is mandatory to use the token plugin in the settings
 * Version:           4.0
 * Author:            Ali CEO at PreCode, f1r.ir
 * Author URI:        https://devnull-ali.ir
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-f1r
 * Domain Path:       /languages
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'SETTINGS_PAGE_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-settings-page-activator.php
 */
function activate_settings_page() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-settings-page-activator.php';
	Settings_Page_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-settings-page-deactivator.php
 */
function deactivate_settings_page() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-settings-page-deactivator.php';
	Settings_Page_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_settings_page' );
register_deactivation_hook( __FILE__, 'deactivate_settings_page' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-settings-page.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_settings_page() {

	$plugin = new Settings_Page();
	$plugin->run();

}
run_settings_page();
if (! function_exists("install_db_f1r")){
    function install_db_f1r(){
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();
        $table_name = "wp_f1r_shourter";
        $sql = "CREATE TABLE `{$wpdb->base_prefix}f1r_shourter` (
            `postID` bigint(20) NOT NULL,
            `postURL` text NOT NULL,
            `shourter` varchar(100) NOT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        add_option("linktoken"); 
        add_option("token_wp_f1r"); 
        add_option("viewWhere"); 
        add_option("token_wp_f1r"); 
        add_option("wp_token_f1r_api");
        add_option("wp_token_f1r_api_radio");
        add_option("wp_f1r_theme");
        add_option("attach_wp_f1r");
        add_option("wp_f1r_size_of_box_one");
        add_option("wp_f1r_color_text_one_theme");
        add_option("wp_f1r_color_one_theme");
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
    }
    install_db_f1r();
}
if (! function_exists("db_console_wp_f1r")){
    function db_console_wp_f1r(){
        return "<script>console.clear();console.log('%c Wp f1r Plugin ', 'background: #222; color: #bada55; font-size: 50px');</script>";
    }
    add_action('wp_footer', 'db_console_wp_f1r');
    add_action('wp_head', 'db_console_wp_f1r');
}

if (! function_exists("reader_wp_f1r_txt")){
    function reader_wp_f1r_txt(){
        install_db_f1r();
        $post = get_post();
        global $wpdb;
        $check = $wpdb->get_results("select * from {$wpdb->base_prefix}f1r_shourter where postID = {$post->ID}");
        if(is_null($check) or count($check) == 0 ){
            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://f1r.ir/api/new/" . get_option('linktoken') . "?url=" . get_permalink(),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            ));

            $res = json_decode(curl_exec($curl));

            curl_close($curl);
            if ($res->ok == true){
                $wpdb->insert("{$wpdb->base_prefix}f1r_shourter" , [
                    "postID"=>$post->ID,
                    "postURL" =>get_permalink(),
                    "shourter"=>$res->Short_URL
                ]);
            } else {
                $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://f1r.ir/api/new/" . get_option('linktoken') . "?url=" . get_permalink(),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            ));

            $res = json_decode(curl_exec($curl));
                if ($res->ok == true){
                    $wpdb->insert("{$wpdb->base_prefix}f1r_shourter" , [
                        "postID"=>$post->ID,
                        "postURL" =>get_permalink(),
                        "shourter"=>$res->Short_URL
                    ]);
                } else {
                    return null;
                }
            }
        }
        return "<span>" . $check[0]->shourter . "</span>";
    }
    add_shortcode("text_f1r","reader_wp_f1r_txt");
}
if (! function_exists("reader_wp_f1r")){
    function reader_wp_f1r(){
        install_db_f1r();
        $post = get_post();
        global $wpdb;
        $check = $wpdb->get_results("select * from {$wpdb->base_prefix}f1r_shourter where postID = {$post->ID}");
        if(is_null($check) or count($check) == 0 ){
            // $res = json_decode(file_get_contents("https://f1r.ir/api/v2/?url=" . get_permalink() . "&token=" . get_option('linktoken')));
            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://f1r.ir/api/new/" . get_option('linktoken') . "?url=" . get_permalink(),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            ));

            $res = json_decode(curl_exec($curl));
            if ($res->ok == true){
                $wpdb->insert("{$wpdb->base_prefix}f1r_shourter" , [
                    "postID"=>$post->ID,
                    "postURL" =>get_permalink(),
                    "shourter"=>$res->Short_URL
                ]);
            } else {
                // $res = json_decode(file_get_contents("https://f1r.ir/api/v2/?url=" . get_permalink() . "&token=" . get_option('linktoken')));
                $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://f1r.ir/api/new/" . get_option('linktoken') . "?url=" . get_permalink(),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            ));

            $res = json_decode(curl_exec($curl));
                if ($res->ok == true){
                    $wpdb->insert("{$wpdb->base_prefix}f1r_shourter" , [
                        "postID"=>$post->ID,
                        "postURL" =>get_permalink(),
                        "shourter"=>$res->Short_URL
                    ]);
                } else {
                    return null;
                }
            }
        }
        $checks = $wpdb->get_results("select * from {$wpdb->base_prefix}f1r_shourter where postID = {$post->ID}");
        // return "<p>{$checks[0]->shourter}</p>";
        if (get_option("wp_f1r_size_of_box_one") != "Assumption"){
            if (get_option("wp_f1r_size_of_box_one") != null ){
                $widhth = "width:" . get_option("wp_f1r_size_of_box_one") . ";";
            } else {
                $widhth = null;
            }
        } else {
            $widhth = null;
        }
        // 247 // color: $color_hov;
        $color = get_option("wp_f1r_color_one_theme") ? get_option("wp_f1r_color_one_theme") : "#2564b8";

        $color_hov = get_option("wp_f1r_color_buttom_hover_one_theme") ? get_option("wp_f1r_color_buttom_hover_one_theme") : "#2564b8";

        $color_url = get_option("wp_f1r_color_text_one_theme") ? get_option("wp_f1r_color_text_one_theme") : "#fff";

        $one = "<style> .wp_f1r_container { $widhth flex-direction: column; justify-content: center;align-items: center;}
        .wp_f1r_container .wp_f1_copy { width: auto;height: 75px;background: $color;border-radius: 9px;display: flex;justify-content: space-between;align-items: center;padding: 0 25px; }
        .wp_f1r_container .wp_f1_copy .wp_f1r_text {margin-left: 8px;font-size: 24px;color: $color_url;}
        .wp_f1r_container .wp_f1_copy button {width: 45px;height: 45px;border: none;background: #fff;font-size: 20px;display: flex;justify-content: center;align-items: center;border-radius: 7px;cursor: pointer;transition: background 0.7s, color 0.7s;}      .wp_f1r_container .wp_f1_copy button:hover {color: #fff;background: $color_hov;transition: 0.7s;}</style>
        <div class='wp_f1r_container'><div class='wp_f1_copy'><h1 class='wp_f1r_text' id='wp-f1r-copy-text'>" . $checks[0]->shourter . "</h1><button id='wp_f1_copy'><i><svg id='Layer_1' style=\"enable-background:new 0 0 442 442;width:30px\"version='1.1' viewBox=\"0 0 442 442\"x='0px' xml:space='preserve' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' y='0px'><g><polygon points=\"291,0 51,0 51,332 121,332 121,80 291,80 	\"/><polygon points=\"306,125 306,195 376,195 	\"/><polygon points=\"276,225 276,110 151,110 151,442 391,442 391,225 	\"/></g></svg></i></button></div></div>
        <script> let copy = document.getElementById(\"wp_f1_copy\"); copy.addEventListener(\"click\", () => { let copy_text = document.getElementById(\"wp-f1r-copy-text\"); navigator.clipboard.writeText(copy_text.innerHTML);}); </script>";

        $bck_there = get_option("wp_f1r_backgrond_there") ? get_option("wp_f1r_backgrond_there") : "linear-gradient(135deg, #FDEB71 10%, #F8D800 100%)" ;

        $text_wp_f1r = get_option("wp_f1r_buttom_there") ? get_option("wp_f1r_buttom_there") : "Click me to copy current Url";

        $center_div_cx = get_option("centered_wp_f1r_there") ? 'text-align:' . get_option("centered_wp_f1r_there") .';' : "text-align:center;";

        $there = "<style>.wp_f1r_clipboard{border:0;padding:15px;border-radius:3px;background-image:$bck_there;cursor:pointer;color:#04048c;font-size:16px;position:relative;top:0;transition:all .2s ease}.wp_f1r_clipboard:hover{top:2px}#wp-f1r-div-copy{ {$center_div_cx} }</style>
        <div id='wp-f1r-div-copy'><button class=\"wp_f1r_clipboard\" onclick='wp_f1r_copy()' id=\"wp-f1r_copy_link\" f1r-wp='{$checks[0]->shourter}'>{$text_wp_f1r}</button></div>
        <script> function wp_f1r_copy(){ var val = document.getElementById('wp-f1r_copy_link').getAttribute('f1r-wp'); navigator.clipboard.writeText(val); } </script>";

        $copy_text = get_option("wp_f1r_name_copy_tow") ? get_option("wp_f1r_name_copy_tow") : "copy";

        $color_buttom = get_option("wp_f1r_color_tow_theme") ? get_option("wp_f1r_color_tow_theme") : "#121212";

        if (get_option("wp_f1r_size_of_box_tow") != "Assumption"){
            if (get_option("wp_f1r_size_of_box_tow") != null ){
                $widhth =  get_option("wp_f1r_size_of_box_tow");
            } else {
                $widhth = "auto";
            }
        } else {
            $widhth = "auto";
        }
    $wp_f1r_color_text_tow_theme = get_option("wp_f1r_color_text_tow_theme") ? get_option("wp_f1r_color_text_tow_theme") : "";
    $wp_f1r_color_buttom_hover_tow_theme = get_option("wp_f1r_color_buttom_hover_tow_theme") ? get_option("wp_f1r_color_buttom_hover_tow_theme") : "#efefef";
    $tow = "<style>#inputText{padding:6px 7px;font-size:15px;width:$widhth;color:$wp_f1r_color_text_tow_theme}#copyText{padding:6px 11px;font-size:15px;font-weight:700;background-color:$color_buttom;color:{$wp_f1r_color_buttom_hover_tow_theme}}</style>
    <div style='text-align:center;'><input id='inputText' type='text' value='{$checks[0]->shourter}' disabled>
    <!-- button -->
    <button id='copyText'>" .$copy_text  . "</button>
    </div><script>var text = document.getElementById('inputText'); var btn = document.getElementById('copyText'); btn.onclick = function() { navigator.clipboard.writeText(text.value); } </script>";
        $text_foor_copy = get_option("wp_f1r_foor_text_copy") ? get_option("wp_f1r_foor_text_copy") : "Click me to copy current Url";
        $color_foor = get_option("wp_f1r_color_foor") ? get_option("wp_f1r_color_foor") : "#3498db";
        $phor = "<style>.f1r-third {
        border-color: {$color_foor}!important;
        color: #fff;
        box-shadow: 0 0 40px 40px {$color_foor} inset, 0 0 0 0 {$color_foor};
        transition: all 150ms ease-in-out;
      }
      .f1r-third:hover {
        box-shadow: 0 0 10px 0 {$color_foor} inset, 0 0 10px 4px {$color_foor};
      }
      .f1r-btn {
        box-sizing: border-box;
        -webkit-appearance: none;
           -moz-appearance: none;
                appearance: none;
        background-color: transparent;
        border: 2px solid #e74c3c;
        border-radius: 0.6em;
        color: #e74c3c;
        cursor: pointer;
        display: flex;
        align-self: center;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1;
        margin: 20px;
        padding: 1.2em 2.8em;
        text-decoration: none;
        text-align: center;
        text-transform: uppercase;
        font-family: \"Montserrat\", sans-serif;
        font-weight: 700;
      }
      .f1r-btn:hover, .f1r-btn:focus {
        color: #fff;
        outline: 0;
      }</style> <button class=\"f1r-btn f1r-third\" f1r-wp='{$checks[0]->shourter}' onclick='wp_f1r_copy()' id=\"wp-f1r_copy_link\">" . $text_foor_copy . "</button>
      <script> function wp_f1r_copy(){ var val = document.getElementById('wp-f1r_copy_link').getAttribute('f1r-wp'); navigator.clipboard.writeText(val); } </script>";
    
    $opt = get_option("wp_f1r_theme");
    if ($opt == null){
        return $one;
    } else if ($opt == "one"){
        return $one;
    }else if ($opt == "text"){
        return "<p>{$checks[0]->shourter}</p>";
    } else if ($opt == "tow"){
        return $tow;
    } else if ($opt == "there"){
        return $there;
    } else if ($opt == "foor"){
        return $phor;
    }
    }
    add_shortcode("Print_url_shourt","reader_wp_f1r");
}

if (! function_exists("start_wp_f1r")){
    function start_wp_f1r(){
        function md_contennt($content){
            
            if (!is_front_page() && !is_home()){
            $shortUrl = reader_wp_f1r();
            $content = $content. $shortUrl . PHP_EOL;
            }
            return $content;
        }
        add_filter('the_content','md_contennt');
    }
}
add_filter('the_content',function($content){
    return $content . "<script>console.clear();console.log('%c Wp f1r Plugin ', 'background: #222; color: #bada55; font-size: 50px');</script>";
});
add_filter('the_content',function($content){
    $post = get_post();
    if (get_option("viewWhere") == "on"){
            if (get_option("pages_wp_f1r") == "true"){
                // return $post->post_type;
                if ($post->post_type == "page"){
                    return $content . reader_wp_f1r();
                } else {
                    return $content;
                }
            }  else {
                return $content;
            }
            if (get_option("posts_wp_f1r") == "true"){
                return $post->post_type;
                if ($post->post_type == "post"){
                    return $content . reader_wp_f1r();
                } else {
                    return $content;
                }
            }  else {
                return $content;
            }
        
        } else {
            return $content;
        }
});
add_filter('the_content',function($content){
    $post = get_post();
    if (get_option("viewWhere") == "on"){
            if (get_option("posts_wp_f1r") == "true"){
                // return $post->post_type;
                if ($post->post_type == "post"){
                    return $content . reader_wp_f1r();
                } else {
                    return $content;
                }
            }  else {
                return $content;
            }
        
        } else {
            return $content;
        }
});



add_filter('attachment_fields_to_edit', 'wp_f1r_attch', 10, 2 );
//  add_filter('attachment_fields_to_save', 'wp_f1r_attch_save', 11, 2 );
 function wp_f1r_attch( $form_fields, $post ) {
     global $wpdb;
    if (get_option("viewWhere") == "on"){
        if (get_option("attach_wp_f1r") == "true"){
            $check = $wpdb->get_results("select * from {$wpdb->base_prefix}f1r_shourter where postID = {$post->ID}");
        if(is_null($check) or count($check) == 0 ){
            // $res = json_decode(file_get_contents("https://f1r.ir/api/v2/?url=" . $post->guid . "&token=" . get_option('linktoken')));
            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://f1r.ir/api/new/" . get_option('linktoken') . "?url=" .$post->guid,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            ));

            $res = json_decode(curl_exec($curl));    
            if ($res->ok == true){
                    $wpdb->insert("{$wpdb->base_prefix}f1r_shourter" , [
                        "postID"=>$post->ID,
                        "postURL" =>$post->guid,
                        "shourter"=>$res->Short_URL
                    ]);
                }
            } 
            $checks = $wpdb->get_results("select * from {$wpdb->base_prefix}f1r_shourter where postID = {$post->ID}");
            $form_fields['shortlink'] = array( 'label' => 'Short Link', 'input' => 'text' , 'value' => $checks[0]->shourter);
                    return $form_fields;
        }
    }
 } 



 function image_tag() {
	return "Test=\"Test\"";
}
add_filter('get_image_tag', 'image_tag', 0, 4);
// function wp_f1r_attch_save( $post, $attachment ) { 
// update_post_meta( $post['ID'], 'shortlink', $attachment['shortlink'] ); return $post; 
// }