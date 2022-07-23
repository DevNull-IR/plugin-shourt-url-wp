<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.wplauncher.com
 * @since      1.0.0
 *
 * @package    Settings_Page
 * @subpackage Settings_Page/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Settings_Page
 * @subpackage Settings_Page/admin
 * @author     Ben Shadle <benshadle@gmail.com>
 */
class Settings_Page_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		add_action('admin_menu', array( $this, 'addPluginAdminMenu' ), 9);   
		add_action('admin_init', array( $this, 'registerAndBuildFields' )); 
		add_action("admin_init" , [$this , 'Radio_print']);

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Settings_Page_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Settings_Page_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/settings-page-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Settings_Page_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Settings_Page_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/settings-page-admin.js', array( 'jquery' ), $this->version, false );

	}
	public function addPluginAdminMenu() {
		//add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
		add_menu_page(  $this->plugin_name, "Wp f1r", 'administrator', $this->plugin_name, array( $this, 'displayPluginAdminDashboard' ), 'dashicons-chart-area', 26 );
		

		//add_submenu_page( '$parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function );
		add_submenu_page( $this->plugin_name, 'Setting Wp f1r (Token)', 'Settings', 'administrator', $this->plugin_name.'-settings', array( $this, 'displayPluginAdminSettings' ));
	}
	public function displayPluginAdminDashboard() {
		require_once 'partials/'.$this->plugin_name.'-admin-display.php';
  }



  public function displayPluginAdminSettings_rad() {
	// set this var to be used in the settings-display view
	$active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'general';
	if(isset($_GET['error_message'])){
			add_action('admin_notices', array($this,'settingsPageSettingsMessages_rad'));
			do_action( 'admin_notices', $_GET['error_message'] );
	}
	require_once 'partials/'.$this->plugin_name.'-admin-settings-display.php';
}
public function settingsPageSettingsMessages_rad($error_message){
	switch ($error_message) {
			case '1':
					$message = __( 'There was an error adding this setting. Please try again.  If this persists, shoot us an email.', 'my-text-domain' );                 $err_code = esc_attr( 'radio_buttom_is' );                 $setting_field = 'radio_buttom_is';                 
					break;
	}
	$type = 'error';
	add_settings_error(
				$setting_field,
				$err_code,
				$message,
				$type
		);
}




	public function displayPluginAdminSettings() {
		// set this var to be used in the settings-display view
		$active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'general';
		if(isset($_GET['error_message'])){
				add_action('admin_notices', array($this,'settingsPageSettingsMessages'));
				do_action( 'admin_notices', $_GET['error_message'] );
		}
		require_once 'partials/'.$this->plugin_name.'-admin-settings-display.php';
	}
	public function settingsPageSettingsMessages($error_message){
		switch ($error_message) {
				case '1':
						$message = __( 'There was an error adding this setting. Please try again.  If this persists, shoot us an email.', 'my-text-domain' );                 $err_code = esc_attr( 'settings_page_example_setting' );                 $setting_field = 'settings_page_example_setting';                 
						break;
		}
		$type = 'error';
		add_settings_error(
					$setting_field,
					$err_code,
					$message,
					$type
			);
	}
	public function Radio_print(){
		add_settings_section(
			// ID used to identify this section and with which to register options
			'radio_wp_f1r_section', 
			// Title to be displayed on the administration page
			'',  
			// Callback used to render the description of the section
				array( $this, 'settings_page_display_general_account_radio' ),    
			// Page on which to add this section of options
			'radio_wp_f1r_settings'                   
		);
		$args = [
			'type'      => 'input',
			'subtype'   => 'radio',
			'id'    => 'radio_buttom_is',
			'name'      => 'wp_token_f1r_api_radio" size="40" value="One">
			<label>
			
			No 
			
			</label>
			<input id="asdasd" type="radio" name="wp_token_f1r_api_radio" value="tow"> 
			
			<label>Yes</label>
			
			<br>
			
			
			
			<b>نمایش خودکار ؟</b>
			
			<span "' ,
			// 'value' => get_option('linktoken'),
			// 'required' => 'true',
			// 'get_options_list' => '',
			'value_type'=>'normal',
			'wp_data' => 'option'
		];
		add_settings_field(
			'radio_buttom_is',
			'', // الان چی بیارم ؟ این کدش آماده بوده پنلو سرچ کردم اوردم
			[ $this, 'settings_page_render_settings_field_radio' ],
			'radio_wp_f1r_settings',
			'radio_wp_f1r_section',
			$args
		);
		register_setting(
			'radio_wp_f1r_settings',
			'radio_buttom_is'
			);
			add_option("viewWhere");
			if (isset($_POST['wp_token_f1r_api_radio'])){
				if($_POST['wp_token_f1r_api_radio'] == "One"){
					update_option( "viewWhere" , "on" );
				} else {
					update_option( "viewWhere" , "off" );
				}
			}
	}
	public function registerAndBuildFields() {
			/**
		 * First, we add_settings_section. This is necessary since all future settings must belong to one.
		 * Second, add_settings_field
		 * Third, register_setting
		 */     
		add_settings_section(
			// ID used to identify this section and with which to register options
			'settings_page_general_section', 
			// Title to be displayed on the administration page
			'',  
			// Callback used to render the description of the section
				array( $this, 'settings_page_display_general_account' ),    
			// Page on which to add this section of options
			'settings_page_general_settings'                   
		);
		unset($args);
		$args = array (
							'type'      => 'input',
							'subtype'   => 'text',
							'id'    => 'settings_page_example_setting',
							'name'      => 'wp_token_f1r_api' ,
							'placeholder' => get_option('linktoken'),
							'required' => 'true',
							'get_options_list' => '',
							'value_type'=>'normal',
							'wp_data' => 'option'
					);
		add_settings_field(
			'settings_page_example_setting',
			'Your Token', // الان چی بیارم ؟ این کدش آماده بوده پنلو سرچ کردم اوردم
			array( $this, 'settings_page_render_settings_field' ),
			'settings_page_general_settings',
			'settings_page_general_section',
			$args
		);


		register_setting(
						'settings_page_general_settings',
						'settings_page_example_setting'
						);
		
			if (isset($_POST['submit'])){
				if(isset($_POST['wp_token_f1r_api'])){
					add_option('linktoken');
					update_option('linktoken',$_POST['wp_token_f1r_api']);
					update_option("wp_token_f1r_api	",$_POST['wp_token_f1r_api']);
				}
				add_option("viewWhere");
					if (isset($_POST['wp_token_f1r_api_radio'])){
						if($_POST['wp_token_f1r_api_radio'] == "One"){
							update_option( "viewWhere" , "on" );
							update_option( "wp_token_f1r_api_radio" , "on" );
						} else {
							update_option( "viewWhere" , "off" );
							update_option( "wp_token_f1r_api_radio" , "off" );
						}
					}
					add_option("posts_wp_f1r");
					
					if (isset($_POST['posts_wp_f1r'])){
						update_option( "posts_wp_f1r" , "true" );
					} else {
						update_option( "posts_wp_f1r" , "false" );
					}

					add_option("pages_wp_f1r");
					
					if (isset($_POST['pages_wp_f1r'])){
						update_option( "pages_wp_f1r" , "true" );
					} else {
						update_option( "pages_wp_f1r" , "false" );
					}
					if (isset($_POST['wp_f1r_theme'])){
						if ($_POST['wp_f1r_theme'] == "Theme_one"){
							update_option( "wp_f1r_theme" , "one" );
						} else if ($_POST['wp_f1r_theme'] == "text"){
							update_option( "wp_f1r_theme" , "text" );
						} else if ($_POST['wp_f1r_theme'] == "Theme_tow"){
							update_option( "wp_f1r_theme" , "tow" );
						} else if ($_POST['wp_f1r_theme'] == "Theme_there" ) {
							// there
							update_option( "wp_f1r_theme" , "there" );
						} else if ($_POST['wp_f1r_theme'] == "Theme_foor"){
							update_option("wp_f1r_theme" , "foor");
						}else {
							update_option( "wp_f1r_theme" , "one" );
						}
					}
					// attach_wp_f1r
					add_option("attach_wp_f1r");
					if (isset($_POST['attach_wp_f1r'])){
						update_option( "attach_wp_f1r" , "true" );
					} else {
						update_option( "attach_wp_f1r" , "false" );
					}

					// theme one

					add_option("wp_f1r_size_of_box_one");
					if (isset($_POST['wp_f1r_size_of_box_one'])){
						update_option( "wp_f1r_size_of_box_one" , trim($_POST['wp_f1r_size_of_box_one']) );
					}
					add_option("wp_f1r_color_text_one_theme");
					if (isset($_POST['wp_f1r_color_text_one_theme'])){
						update_option( "wp_f1r_color_text_one_theme" , trim($_POST['wp_f1r_color_text_one_theme']) );
					}
					// wp_f1r_color_one_theme
					// wp_f1r_color_buttom_hover_one_theme
					add_option("wp_f1r_color_one_theme");
					if (isset($_POST['wp_f1r_color_one_theme'])){
						update_option( "wp_f1r_color_one_theme" , trim($_POST['wp_f1r_color_one_theme']) );
					}
					add_option("wp_f1r_color_buttom_hover_one_theme");
					if (isset($_POST['wp_f1r_color_buttom_hover_one_theme'])){
						update_option( "wp_f1r_color_buttom_hover_one_theme" , trim($_POST['wp_f1r_color_buttom_hover_one_theme']) );
					}
					
					// theme tow
					
					add_option("wp_f1r_size_of_box_tow");
					if (isset($_POST['wp_f1r_size_of_box_tow'])){
						update_option( "wp_f1r_size_of_box_tow" , trim($_POST['wp_f1r_size_of_box_tow']) );
					}
					add_option("wp_f1r_color_text_tow_theme");
					if (isset($_POST['wp_f1r_color_text_tow_theme'])){
						update_option( "wp_f1r_color_text_tow_theme" , trim($_POST['wp_f1r_color_text_tow_theme']) );
					}
					// wp_f1r_color_one_theme
					// wp_f1r_color_buttom_hover_one_theme
					add_option("wp_f1r_color_tow_theme");
					if (isset($_POST['wp_f1r_color_tow_theme'])){
						update_option( "wp_f1r_color_tow_theme" , trim($_POST['wp_f1r_color_tow_theme']) );
					}
					add_option("wp_f1r_color_buttom_hover_tow_theme");
					if (isset($_POST['wp_f1r_color_buttom_hover_tow_theme'])){
						update_option( "wp_f1r_color_buttom_hover_tow_theme" , trim($_POST['wp_f1r_color_buttom_hover_tow_theme']) );
					}
					add_option("wp_f1r_name_copy_tow");
					if (isset($_POST['wp_f1r_name_copy_tow'])){
						update_option( "wp_f1r_name_copy_tow" , trim($_POST['wp_f1r_name_copy_tow']) );
					}

					// theme there 
					add_option("wp_f1r_buttom_there");
					if (isset($_POST['wp_f1r_buttom_there'])){
						update_option( "wp_f1r_buttom_there" , trim($_POST['wp_f1r_buttom_there']) );
					}
					add_option("wp_f1r_backgrond_there");
					if (isset($_POST['wp_f1r_backgrond_there'])){
						update_option( "wp_f1r_backgrond_there" , trim($_POST['wp_f1r_backgrond_there']) );
					}
					add_option("centered_wp_f1r_there");
					if (isset($_POST['centered_wp_f1r_there'])){
						update_option( "centered_wp_f1r_there" , trim($_POST['centered_wp_f1r_there']) );
					}

					add_option("wp_f1r_foor_text_copy");
					if (isset($_POST['wp_f1r_foor_text_copy'])){
						update_option("wp_f1r_foor_text_copy" , $_POST['wp_f1r_foor_text_copy']);
					}
					add_option("wp_f1r_color_foor");
					if (isset($_POST['wp_f1r_color_foor'])){
						update_option("wp_f1r_color_foor" , $_POST['wp_f1r_color_foor']);
					}
			}
	}
	public function settings_page_display_general_account() {
		echo '<p>Enter Your Api Token! <a href="https://f1r.ir/panel">Get Api Toekn</a></p>';
	} 
	public function settings_page_display_general_account_radio() {
		echo '<p>Enter Your Api Token! <a href="https://f1r.ir/panel">Get Api Toekn</a></p>';
	} 
	public function settings_page_render_settings_field($args) {
			/* EXAMPLE INPUT
								'type'      => 'input',
								'subtype'   => '',
								'id'    => $this->plugin_name.'_example_setting',
								'name'      => $this->plugin_name.'_example_setting',
								'required' => 'required="required"',
								'get_option_list' => "",
									'value_type' = serialized OR normal,
			'wp_data'=>(option or post_meta),
			'post_id' =>
			*/     
		if($args['wp_data'] == 'option'){
			$wp_data_value = get_option($args['name']);
		} elseif($args['wp_data'] == 'post_meta'){
			$wp_data_value = get_post_meta($args['post_id'], $args['name'], true );
		}

		switch ($args['type']) {

			case 'input':
					$value = ($args['value_type'] == 'serialized') ? serialize($wp_data_value) : $wp_data_value;
					if($args['subtype'] != 'checkbox'){
							$prependStart = (isset($args['prepend_value'])) ? '<div class="input-prepend"> <span class="add-on">'.$args['prepend_value'].'</span>' : '';
							$prependEnd = (isset($args['prepend_value'])) ? '</div>' : '';
							$step = (isset($args['step'])) ? 'step="'.$args['step'].'"' : '';
							$min = (isset($args['min'])) ? 'min="'.$args['min'].'"' : '';
							$max = (isset($args['max'])) ? 'max="'.$args['max'].'"' : '';
							if(isset($args['disabled'])){
									// hide the actual input bc if it was just a disabled input the info saved in the database would be wrong - bc it would pass empty values and wipe the actual information
									echo $prependStart.'<input type="'.$args['subtype'].'" id="'.$args['id'].'_disabled" '.$step.' '.$max.' '.$min.' name="'.$args['name'].'_disabled" size="40" disabled value="' . esc_attr($value) . '" /><input type="hidden" id="'.$args['id'].'" '.$step.' '.$max.' '.$min.' name="'.$args['name'].'" size="40" value="' . esc_attr($value) . '" />'.$prependEnd;
							} else {
									echo $prependStart.'<input type="'.$args['subtype'].'" id="'.$args['id'].'" "'.$args['required'].'" '.$step.' '.$max.' '.$min.' name="'.$args['name'].'" size="40" value="' . esc_attr($value) . '" />'.$prependEnd;
							}
							/*<input required="required" '.$disabled.' type="number" step="any" id="'.$this->plugin_name.'_cost2" name="'.$this->plugin_name.'_cost2" value="' . esc_attr( $cost ) . '" size="25" /><input type="hidden" id="'.$this->plugin_name.'_cost" step="any" name="'.$this->plugin_name.'_cost" value="' . esc_attr( $cost ) . '" />*/

					} else {
							$checked = ($value) ? 'checked' : '';
							echo '<input type="'.$args['subtype'].'" id="'.$args['id'].'" "'.$args['required'].'" name="'.$args['name'].'" size="40" value="1" '.$checked.' />';
					}
					break;
			default:
					# code...
					break;
		}
	}
	public function settings_page_render_settings_field_radio($args) {
				/* EXAMPLE INPUT
									'type'      => 'input',
									'subtype'   => '',
									'id'    => $this->plugin_name.'_example_setting',
									'name'      => $this->plugin_name.'_example_setting',
									'required' => 'required="required"',
									'get_option_list' => "",
										'value_type' = serialized OR normal,
				'wp_data'=>(option or post_meta),
				'post_id' =>
				*/     
			if($args['wp_data'] == 'option'){
				$wp_data_value = get_option($args['name']);
			} elseif($args['wp_data'] == 'post_meta'){
				$wp_data_value = get_post_meta($args['post_id'], $args['name'], true );
			}

			switch ($args['type']) {

				case 'input':
						$value = ($args['value_type'] == 'serialized') ? serialize($wp_data_value) : $wp_data_value;
						if($args['subtype'] != 'checkbox'){
								$prependStart = (isset($args['prepend_value'])) ? '<div class="input-prepend"> <span class="add-on">'.$args['prepend_value'].'</span>' : '';
								$prependEnd = (isset($args['prepend_value'])) ? '</div>' : '';
								$step = (isset($args['step'])) ? 'step="'.$args['step'].'"' : '';
								$min = (isset($args['min'])) ? 'min="'.$args['min'].'"' : '';
								$max = (isset($args['max'])) ? 'max="'.$args['max'].'"' : '';
								if(isset($args['disabled'])){
										// hide the actual input bc if it was just a disabled input the info saved in the database would be wrong - bc it would pass empty values and wipe the actual information
										echo $prependStart.'<input type="'.$args['subtype'].'" id="'.$args['id'].'_disabled" '.$step.' '.$max.' '.$min.' name="'.$args['name'].'_disabled" size="40" disabled value="' . esc_attr($value) . '" /><input type="hidden" id="'.$args['id'].'" '.$step.' '.$max.' '.$min.' name="'.$args['name'].'" size="40" value="' . esc_attr($value) . '" />'.$prependEnd;
								} else {
										echo $prependStart.'<input type="'.$args['subtype'].'" id="'.$args['id'].'" "'.null.'" '.$step.' '.$max.' '.$min.' name="'.$args['name'].'" size="40" value="' . esc_attr($value) . '" />'.$prependEnd;
								}
								/*<input required="required" '.$disabled.' type="number" step="any" id="'.$this->plugin_name.'_cost2" name="'.$this->plugin_name.'_cost2" value="' . esc_attr( $cost ) . '" size="25" /><input type="hidden" id="'.$this->plugin_name.'_cost" step="any" name="'.$this->plugin_name.'_cost" value="' . esc_attr( $cost ) . '" />*/

						} else {
								$checked = ($value) ? 'checked' : '';
								echo '<input type="'.$args['subtype'].'" id="'.$args['id'].'" "'.$args['required'] ?? null.'" name="'.$args['name'].'" size="40" value="1" '.$checked.' />';
						}
						break;
				default:
						# code...
						break;
			}
		}
	}
