<?php
/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access

	$class_timeline_grid_functions = new class_timeline_grid_functions();
	
	$timeline_grid_layout_content = get_option( 'timeline_grid_layout_content' );
	
	if(empty($timeline_grid_layout_content)){
		$layout = $class_timeline_grid_functions->layout_content($layout_content);
		}
	else{
		$layout = $timeline_grid_layout_content[$layout_content];
		
		}
	
	//$layout = $class_timeline_grid_functions->layout_content($layout_content);
	
	
	

	

	$html.='<div class="layer-content">';	
	
	foreach($layout as $item_id=>$item_info){
		
		$item_key = $item_info['key'];
		
		if(!empty($item_info['char_limit'])){
			$char_limit = $item_info['char_limit'];	
			}
			
		
		
		if($item_key=='title'){
			$html.='<div class="element element_'.$item_id.' '.$item_key.'" style="" >';

				$html.= wp_trim_words(get_the_title(), $char_limit,'');

			$html.='</div>';
			}
			
		elseif($item_key=='title_link'){
			$html.='<div class="element element_'.$item_id.' '.$item_key.'" style="" >';

				$html.= '<a href="'.get_permalink().'">'.wp_trim_words(get_the_title(), $char_limit,'').'</a>';

			
			$html.='</div>';
			}			
			
			
		elseif($item_key=='thumb'){
			
			$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
			$thumb_url = $thumb['0'];
	

			$html.='<div class="element element_'.$item_id.' '.$item_key.'" style="" >';
			if(!empty($thumb_url)){
				$html.= '<img src="'.$thumb_url.'" />';
				}
			$html.='</div>';
			}			
			
		elseif($item_key=='thumb_link'){
			
			$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
			$thumb_url = $thumb['0'];
	

			$html.='<div class="element element_'.$item_id.' '.$item_key.'" style="" >';
			
			if(!empty($thumb_url)){
				$html.= '<a href="'.get_permalink().'"><img src="'.$thumb_url.'" /></a>';
				}
				
			$html.='</div>';
			}			
			
			
			
		elseif($item_key=='excerpt'){
			$html.='<div class="element element_'.$item_id.' '.$item_key.'" style="" >';
				$html.= wp_trim_words(get_the_excerpt(), $char_limit,'');
			$html.='</div>';
			}

		elseif($item_key=='read_more'){

				$html.= '<a class="element element_'.$item_id.' '.$item_key.'" style="" class="read-more" href="'.get_permalink().'">'.__('Read more.', timeline_grid_textdomain).'</a>';

			}			
	
		elseif($item_key=='excerpt_read_more'){
			$html.='<div class="element element_'.$item_id.' '.$item_key.'" style="" >';
				$html.= wp_trim_words(get_the_excerpt(), $char_limit,'').' <a class="read-more" href="'.get_permalink().'">'.__('Read more.', timeline_grid_textdomain).'</a>';
			$html.='</div>';
			}
			
		elseif($item_key=='post_date'){
			$html.='<div class="element element_'.$item_id.' '.$item_key.'" style="" >';
				$html.= get_the_date();
			$html.='</div>';
			}			
			
		elseif($item_key=='author'){
			$html.='<div class="element element_'.$item_id.' '.$item_key.'" style="" >';
				$html.= get_the_author();
			$html.='</div>';
			}	
			
		elseif($item_key=='categories'){
			
			$html.='<div class="element element_'.$item_id.' '.$item_key.'" style="" >';
				$categories = get_the_category();
				$separator = ' ';
				$output = '';
				if ( ! empty( $categories ) ) {
					foreach( $categories as $category ) {
						$html .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
					}
					$html.= trim( $output, $separator );
				}
			$html.='</div>';
		}					
			
		elseif($item_key=='tags'){
			$html.='<div class="element element_'.$item_id.' '.$item_key.'" style="" >';
				$posttags = get_the_tags();
				if ($posttags) {
				  foreach($posttags as $tag){
					$html.= '<a href="#">'.$tag->name . '</a> , ';
					}
				}
			$html.='</div>';
		}
		
		elseif($item_key=='comments_count'){
			$html.='<div class="element element_'.$item_id.' '.$item_key.'" style="" >';
			
				$comments_number = get_comments_number( get_the_ID() );
				
				if(comments_open()){
					
					if ( $comments_number == 0 ) {
							$html.= __('No Comments',timeline_grid_textdomain);
						} elseif ( $comments_number > 1 ) {
							$html.= $comments_number . __(' Comments',timeline_grid_textdomain);
						} else {
							$html.= __('1 Comment',timeline_grid_textdomain);
						}
		
					}
			$html.='</div>';
		}		
		
		elseif($item_key=='wc_gallery'){
			$html.='<div class="element element_'.$item_id.' '.$item_key.'" style="" >';
			
				$is_product = get_post_type( get_the_ID() );
				$active_plugins = get_option('active_plugins');
				if(in_array( 'woocommerce/woocommerce.php', (array) $active_plugins ) && $is_product=='product'){
				global $woocommerce, $product;
				
				$gallery_attachment_ids = array_filter($product->get_gallery_attachment_ids());
				$gallery_html = '';
				if(!empty($gallery_attachment_ids)){
					
					foreach($gallery_attachment_ids as $id){
						
						$gallery_html.= '<a href="'.wp_get_attachment_url($id).'"><img src="'.wp_get_attachment_thumb_url($id).'" /></a>';
						}
					
					}
	
				
				
				$html.= $gallery_html;
				}
			$html.='</div>';
		}		
		
		elseif($item_key=='wc_full_price'){
			$html.='<div class="element element_'.$item_id.' '.$item_key.'" style="" >';
			
				$is_product = get_post_type( get_the_ID() );
				$active_plugins = get_option('active_plugins');
				if(in_array( 'woocommerce/woocommerce.php', (array) $active_plugins ) && $is_product=='product'){
				global $woocommerce, $product;
				
				$full_price = $product->get_price_html();
				
				$html.=$full_price;
				}
			$html.='</div>';
		}		
		
		
		
		elseif($item_key=='wc_sale_price'){
			$html.='<div class="element element_'.$item_id.' '.$item_key.'" style="" >';
			
				$is_product = get_post_type( get_the_ID() );
				$active_plugins = get_option('active_plugins');
				if(in_array( 'woocommerce/woocommerce.php', (array) $active_plugins ) && $is_product=='product'){
				global $woocommerce, $product;
				
				$currency_symbol = get_woocommerce_currency_symbol();
				$sale_price = $product->get_sale_price();
				
				if(!empty($sale_price)){
					$html.=$currency_symbol.$sale_price;
					}
				else{
					$html.= '';
					}
				
				}
		$html.='</div>';
		}		
		
		elseif($item_key=='wc_regular_price'){
			$html.='<div class="element element_'.$item_id.' '.$item_key.'" style="" >';
			
				$is_product = get_post_type( get_the_ID() );
				$active_plugins = get_option('active_plugins');
				if(in_array( 'woocommerce/woocommerce.php', (array) $active_plugins ) && $is_product=='product'){
				global $woocommerce, $product;
				
				$currency_symbol = get_woocommerce_currency_symbol();
				
				$regular_price = $product->get_regular_price();
				
				if(!empty($regular_price)){
					$html.=$currency_symbol.$regular_price;
					}
				else{
					$html.= '';
					}
				}
			$html.='</div>';
		}		
		
		
		elseif($item_key=='wc_add_to_cart'){
			$html.='<div class="element element_'.$item_id.' '.$item_key.'" style="" >';
			
				$is_product = get_post_type( get_the_ID() );
				$active_plugins = get_option('active_plugins');
				if(in_array( 'woocommerce/woocommerce.php', (array) $active_plugins ) && $is_product=='product'){
				global $woocommerce, $product;
				
					
					$add_to_cart = do_shortcode('[add_to_cart show_price="false" id="'.get_the_ID().'"]');
					$html.= $add_to_cart;
					
				}
			$html.='</div>';
		}			
		
		elseif($item_key=='wc_rating_star'){
			$html.='<div class="element element_'.$item_id.' '.$item_key.'" style="" >';
			
				$is_product = get_post_type( get_the_ID() );
				$active_plugins = get_option('active_plugins');
				if(in_array( 'woocommerce/woocommerce.php', (array) $active_plugins ) && $is_product=='product'){
				global $woocommerce, $product;
				
				$rating = $product->get_average_rating();
				$rating = (($rating/5)*100);
				
				if( $rating > 0 ){
					
					$rating_html = '<div class="woocommerce woocommerce-product-rating"><div class="star-rating" style="color:#444; padding-bottom:10px;" title="'.__('Rated',timeline_grid_textdomain).' '.$rating.'"><span style="width:'.$rating.'%;"></span></div></div>';
					
					}
				else{
					$rating_html = '';
					
					}
	
				$html.= $rating_html;
					
				}
			$html.='</div>';
		}			
		
		elseif($item_key=='wc_rating_text'){
			$html.='<div class="element element_'.$item_id.' '.$item_key.'" style="" >';
			
				$is_product = get_post_type( get_the_ID() );
				$active_plugins = get_option('active_plugins');
				if(in_array( 'woocommerce/woocommerce.php', (array) $active_plugins ) && $is_product=='product'){
				global $woocommerce, $product;
				
				$rating = $product->get_average_rating();
				//$rating = (($rating/5)*100);
				
				if( $rating > 0 ){
					
					$rating_html = $rating.' out of 5';
					
					}
				else{
					$rating_html = '';
					
					}
	
				$html.= $rating_html;
					
				}
			$html.='</div>';
		}
		
		elseif($item_key=='wc_categories'){
			$html.='<div class="element element_'.$item_id.' '.$item_key.'" style="" >';
			
				$is_product = get_post_type( get_the_ID() );
				$active_plugins = get_option('active_plugins');
				if(in_array( 'woocommerce/woocommerce.php', (array) $active_plugins ) && $is_product=='product'){
				global $woocommerce, $product;
				
				$categories = $product->get_categories();
				
	
				$html.= $categories;
					
				}
			$html.='</div>';
		}		
		
		
		elseif($item_key=='wc_tags'){
			$html.='<div class="element element_'.$item_id.' '.$item_key.'" style="" >';
			
				$is_product = get_post_type( get_the_ID() );
				$active_plugins = get_option('active_plugins');
				if(in_array( 'woocommerce/woocommerce.php', (array) $active_plugins ) && $is_product=='product'){
				global $woocommerce, $product;
				
				$tags = $product->get_tags();
				
	
				$html.= $tags;
					
				}
			$html.='</div>';
		}		
		
		elseif($item_key=='wc_sku'){
			$html.='<div class="element element_'.$item_id.' '.$item_key.'" style="" >';
			
				$is_product = get_post_type( get_the_ID() );
				$active_plugins = get_option('active_plugins');
				if(in_array( 'woocommerce/woocommerce.php', (array) $active_plugins ) && $is_product=='product'){
				global $woocommerce, $product;
				
				$sku = $product->get_sku();
				
	
				$html.= $sku;
					
				}
			$html.='</div>';
		}
		
		
		elseif($item_key=='edd_price'){
			$html.='<div class="element element_'.$item_id.' '.$item_key.'" style="" >';
			
				$is_download = get_post_type( get_the_ID() );
				$active_plugins = get_option('active_plugins');
				if(in_array( 'easy-digital-downloads/easy-digital-downloads.php', (array) $active_plugins ) && $is_download=='download'){

				
				$edd_price = edd_price(get_the_ID(),false);

				$html.= $edd_price;
					
				}
			$html.='</div>';
		}		
		
		elseif($item_key=='edd_variable_prices'){
			$html.='<div class="element element_'.$item_id.' '.$item_key.'" style="" >';
			
				$is_download = get_post_type( get_the_ID() );
				$active_plugins = get_option('active_plugins');
				if(in_array( 'easy-digital-downloads/easy-digital-downloads.php', (array) $active_plugins ) && $is_download=='download'){

				
				$prices = edd_get_variable_prices( get_the_ID() );
				if( $prices ) {
					$html_price = '';
					$html_price.= '<ul>';
					foreach( $prices as $price_id => $price ) {
						$html_price.= '<li>'.$price['name'].': '.$price['amount'].'</li>';; //is the name of the price
						
					}
					$html_price.= '</ul>';
				}

				$html.= $html_price;
					
				}
			$html.='</div>';
		}		
		
		
		elseif($item_key=='edd_sales_stats'){
			$html.='<div class="element element_'.$item_id.' '.$item_key.'" style="" >';
			
				$is_download = get_post_type( get_the_ID() );
				$active_plugins = get_option('active_plugins');
				if(in_array( 'easy-digital-downloads/easy-digital-downloads.php', (array) $active_plugins ) && $is_download=='download'){

				$sales_stats = edd_get_download_sales_stats( get_the_ID() );
				$html.= $sales_stats;
					
				}
			$html.='</div>';
		}	
		
		
		elseif($item_key=='edd_earnings_stats'){
			$html.='<div class="element element_'.$item_id.' '.$item_key.'" style="" >';
			
				$is_download = get_post_type( get_the_ID() );
				$active_plugins = get_option('active_plugins');
				if(in_array( 'easy-digital-downloads/easy-digital-downloads.php', (array) $active_plugins ) && $is_download=='download'){

				$earnings_stats = edd_get_download_earnings_stats( get_the_ID() );
				$html.= $earnings_stats;
					
				}
			$html.='</div>';
		}				
		
		
		elseif($item_key=='edd_add_to_cart'){
			$html.='<div class="element element_'.$item_id.' '.$item_key.'" style="" >';
			
				$is_download = get_post_type( get_the_ID() );
				$active_plugins = get_option('active_plugins');
				if(in_array( 'easy-digital-downloads/easy-digital-downloads.php', (array) $active_plugins ) && $is_download=='download'){

				$purchase_link = do_shortcode('[purchase_link id="'.get_the_ID().'" text="Add to Cart" style="button"]'  );
				$html.= $purchase_link;
					
				}
			$html.='</div>';
		}			
		
		elseif($item_key=='edd_categories'){
			$html.='<div class="element element_'.$item_id.' '.$item_key.'" style="" >';
			
				$is_download = get_post_type( get_the_ID() );
				$active_plugins = get_option('active_plugins');
				if(in_array( 'easy-digital-downloads/easy-digital-downloads.php', (array) $active_plugins ) && $is_download=='download'){

				$term_list = wp_get_post_terms($post->ID, 'download_category', array("fields" => "all"));
				
				if( $term_list ) {
					$html_term = '';

					foreach( $term_list as $term ) {
						$html_term.= '<a href="#">'.$term->name.'</a>, '; //is the name of the price
					}

				}
				
				$html.= $html_term;
					
				}
			$html.='</div>';
		}			
				
		elseif($item_key=='edd_tags'){
			$html.='<div class="element element_'.$item_id.' '.$item_key.'" style="" >';
			
				$is_download = get_post_type( get_the_ID() );
				$active_plugins = get_option('active_plugins');
				if(in_array( 'easy-digital-downloads/easy-digital-downloads.php', (array) $active_plugins ) && $is_download=='download'){

				$term_list = wp_get_post_terms($post->ID, 'download_tag', array("fields" => "all"));
				
				if( $term_list ) {
					$html_term = '';

					foreach( $term_list as $term ) {
						$html_term.= '<a href="#">'.$term->name.'</a>, '; //is the name of the price
					}

				}
				
				$html.= $html_term;
					
				}
			$html.='</div>';
		}		
		
		
		
		
		
		elseif($item_key=='WPeC_old_price'){
			
			$html.='<div class="element element_'.$item_id.' '.$item_key.'" style="" >';
			
				$is_product = get_post_type( get_the_ID() );
				$active_plugins = get_option('active_plugins');
				if(in_array( 'wp-e-commerce/wp-shopping-cart.php', (array) $active_plugins ) && $is_product=='wpsc-product'){

				$html.= wpsc_product_normal_price();
					
				}
			$html.='</div>';
		}
				
		elseif($item_key=='WPeC_sale_price'){
			
			$html.='<div class="element element_'.$item_id.' '.$item_key.'" style="" >';
			
				$is_product = get_post_type( get_the_ID() );
				$active_plugins = get_option('active_plugins');
				if(in_array( 'wp-e-commerce/wp-shopping-cart.php', (array) $active_plugins ) && $is_product=='wpsc-product'){

				$html.= wpsc_the_product_price();
					
				}
			$html.='</div>';
		}		
		
		
		
		elseif($item_key=='WPeC_rating_star'){
			
			$html.='<div class="element element_'.$item_id.' '.$item_key.'" style="" >';
			
				$is_product = get_post_type( get_the_ID() );
				$active_plugins = get_option('active_plugins');
				if(in_array( 'wp-e-commerce/wp-shopping-cart.php', (array) $active_plugins ) && $is_product=='wpsc-product'){

				$html.= wpsc_product_rater();
					
				}
			$html.='</div>';
		}
		

		elseif($item_key=='WPeC_categories'){
			$html.='<div class="element element_'.$item_id.' '.$item_key.'" style="" >';
			
				$is_product = get_post_type( get_the_ID() );
				$active_plugins = get_option('active_plugins');
				if(in_array( 'wp-e-commerce/wp-shopping-cart.php', (array) $active_plugins ) && $is_product=='wpsc-product'){

				$term_list = wp_get_post_terms($post->ID, 'wpsc_product_category', array("fields" => "all"));
				
				if( $term_list ) {
					$html_term = '';

					foreach( $term_list as $term ) {
						$html_term.= '<a href="#">'.$term->name.'</a>, '; //is the name of the price
					}

				}
				
				$html.= $html_term;
					
				}
			$html.='</div>';
		}	
		
		elseif($item_key=='WPeC_tags'){
			$html.='<div class="element element_'.$item_id.' '.$item_key.'" style="" >';
			
				$is_product = get_post_type( get_the_ID() );
				$active_plugins = get_option('active_plugins');
				if(in_array( 'wp-e-commerce/wp-shopping-cart.php', (array) $active_plugins ) && $is_product=='wpsc-product'){

				$term_list = wp_get_post_terms($post->ID, 'product_tag', array("fields" => "all"));
				
				if( $term_list ) {
					$html_term = '';

					foreach( $term_list as $term ) {
						$html_term.= '<a href="#">'.$term->name.'</a>, '; //is the name of the price
					}

				}
				
				$html.= $html_term;
					
				}
			$html.='</div>';
		}			
		
		
		
		
		
		elseif($item_key=='zoom'){
			$html.='<div class="element element_'.$item_id.' '.$item_key.'" style="" >';
			$html.= '<i class="fa fa-search"></i>';
			$html.='</div>';

		}		
		
		elseif($item_key=='share_button'){
			$html.='<div class="element element_'.$item_id.' '.$item_key.'" style="" >';
			$html.= '
			
			<span class="fb">
				<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u='.get_permalink().'"> </a>
			</span>
			<span class="twitter">
				<a target="_blank" href="https://twitter.com/intent/tweet?url='.get_permalink().'&text='.get_the_title().'"></a>
			</span>
			<span class="gplus">
				<a target="_blank" href="https://plus.google.com/share?url='.get_permalink().'"></a>
			</span>
			
			';
			$html.='</div>';

		}			
		
		elseif($item_key=='hr'){

			$html.= '<hr class="element element_'.$item_id.' '.$item_key.'" style="" />';

		}		
		
		elseif($item_key=='meta_key'){
			
			$meta_value = get_post_meta(get_the_ID(), $item_info['field_id'],true);
			if(!empty($meta_value)){
				
				$html.='<div class="element element_'.$item_id.' '.$item_key.'" style="" >';
				$html.= do_shortcode($meta_value);
				$html.='</div>';
				
				}


		}					
					
			

		}
	
	
	
	
	$html.='</div>'; // .layer-content