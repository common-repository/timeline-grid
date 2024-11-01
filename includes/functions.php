<?php

/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access





function timeline_grid_get_media($media_source, $featured_img_size, $thumb_linked){
		
		
		$html_thumb = '';
		
		
		if($media_source == 'featured_image'){
				$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), $featured_img_size );
				$thumb_url = $thumb['0'];
				
				if(!empty($thumb_url)){
					if($thumb_linked=='yes'){
						$html_thumb.= '<a href="'.get_permalink().'"><img src="'.$thumb_url.'" /></a>';
						}
					else{
						$html_thumb.= '<img src="'.$thumb_url.'" />';
						}
					
					
					}
				else{
					
					$html_thumb.= '';
					}

			}
			
			
		elseif($media_source == 'empty_thumb'){

				if($thumb_linked=='yes'){
					$html_thumb.= '<a href="'.get_permalink().'"><img src="'.timeline_grid_plugin_url.'assets/frontend/css/images/placeholder.png" /></a>';
					}
				else{
					$html_thumb.= '<img src="'.timeline_grid_plugin_url.'assets/frontend/css/images/placeholder.png" />';
					}

			}			
			
			
			
			
		elseif($media_source == 'first_image'){

			global $post, $posts;
			$first_img = '';
			ob_start();
			ob_end_clean();
			$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
			
			if(!empty($matches[1][0]))
			$first_img = $matches[1][0];
			
			if(empty($first_img)) {
				$html_thumb.= '';
				}
			else{
				
				if($thumb_linked=='yes'){
					$html_thumb.= '<a href="'.get_permalink().'"><img src="'.$first_img.'" /></a>';
					}
				else{
					$html_thumb.= '<img src="'.$first_img.'" />';
					}

				
				}

			
			}	
	

		return $html_thumb;
				
			
	
	
	}






function timeline_grid_reset_content_layouts(){
	

	$class_timeline_grid_functions = new class_timeline_grid_functions();
	$layout_content_list = $class_timeline_grid_functions->layout_content_list();
	update_option('timeline_grid_layout_content', $layout_content_list);
	
	
	}


add_action('wp_ajax_timeline_grid_reset_content_layouts', 'timeline_grid_reset_content_layouts');
add_action('wp_ajax_nopriv_timeline_grid_reset_content_layouts', 'timeline_grid_reset_content_layouts');


function timeline_grid_term_slug_list($post_id){
	$term_slug_list = '';
	
	$post_taxonomies = get_post_taxonomies($post_id);
	
	foreach($post_taxonomies as $taxonomy){
		
		$term_list[] = wp_get_post_terms(get_the_ID(), $taxonomy, array("fields" => "all"));
		
		}

	if(!empty($term_list)){
		foreach($term_list as $term_key=>$term) 
			{
				foreach($term as $term_id=>$term){
					$term_slug_list .= $term->slug.' ';
					}
			}
		
		}


	return $term_slug_list;

	}




function timeline_grid_posttypes($post_types){

	$html = '';
	$html .= '<select post_id="'.get_the_ID().'" class="post_types" multiple="multiple" size="6" name="timeline_grid_meta_options[post_types][]">';
	
		$post_types_all = get_post_types( '', 'names' ); 
		foreach ( $post_types_all as $post_type ) {

			global $wp_post_types;
			$obj = $wp_post_types[$post_type];
			
			if(in_array($post_type,$post_types)){
				$selected = 'selected';
				}
			else{
				$selected = '';
				}

			$html .= '<option '.$selected.' value="'.$post_type.'" >'.$obj->labels->singular_name.'</option>';
		}
		
	$html .= '</select>';
	return $html;
	}







