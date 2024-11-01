<?php
/*
Plugin Name: Timeline Grid
Plugin URI: http://pickplugins.com
Description: Awesome post grid for query post from any post type and display on grid.
Version: 1.0.0
Author: projectW
Author URI: http://pickplugins.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 


class TimelineGrid{
	
	
	public function __construct(){
		
		define('timeline_grid_plugin_url', plugins_url('/', __FILE__) );
		define('timeline_grid_plugin_dir', plugin_dir_path(__FILE__) );
		define('timeline_grid_wp_url', 'https://wordpress.org/plugins/timeline-grid/' );
		define('timeline_grid_wp_reviews', 'http://wordpress.org/support/view/plugin-reviews/timeline-grid' );
		define('timeline_grid_pro_url','http://www.pickplugins.com/item/timeline-grid-facebook-style-timeline-maker-for-wordpress/' );
		define('timeline_grid_demo_url', 'http://pickplugins.com/demo/post-grid/' );
		define('timeline_grid_conatct_url', 'http://pickplugins.com/contact/' );
		define('timeline_grid_qa_url', 'http://pickplugins.com/qa/' );
		define('timeline_grid_plugin_name', 'Timeline Grid' );
		define('timeline_grid_version', '1.0.0' );
		define('timeline_grid_customer_type', 'free' );		
		define('timeline_grid_share_url', 'https://wordpress.org/plugins/post-grid/' );
		define('timeline_grid_tutorial_video_url', '//www.youtube.com/embed/ggfdf75854' );
		define('timeline_grid_textdomain', 'timeline_grid' );		
	
		
		
		
		include( 'includes/class-functions.php' );
		include( 'includes/class-shortcodes.php' );
		include( 'includes/class-settings.php' );		
		include( 'includes/meta.php' );		
		include( 'includes/functions.php' );

		add_action( 'wp_enqueue_scripts', array( $this, 'timeline_grid_scripts_front' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'timeline_grid_scripts_admin' ) );
		add_action( 'admin_enqueue_scripts', 'wp_enqueue_media' ); 
		
		add_action( 'plugins_loaded', array( $this, 'timeline_grid_load_textdomain' ));
		
		register_activation_hook( __FILE__, array( $this, 'timeline_grid_install' ) );
		register_deactivation_hook( __FILE__, array( $this, 'timeline_grid_deactivation' ) );
		//register_uninstall_hook( __FILE__, array( $this, 'timeline_grid_uninstall' ) );
		
		}
		
	public function timeline_grid_load_textdomain() {
	  load_plugin_textdomain( 'timeline_grid', false, plugin_basename( dirname( __FILE__ ) ) . '/languages/' ); 
	}
		
	public function timeline_grid_install(){
		
		
		$class_timeline_grid_functions = new class_timeline_grid_functions();
		
		$layout_content_list = $class_timeline_grid_functions->layout_content_list();
		$layout_hover_list = $class_timeline_grid_functions->layout_hover_list();		
		
		update_option('timeline_grid_layout_content', $layout_content_list);
		update_option('timeline_grid_layout_hover', $layout_hover_list);
		
		do_action( 'timeline_grid_action_install' );
		
		}		
		
	public function timeline_grid_uninstall(){
		
		do_action( 'timeline_grid_action_uninstall' );
		}		
		
	public function timeline_grid_deactivation(){
		
		do_action( 'timeline_grid_action_deactivation' );
		}
		
	
		
	public function timeline_grid_scripts_front(){
		wp_enqueue_script('jquery');

		wp_enqueue_style('timeline_grid_style', timeline_grid_plugin_url.'/assets/frontend/css/style.css');
		wp_enqueue_script('timeline_grid_scripts', plugins_url( '/assets/frontend/js/scripts.js' , __FILE__ ) , array( 'jquery' ));
		wp_localize_script('timeline_grid_scripts', 'timeline_grid_ajax', array( 'timeline_grid_ajaxurl' => admin_url( 'admin-ajax.php')));
		
		wp_enqueue_script('masonry.pkgd.min', plugins_url( '/assets/frontend/js/masonry.pkgd.min.js' , __FILE__ ) , array( 'jquery' ));		
	
		wp_enqueue_script('owl.carousel', plugins_url( '/assets/frontend/js/owl.carousel.js' , __FILE__ ) , array( 'jquery' ));
		wp_enqueue_style('owl.carousel', timeline_grid_plugin_url.'assets/frontend/css/owl.carousel.css');
		wp_enqueue_style('owl.theme', timeline_grid_plugin_url.'assets/frontend/css/owl.theme.css');
		wp_enqueue_style('font-awesome', timeline_grid_plugin_url.'assets/frontend/css/font-awesome.css');		
		wp_enqueue_style('style-woocommerce', timeline_grid_plugin_url.'assets/frontend/css/style-woocommerce.css');
		wp_enqueue_style('animate', timeline_grid_plugin_url.'assets/frontend/css/animate.css');

		
		wp_enqueue_style('style.skins', timeline_grid_plugin_url.'assets/global/css/style.skins.css');
		wp_enqueue_style('style.layout', timeline_grid_plugin_url.'assets/global/css/style.layout.css');
		
		}
		
		
	public function timeline_grid_scripts_admin(){
			
		wp_enqueue_script('jquery');
		
		wp_enqueue_script('timeline_grid_admin_js', plugins_url( 'assets/admin/js/scripts.js' , __FILE__ ) , array( 'jquery' ));
		wp_localize_script( 'timeline_grid_admin_js', 'timeline_grid_ajax', array( 'timeline_grid_ajaxurl' => admin_url( 'admin-ajax.php')));

		wp_enqueue_style('timeline_grid_admin_style', timeline_grid_plugin_url.'assets/admin/css/style.css');

		//ParaAdmin
		wp_enqueue_style('ParaAdmin', timeline_grid_plugin_url.'assets/admin/ParaAdmin/css/ParaAdmin.css');		
		wp_enqueue_script('ParaAdmin', plugins_url( 'assets/admin/ParaAdmin/js/ParaAdmin.js' , __FILE__ ) , array( 'jquery' ));
		wp_enqueue_style('font-awesome', timeline_grid_plugin_url.'assets/frontend/css/font-awesome.css');	

		wp_enqueue_script('codemirror', plugins_url( 'assets/admin/js/codemirror.js' , __FILE__ ) , array( 'jquery' ));
		wp_enqueue_script('simplescrollbars', plugins_url( 'assets/admin/js/simplescrollbars.js' , __FILE__ ) , array( 'jquery' ));
		wp_enqueue_script('css', plugins_url( 'assets/admin/js/css.js' , __FILE__ ) , array( 'jquery' ));	
		wp_enqueue_script('javascript', plugins_url( 'assets/admin/js/javascript.js' , __FILE__ ) , array( 'jquery' ));				
		wp_enqueue_style('codemirror', timeline_grid_plugin_url.'assets/admin/css/codemirror.css');
		wp_enqueue_style('simplescrollbars', timeline_grid_plugin_url.'assets/admin/css/simplescrollbars.css');		
			
		wp_enqueue_script('layout-editor', plugins_url( 'assets/admin/js/layout-editor.js' , __FILE__ ) , array( 'jquery' ));	
		
		wp_enqueue_style('style.skins', timeline_grid_plugin_url.'assets/global/css/style.skins.css');
		wp_enqueue_style('style.layout', timeline_grid_plugin_url.'assets/global/css/style.layout.css');		
		
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'timeline_grid_color_picker', plugins_url('/assets/admin/js/color-picker.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
		
		
		}
		
		
	
	}

new TimelineGrid();

