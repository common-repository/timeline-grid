<?php

/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access
	
	
	$class_timeline_grid_functions = new class_timeline_grid_functions();
	$items_bg_color_values = $class_timeline_grid_functions->items_bg_color_values();
	
	//var_dump($items_bg_color_values);
	
	
	$timeline_grid_layout_content = get_option( 'timeline_grid_layout_content' );
	
	if(empty($timeline_grid_layout_content)){
		$layout = $class_timeline_grid_functions->layout_content($layout_content);
		}
	else{
		$layout = $timeline_grid_layout_content[$layout_content];
		
		}
	
	$html .= '<style type="text/css">';	
	
	foreach($layout as $item_id=>$item_info){
		$item_css = $item_info['css'];
		
		$html .= '#timeline-grid-'.$post_id.' .element_'.$item_id.'{'.$item_css.'}';
		
		}
		
	foreach($layout as $item_id=>$item_info){
		$item_css_hover = $item_info['css_hover'];
		
		$html .= '#timeline-grid-'.$post_id.' .element_'.$item_id.':hover{'.$item_css_hover.'}';
		
		}		
		
	if($items_bg_color_type=='fixed'){
		
		//$html .= '#timeline-grid-'.$post_id.' .item{background:'.$items_bg_color.';}';
			
		}
	elseif($items_bg_color_type=='random'){
		
		$max_count = count($items_bg_color_values);
		$max_count = ($max_count - 1);		
		
		$i=0;
		foreach($items_bg_color_values as $value){
			
			
			$rand = rand(0,$max_count);
			$html .= '#timeline-grid-'.$post_id.' .item:nth-child('.$i.') .item-container{
				background:'.$items_bg_color_values[$rand].';
		
				}';
				
				$i++;
			}
		

		
		}
		
		
		

		
		
		
		
	
	$html .= '</style>';
	
	
	
	
	if($items_height_style == 'auto_height'){
		$items_media_height = 'auto';
		}
	elseif($items_height_style == 'fixed_height'){
		$items_media_height = $items_fixed_height;
		}
	else{
		$items_media_height = '220px';
		}
	
	
	
	
		
	if(!empty($custom_css)){
		$html .= '<style type="text/css">'.$custom_css.'</style>';	
		}
		
		$html .= '<style type="text/css">';
		
		$html .= '#timeline-grid-'.$post_id.' {
			padding:'.$container_padding.';
			background: '.$container_bg_color.' url('.$container_bg_image.') repeat scroll 0 0;
		}';

	
	if($skin=='flip-y' || $skin=='flip-x'){
		
	$html .= '#timeline-grid-'.$post_id.' .item{
		height:'.$items_media_height.' !important;
		}';	
		
		}


	
	$html .= '#timeline-grid-'.$post_id.' .item .layer-media{
		height:'.$items_media_height.';
		overflow: hidden;
		}';	


	$html .= '
	@media only screen and (min-width: 1024px ) {
	#timeline-grid-'.$post_id.' .item{width:50%}
	
	}
	
	@media only screen and ( min-width: 768px ) and ( max-width: 1023px ) {
	#timeline-grid-'.$post_id.' .item{width:50%}
	}
	
	@media only screen and ( min-width: 320px ) and ( max-width: 767px ) {
	#timeline-grid-'.$post_id.' .item{width:100%}
	}
			
			
			
			</style>';	