function timeline_grid_layout_content_ajax(){
	
	$layout_key = $_POST['layout'];
	
	$class_timeline_grid_functions = new class_timeline_grid_functions();
	
	
	$timeline_grid_layout_content = get_option( 'timeline_grid_layout_content' );
	
	if(empty($timeline_grid_layout_content)){
		$layout = $class_timeline_grid_functions->layout_content($layout_key);
		}
	else{
		$layout = $timeline_grid_layout_content[$layout_key];
		
		}
	
	//$layout = $class_timeline_grid_functions->layout_content($layout_key);
	
	

	?>
    <div class="<?php echo $layout_key; ?>">
    <?php
    
		foreach($layout as $item_key=>$item_info){
			$item_key = $item_info['key'];
			?>
			

				<div class="item <?php echo $item_key; ?>" style=" <?php echo $item_info['css']; ?> ">
				
				<?php
				
				if($item_key=='thumb'){
					
					?>
					<img src="<?php echo timeline_grid_plugin_url; ?>assets/admin/images/thumb.png" />
					<?php
					}
					
				elseif($item_key=='title'){
					
					?>
					Lorem Ipsum is simply
					
					<?php
					}								
					
				elseif($item_key=='excerpt'){
					
					?>
					Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text
					<?php
					}	
					
				elseif($item_key=='excerpt_read_more'){
					
					?>
					Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text <a href="#">Read more</a>
					<?php
					}					
					
				elseif($item_key=='read_more'){
					
					?>
					<a href="#">Read more</a>
					<?php
					}												
					
				elseif($item_key=='post_date'){
					
					?>
					18/06/2015
					<?php
					}	
					
				elseif($item_key=='author'){
					
					?>
					PickPlugins
					<?php
					}					
					
				elseif($item_key=='categories'){
					
					?>
					<a hidden="#">Category 1</a> <a hidden="#">Category 2</a>
					<?php
					}
					
				elseif($item_key=='tags'){
					
					?>
					<a hidden="#">Tags 1</a> <a hidden="#">Tags 2</a>
					<?php
					}	
					
				elseif($item_key=='comments_count'){
					
					?>
					3 Comments
					<?php
					}
					
					// WooCommerce
				elseif($item_key=='wc_full_price'){
					
					?>
					<del>$45</del> - <ins>$40</ins>
					<?php
					}											
				elseif($item_key=='wc_sale_price'){
					
					?>
					$45
					<?php
					}					
									
				elseif($item_key=='wc_regular_price'){
					
					?>
					$45
					<?php
					}	
					
				elseif($item_key=='wc_add_to_cart'){
					
					?>
					Add to Cart
					<?php
					}	
					
				elseif($item_key=='wc_rating_star'){
					
					?>
					*****
					<?php
					}					
										
				elseif($item_key=='wc_rating_text'){
					
					?>
					2 Reviews
					<?php
					}	
				elseif($item_key=='wc_categories'){
					
					?>
					<a hidden="#">Category 1</a> <a hidden="#">Category 2</a>
					<?php
					}					
					
				elseif($item_key=='wc_tags'){
					
					?>
					<a hidden="#">Tags 1</a> <a hidden="#">Tags 2</a>
					<?php
					}
					
				elseif($item_key=='edd_price'){
					
					?>
					$45
					<?php
					}					
																										
					
				else{
					
					echo $item_info['name'];
					
					}
				
				?>
				
				
				
				</div>
				<?php
			}
	
	?>
    </div>
    <?php
	
	die();
	
	}
	
add_action('wp_ajax_timeline_grid_layout_content_ajax', 'timeline_grid_layout_content_ajax');
add_action('wp_ajax_nopriv_timeline_grid_layout_content_ajax', 'timeline_grid_layout_content_ajax');







