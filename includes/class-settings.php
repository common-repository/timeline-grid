<?php

/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access

class class_timeline_grid_settings{

	public function __construct(){
		
		add_action('admin_menu', array( $this, 'timeline_grid_menu_init' ));
		
		}



	
	public function timeline_grid_menu_settings(){
		include('menu/settings.php');	
	}
	
	public function timeline_grid_layout_editor(){
		include('menu/layout-editor.php');	
	}	
	
	
	
	public function timeline_grid_menu_init() {
		
		add_submenu_page('edit.php?post_type=timeline_grid', __('Layout Editor','timeline_grid'), __('Layout Editor','timeline_grid'), 'manage_options', 'timeline_grid_layout_editor', array( $this, 'timeline_grid_layout_editor' ));
		
		add_submenu_page('edit.php?post_type=timeline_grid', __('Settings','timeline_grid'), __('Settings','timeline_grid'), 'manage_options', 'timeline_grid_menu_settings', array( $this, 'timeline_grid_menu_settings' ));	
		

			
	
	}



	
	
	}
	
new class_timeline_grid_settings();