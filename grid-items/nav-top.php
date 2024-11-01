<?php
/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access



	if($nav_top_search=='yes'){
		
if(isset($_GET['keyword'])){
	
	$keyword = $_GET['keyword'];
	
	}
else{
	$keyword = '';
	}
		
		$html.= '<div class="nav-search">'; 
		$html.= '<input grid_id="'.$post_id.'"  placeholder="start typing..." class="search" type="text" value="'.$keyword.'" name="" />';		
		
		$html.= '</div>';
		}