function timeline_grid_layout_add_elements(){
	
	$item_key = $_POST['item_key'];
	$layout = $_POST['layout'];	
	$unique_id = $_POST['unique_id'];	

	$class_timeline_grid_functions = new class_timeline_grid_functions();
	$layout_items = $class_timeline_grid_functions->layout_items();



	$html = array();
	$html['item'] = '';
	$html['item'].= '<div class="item '.$item_key.'" >';	

    
    if($item_key=='thumb'){
		
        $html['item'].= '<img style="width:100%;" src="'.timeline_grid_plugin_url.'assets/admin/images/thumb.png" />';

        }
		
    elseif($item_key=='thumb_link'){
        
		$html['item'].= '<a href="#"><img style="width:100%;" src="'.timeline_grid_plugin_url.'assets/admin/images/thumb.png" /></a>';

        }		
		
        
    elseif($item_key=='title'){
        
		$html['item'].= 'Lorem Ipsum is simply';

        }
		
    elseif($item_key=='title_link'){
        
		$html['item'].= '<a href="#">Lorem Ipsum is simply</a>';

        }		
									
        
    elseif($item_key=='excerpt'){
        $html['item'].= 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text';
		

        }	
        
    elseif($item_key=='excerpt_read_more'){
        $html['item'].= 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text <a href="#">Read more</a>';

        }					
        
    elseif($item_key=='read_more'){
        $html['item'].= '<a href="#">Read more</a>';

        }												
        
    elseif($item_key=='post_date'){
        $html['item'].= '18/06/2015';

        }	
        
    elseif($item_key=='author'){
        $html['item'].= 'PickPlugins';

        }					
        
    elseif($item_key=='categories'){
        $html['item'].= '<a hidden="#">Category 1</a> <a hidden="#">Category 2</a>';

        }
        
    elseif($item_key=='tags'){
        $html['item'].= '<a hidden="#">Tags 1</a> <a hidden="#">Tags 2</a>';

        }	
        
    elseif($item_key=='comments_count'){
         $html['item'].= '3 Comments';

        }
        
        // WooCommerce
    elseif($item_key=='wc_full_price'){
        $html['item'].= '<del>$45</del> - <ins>$40</ins>';

        }											
    elseif($item_key=='wc_sale_price'){
        $html['item'].= '$45';

        }					
                        
    elseif($item_key=='wc_regular_price'){
         $html['item'].= '$45';

        }	
        
    elseif($item_key=='wc_add_to_cart'){
        $html['item'].= 'Add to Cart';

        }	
        
    elseif($item_key=='wc_rating_star'){
        $html['item'].= '*****';

        }					
                            
    elseif($item_key=='wc_rating_text'){
        $html['item'].= '2 Reviews';

        }	
    elseif($item_key=='wc_categories'){
        $html['item'].= '<a href="#">Category 1</a> <a href="#">Category 2</a>';

        }					
        
    elseif($item_key=='wc_tags'){
         $html['item'].= '<a href="#" >Tags 1</a> <a href="#">Tags 2</a>';

        }	
		
	/* WP eCommerce Stuff*/
		
    elseif($item_key=='WPeC_old_price'){
         $html['item'].= '$45';

        }
		
    elseif($item_key=='WPeC_sale_price'){
         $html['item'].= '$40';

        }		
    elseif($item_key=='WPeC_add_to_cart'){
         $html['item'].= 'Add to Cart';

        }		
		
    elseif($item_key=='WPeC_rating_star'){
         $html['item'].= '*****';

        }			
    elseif($item_key=='WPeC_categories'){
         $html['item'].= '<a href="#">Category 1</a> <a href="#">Category 2</a>';

        }		
		
		
    elseif($item_key=='meta_key'){
         $html['item'].= 'Meta Key';

        }			
																							
        
    else{
        
        echo '';
        
        }
     $html['item'].= '</div>';

	$html['options'] = '';
	$html['options'].= '<div class="items" id="'.$unique_id.'">';
	$html['options'].= '<div class="header"><span class="remove">X</span>'.$layout_items[$item_key].'</div>';
	$html['options'].= '<div class="options">';
	
	if($item_key=='meta_key'){
		
		$html['options'].= 'Meta Key: <br /><input type="text" value="" name="timeline_grid_layout_content['.$layout.']['.$unique_id.'][field_id]" /><br /><br />';
		}
		
	if($item_key=='title'  || $item_key=='title_link'  || $item_key=='excerpt' || $item_key=='excerpt_read_more' ){
		
		$html['options'].= 'Character limit: <br /><input type="text" value="20" name="timeline_grid_layout_content['.$layout.']['.$unique_id.'][char_limit]" /><br /><br />';
		}
		
		

	$html['options'].= '
	<input type="hidden" value="'.$item_key.'" name="timeline_grid_layout_content['.$layout.']['.$unique_id.'][key]" />
	<input type="hidden" value="'.$layout_items[$item_key].'" name="timeline_grid_layout_content['.$layout.']['.$unique_id.'][name]" />
	CSS: <br />
	<a target="_blank" href="http://www.pickplugins.com/demo/post-grid/sample-css-for-layout-editor/">Sample css</a><br />
	<textarea class="custom_css" name="timeline_grid_layout_content['.$layout.']['.$unique_id.'][css]" item_id="'.$item_key.'" style="width:50%" spellcheck="false" autocapitalize="off" autocorrect="off">font-size:12px;display:block;padding:10px;</textarea><br /><br />
	
	CSS Hover: <br />
	<textarea class="custom_css" name="timeline_grid_layout_content['.$layout.']['.$unique_id.'][css_hover]" item_id="'.$item_key.'" style="width:50%" spellcheck="false" autocapitalize="off" autocorrect="off"></textarea>';
	
	
	
	
	
	
	$html['options'].= '</div>';
	$html['options'].= '</div>';	



	echo json_encode($html);


	
	die();
	
	}
	
