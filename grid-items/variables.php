<?php
/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access

	global $post;
	$timeline_grid_meta_options = get_post_meta( $post_id, 'timeline_grid_meta_options', true );
	
	if(!empty($timeline_grid_meta_options['post_types']))
	$post_types = $timeline_grid_meta_options['post_types'];
	
	if(!empty($timeline_grid_meta_options['post_status']))
	$post_status = $timeline_grid_meta_options['post_status'];	
	

	//$offset = (int)$timeline_grid_meta_options['offset'];
	
	//var_dump($offset);
	
	if(!empty($timeline_grid_meta_options['posts_per_page'])){
		$posts_per_page = $timeline_grid_meta_options['posts_per_page'];
		}
	else{
		$posts_per_page = -1;
		}
	
	
	if(!empty($timeline_grid_meta_options['exclude_post_id']))	
	$exclude_post_id = $timeline_grid_meta_options['exclude_post_id'];
	
	if(!empty($timeline_grid_meta_options['query_order']))
	$query_order = $timeline_grid_meta_options['query_order'];	
	
	if(!empty($timeline_grid_meta_options['query_orderby']))
	$query_orderby = $timeline_grid_meta_options['query_orderby'];
	
	//var_dump($query_orderby);
	$str_orderby = '';
	foreach($query_orderby as $orderby){
		
		$str_orderby.= $orderby.' ';
		
		}
	$query_orderby = $str_orderby;
	//var_dump($query_orderby);
	
	if(!empty($timeline_grid_meta_options['query_orderby_meta_key'])){
		$query_orderby_meta_key = $timeline_grid_meta_options['query_orderby_meta_key'];
		}
	else{
		$query_orderby_meta_key = '';
		}

	if(!empty($timeline_grid_meta_options['layout']['content']))
	$layout_content = $timeline_grid_meta_options['layout']['content'];	
	
	if(!empty($timeline_grid_meta_options['layout']['hover']))
	$layout_hover = $timeline_grid_meta_options['layout']['hover'];
	
	if(!empty($timeline_grid_meta_options['skin'])){
		$skin = $timeline_grid_meta_options['skin'];	
		}
	else{
		$skin = 'flat';	
		
		}
	
	if(!empty($timeline_grid_meta_options['custom_js']))
	$custom_js = $timeline_grid_meta_options['custom_js'];	
	
	if(!empty($timeline_grid_meta_options['custom_css']))
	$custom_css = $timeline_grid_meta_options['custom_css'];

	
	if(!empty($timeline_grid_meta_options['width']['desktop'])){
		
		$items_width_desktop = $timeline_grid_meta_options['width']['desktop'];
		}
	else{
		$items_width_desktop = '50%';
		
		}
		

		
	if(!empty($timeline_grid_meta_options['items_bg_color_type'])){
		
		$items_bg_color_type = $timeline_grid_meta_options['items_bg_color_type'];
		}
	else{
		$items_bg_color_type = 'fixed';
		
		}		
		
		
	if(!empty($timeline_grid_meta_options['items_bg_color'])){
		
		$items_bg_color = $timeline_grid_meta_options['items_bg_color'];
		}
	else{
		$items_bg_color = '#fff';
		
		}		
		
		
		
	if(!empty($timeline_grid_meta_options['height']['style'])){
		
		$items_height_style = $timeline_grid_meta_options['height']['style'];
		}
	else{
		$items_height_style = 'auto_height';
		
		}				
			
	if(!empty($timeline_grid_meta_options['height']['fixed_height'])){
		
		$items_fixed_height = $timeline_grid_meta_options['height']['fixed_height'];
		}
	else{
		$items_fixed_height = '';
		
		}
		
		
	if(!empty($timeline_grid_meta_options['media_source'])){
		
		$media_source = $timeline_grid_meta_options['media_source'];
		}
	else{
		$media_source = array();
		
		}
		
	if(!empty($timeline_grid_meta_options['featured_img_size'])){
		
		$featured_img_size = $timeline_grid_meta_options['featured_img_size'];
		}
	else{
		$featured_img_size = 'full';
		
		}		
		
		
	if(!empty($timeline_grid_meta_options['thumb_linked'])){
		
		$thumb_linked = $timeline_grid_meta_options['thumb_linked'];
		}
	else{
		$thumb_linked = 'yes';
		
		}		
		

		
	if(!empty($timeline_grid_meta_options['container']['padding'])){
		
		$container_padding = $timeline_grid_meta_options['container']['padding'];
		}
	else{
		$container_padding = '';
		
		}	
		
	if(!empty($timeline_grid_meta_options['container']['bg_color'])){
		
		$container_bg_color = $timeline_grid_meta_options['container']['bg_color'];
		}
	else{
		$container_bg_color = '';
		
		}		
		
		
	if(!empty($timeline_grid_meta_options['container']['bg_image'])){
		
		$container_bg_image = $timeline_grid_meta_options['container']['bg_image'];
		}
	else{
		$container_bg_image = '';
		
		}				
		

		
	if(!empty($timeline_grid_meta_options['nav_top']['search'])){
		
		$nav_top_search = $timeline_grid_meta_options['nav_top']['search'];
		}
	else{
		$nav_top_search = 'none';
		
		}		
		
		
	if(!empty($timeline_grid_meta_options['nav_bottom']['pagination_type'])){
		
		$pagination_type = $timeline_grid_meta_options['nav_bottom']['pagination_type'];
		}
	else{
		$pagination_type = 'none';
		
		}		
		
	if(!empty($timeline_grid_meta_options['nav_bottom']['pagination_theme'])){
		
		$pagination_theme = $timeline_grid_meta_options['nav_bottom']['pagination_theme'];
		}
	else{
		$pagination_theme = 'lite';
		
		}




		
		if(empty($exclude_post_id))
			{
				$exclude_post_id = array();
			}
		else
			{
				$exclude_post_id = explode(',',$exclude_post_id);
			}
		

		
		if ( get_query_var('paged') ) {
		
			$paged = get_query_var('paged');
		
		} elseif ( get_query_var('page') ) {
		
			$paged = get_query_var('page');
		
		} else {
		
			$paged = 1;
		
		}
