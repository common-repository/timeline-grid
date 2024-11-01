<?php

/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access

class class_timeline_grid_functions{
	
	public function __construct(){
		
		
		}
	
	
	
	public function items_bg_color_values(){
		
						$color_values = array(	'#ff398a',
												'#f992fb',
												'#eaca93',
												'#8ed379',
												'#8b67a5',
												'#f6b8ad',
												'#73d4b4',
												'#00c5cd',
												'#ff8247',
												'#ff6a6a',
												'#00ced1',
												'#ff7256',
												'#777777',
												'#067668',												
												);
											
						$color_values = apply_filters('timeline_grid_filter_items_bg_color_values', $color_values);				
											
						return $color_values;
											
		
		}	
	
	
	
	
	
	public function media_source(){
		
						$media_source = array(
												array('id'=>'featured_image','title'=>'Featured Image','checked'=>'yes'),
												array('id'=>'first_image','title'=>'First images from content','checked'=>'yes'),
												array('id'=>'first_gallery','title'=>'First gallery from content','checked'=>'yes'),												
												array('id'=>'empty_thumb','title'=>'Empty thumbnail','checked'=>'yes'),												
											);
											
						$media_source = apply_filters('timeline_grid_filter_media_source', $media_source);				
											
						return $media_source;
											
		
		}
	
	
	public function layout_items(){
		
		$layout_items = array(
							
							/*Default Post Stuff*/
							'title'=>'Title',
							'title_link'=>'Title with Link',
							'content'=>'Content',							
							'read_more'=>'Read more',	
							'thumb'=>'Thumbnail',
							'thumb_link'=>'Thumbnail with Link',
							'excerpt'=>'Excerpt',
							'excerpt_read_more'=>'Excerpt with Read more',													
							'post_date'=>'Post date',
							'author'=>'Author',
							'categories'=>'Categories',
							'tags'=>'tags',								
							'comments_count'=>'Comments Count',
													
							'meta_key'=>'Meta Key',	
							
							//'zoom'=>'Zoom button',
							'share_button'=>'Share button',
							'hr'=>'Horizontal line',

								);
		
		$layout_items = apply_filters('timeline_grid_filter_layout_items', $layout_items);
		
		return $layout_items;
		}
	
	
	public function layout_content_list(){
		
		$layout_content_list = array(
		
									
						'flat-center'=>array(												
								'0'=>array('key'=>'title', 'char_limit'=>'20', 'name'=>'Title', 'css'=>'display: block;font-size: 21px;line-height: normal;padding: 5px 10px;text-align: center;', 'css_hover'=>''),
								'1'=>array('key'=>'excerpt', 'char_limit'=>'20', 'name'=>'Excerpt', 'css'=>'display: block;font-size: 12px;padding: 5px 10px;text-align: center;', 'css_hover'=>''),
								'2'=>array('key'=>'read_more', 'name'=>'Read more', 'css'=>'display: block;font-size: 12px;font-weight: bold;padding: 0 10px;text-align: center;', 'css_hover'=>''),

									),
									
						'flat-right'=>array(												
								'0'=>array('key'=>'title', 'char_limit'=>'20', 'name'=>'Title', 'css'=>'display: block;font-size: 21px;line-height: normal;padding: 5px 10px;text-align: right;', 'css_hover'=>''),
								'1'=>array('key'=>'excerpt', 'char_limit'=>'20', 'name'=>'Excerpt', 'css'=>'display: block;font-size: 12px;padding: 5px 10px;text-align: right;', 'css_hover'=>''),
								'2'=>array('key'=>'read_more', 'name'=>'Read more', 'css'=>'display: block;font-size: 12px;font-weight: bold;padding: 0 10px;text-align: right;', 'css_hover'=>''),					
									),
									
						'flat-left'=>array(												
								'0'=>array('key'=>'title', 'char_limit'=>'20', 'name'=>'Title', 'css'=>'display: block;font-size: 21px;line-height: normal;padding: 5px 10px;text-align: left;', 'css_hover'=>''),
								
								'1'=>array('key'=>'excerpt', 'char_limit'=>'20', 'name'=>'Excerpt', 'css'=>'display: block;font-size: 12px;padding: 5px 10px;text-align: left;', 'css_hover'=>''),
								'2'=>array('key'=>'read_more', 'name'=>'Read more', 'css'=>'display: block;font-size: 12px;font-weight: bold;padding: 0 10px;text-align: left;', 'css_hover'=>'')
									),

						);
		
		$layout_content_list = apply_filters('timeline_grid_filter_layout_content_list', $layout_content_list);
		
		
		return $layout_content_list;
		}	
	

	
	public function layout_content($layout){
		
		$layout_content = $this->layout_content_list();
		
		return $layout_content[$layout];
		}	
		
	
	
	public function layout_hover_list(){
		
		$layout_hover_list = array(
									
									
						'flat'=>array(												

								'0'=>array('key'=>'read_more', 'name'=>'Read more', 'css'=>'display: block;font-size: 12px;font-weight: bold;padding: 0 10px;text-align: center;')
									),										
						'flat-center'=>array(												

								'0'=>array('key'=>'read_more', 'name'=>'Read more', 'css'=>'display: block;font-size: 12px;font-weight: bold;padding: 0 10px;text-align: center;')
									),
										
		
						);
		
		$layout_hover_list = apply_filters('timeline_grid_filter_layout_hover_list', $layout_hover_list);
		
		
		return $layout_hover_list;
		}	
	

	
	public function layout_hover($layout){
		
		$layout_hover = $this->layout_hover_list();
		
		return $layout_hover[$layout];
		}	
	
	
	
	
	public function skins(){
		
		$skins = array(
		
						'flat'=> array(
										'slug'=>'flat',									
										'name'=>'Flat',
										'thumb_url'=>'',
										),		
		
						'flip-x'=> array(
										'slug'=>'flip-x',									
										'name'=>'Flip-x',
										'thumb_url'=>'',
										),

						'zoomin'=>array(
										'slug'=>'zoomin',
										'name'=>'ZoomIn',
										'thumb_url'=>'',
										),							
						
						'spinright'=>array(
										'slug'=>'spinright',
										'name'=>'SpinRight',
										'thumb_url'=>'',
										),

						'thumbrounded'=>array(
										'slug'=>'thumbrounded',
										'name'=>'ThumbRounded',
										'thumb_url'=>'',
										),																											
										
																															
					
						
						);
		
		$skins = apply_filters('timeline_grid_filter_skins', $skins);	
		
		return $skins;
		
		}
	


	}
	
//new class_timeline_grid_functions();