add_action('wp_ajax_timeline_grid_layout_add_elements', 'timeline_grid_layout_add_elements');
add_action('wp_ajax_nopriv_timeline_grid_layout_add_elements', 'timeline_grid_layout_add_elements');



function timeline_grid_ajax_load_more(){
		
		$html = '';
		$post_id = (int)$_POST['grid_id'];
		$per_page = (int)$_POST['per_page'];
		
		
		include timeline_grid_plugin_dir.'/grid-items/variables.php';
		
		$paged = (int)$_POST['paged'];
		
		include timeline_grid_plugin_dir.'/grid-items/query.php';
		
		if ( $wp_query->have_posts() ) :
			while ( $wp_query->have_posts() ) : $wp_query->the_post();

			
			$html.='<div class="item skin '.$skin.' '.timeline_grid_term_slug_list(get_the_ID()).'">';
			$html.='<div class="item-container">';
			include timeline_grid_plugin_dir.'/grid-items/layer-media.php';
			include timeline_grid_plugin_dir.'/grid-items/layer-content.php';
			include timeline_grid_plugin_dir.'/grid-items/layer-hover.php';
			$html.='</div>';  // .item-container
			$html.='</div>';  // .item
	
			endwhile;
			wp_reset_query();
		else:
		
		if($pagination_type=='load_more'){
			$html.= '<script>
			jQuery(document).ready(function($)
				{
					$(".load-more").html("'.__('No more post',timeline_grid_textdomain).'");
					$(".load-more").addClass("no-post");
	
					})
			
			
			</script>';
			}

		endif;
		
		echo $html;
		
		die();
		
	}

add_action('wp_ajax_timeline_grid_ajax_load_more', 'timeline_grid_ajax_load_more');
add_action('wp_ajax_nopriv_timeline_grid_ajax_load_more', 'timeline_grid_ajax_load_more');








function timeline_grid_ajax_search(){
		
		$html = '';
		$post_id = (int)$_POST['grid_id'];

		include timeline_grid_plugin_dir.'/grid-items/variables.php';
		$keyword = sanitize_text_field($_POST['keyword']);
		
		include timeline_grid_plugin_dir.'/grid-items/query.php';
		
		if ( $wp_query->have_posts() ) :
			while ( $wp_query->have_posts() ) : $wp_query->the_post();

			
			$html.='<div class="item skin '.$skin.' '.timeline_grid_term_slug_list(get_the_ID()).'">';
			$html.='<div class="item-container">';
			include timeline_grid_plugin_dir.'/grid-items/layer-media.php';
			include timeline_grid_plugin_dir.'/grid-items/layer-content.php';
			include timeline_grid_plugin_dir.'/grid-items/layer-hover.php';	
			$html.='</div>';  // .item-container
			$html.='</div>';  // .item		
	
			endwhile;
			wp_reset_query();
		else:
		
			$html.='<div class="item">';
			$html.=__('No Post found',timeline_grid_textdomain);  // .item	
			$html.='</div>';  // .item	
				
		endif;
		
		echo $html;
		
		die();
		
	}

add_action('wp_ajax_timeline_grid_ajax_search', 'timeline_grid_ajax_search');
add_action('wp_ajax_nopriv_timeline_grid_ajax_search', 'timeline_grid_ajax_search');



function timeline_grid_ajax_add_post(){
		
		$html = '';
		$post_id = (int)$_POST['grid_id'];

		include timeline_grid_plugin_dir.'/grid-items/variables.php';
		$keyword = sanitize_text_field($_POST['keyword']);
		
		include timeline_grid_plugin_dir.'/grid-items/query.php';
		
		if ( $wp_query->have_posts() ) :
			while ( $wp_query->have_posts() ) : $wp_query->the_post();

			
			$html.='<div class="item skin '.$skin.' '.timeline_grid_term_slug_list(get_the_ID()).'">';
			$html.='<div class="item-container">';
			include timeline_grid_plugin_dir.'/grid-items/layer-media.php';
			include timeline_grid_plugin_dir.'/grid-items/layer-content.php';
			include timeline_grid_plugin_dir.'/grid-items/layer-hover.php';	
			$html.='</div>';  // .item-container
			$html.='</div>';  // .item		
	
			endwhile;
			wp_reset_query();
				
		endif;
		
		echo $html;
		
		die();
		
	}

add_action('wp_ajax_timeline_grid_ajax_add_post', 'timeline_grid_ajax_add_post');
add_action('wp_ajax_nopriv_timeline_grid_ajax_add_post', 'timeline_grid_ajax_add_post');













	
	function timeline_grid_share_plugin(){
			
			?>
<iframe src="//www.facebook.com/plugins/like.php?href=https://wordpress.org/plugins/post-grid/%2F&amp;width&amp;layout=standard&amp;action=like&amp;show_faces=true&amp;share=true&amp;height=80&amp;appId=652982311485932" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:80px;" allowTransparency="true"></iframe>
            
            <br />
            <!-- Place this tag in your head or just before your close body tag. -->
            <script src="https://apis.google.com/js/platform.js" async defer></script>
            
            <!-- Place this tag where you want the +1 button to render. -->
            <div class="g-plusone" data-size="medium" data-annotation="inline" data-width="300" data-href="<?php echo timeline_grid_share_url; ?>"></div>
            
            <br />
            <br />
            <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo timeline_grid_share_url; ?>" data-text="<?php echo timeline_grid_plugin_name; ?>" data-via="ParaTheme" data-hashtags="WordPress">Tweet</a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>



            <?php

		
		}
	
	
	
	
	function timeline_grid_admin_notices()
		{
			$timeline_grid_license_key = get_option('timeline_grid_license_key');
			
			$html= '';

			if(empty($timeline_grid_license_key))
				{
					$admin_url = get_admin_url();
					
					$html.= '<div class="update-nag">';
					$html.= 'Please activate your license for <b>'.timeline_grid_plugin_name.' &raquo; <a href="'.$admin_url.'edit.php?post_type=timeline_grid&page=timeline_grid_menu_license">License</a></b>';
					$html.= '</div>';	
				}
			else
				{

				}

			echo $html;
		}
	
	add_action('admin_notices', 'timeline_grid_admin_notices');
		
		
		
		
		
		
	



		
		