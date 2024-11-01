<?php

/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access

class class_timeline_grid_shortcodes{
	
	
    public function __construct(){
		
		add_shortcode( 'timeline_grid', array( $this, 'timeline_grid_display' ) );

    }
	
	
	
	
	public function timeline_grid_display($atts, $content = null ) {
			$atts = shortcode_atts(
				array(
					'id' => "",
	
					), $atts);
	
				$html  = '';
				$post_id = $atts['id'];

				include timeline_grid_plugin_dir.'/grid-items/variables.php';
				include timeline_grid_plugin_dir.'/grid-items/query.php';
				include timeline_grid_plugin_dir.'/grid-items/custom-css.php';				



				$html.='<div id="timeline-grid-'.$post_id.'" class="timeline-grid">';

				$html.='<div class="timeline-grid-container">';



				if ( $wp_query->have_posts() ) :
				
				$html.='<div class="grid-nav-top">';	
				include timeline_grid_plugin_dir.'/grid-items/nav-top.php';							
				$html.='</div>';  // .grid-nav-top
				
				$html.='<div class="grid-middle-line"></div>';									
				
				$html.='<div class="grid-items">';
				
				/*
				$html.='<div  class="item post-input">';
				$html.='<div class="item-container">';
				$html.='<input type="text" class="new-post-title" placeholder="Title" value="" />';				
				//$html.='<textarea class="new-post-content" placeholder="Content goes here">Hello text</textarea>';
				$post_content = '';
				ob_start();
				wp_editor( stripslashes($post_content), 'new_post_content', $settings = array('textarea_name'=>'new_post_content','media_buttons'=>false,'wpautop'=>true,'teeny'=>true,'editor_height'=>'120px', ) );				
				$editor_contents = ob_get_clean();
				$html.= $editor_contents;
				$html.='<div class="add-post button">Submit</div>';			
				$html.='</div>';  // .item-container
				$html.='</div>';  // .item	
				
				*/
				
				$i=1;
				while ( $wp_query->have_posts() ) : $wp_query->the_post();
				

					if($i%2==0)
						{
						$odd_even = 'even';
						}
					else
						{
						$odd_even = 'odd';
						}
				
				
				$html.='<div  class="item '.$odd_even.' skin '.$skin.' '.timeline_grid_term_slug_list(get_the_ID()).'">';
					
							
				$html.='<div class="item-container">';
					
				include timeline_grid_plugin_dir.'/grid-items/layer-media.php';
				include timeline_grid_plugin_dir.'/grid-items/layer-content.php';
				include timeline_grid_plugin_dir.'/grid-items/layer-hover.php';	
				$html.='</div>';  // .item-container	
				$html.='</div>';  // .item		
				$i++;
				endwhile;
				wp_reset_query();
				$html.='</div>';  // .grid-items	
				$html.='</div>';  // .timeline-grid-container
				$html.='<div class="grid-nav-bottom">';	
				include timeline_grid_plugin_dir.'/grid-items/nav-bottom.php';
				$html.='</div>';  // .grid-nav-bottom	
				
				
				else:
				$html.='<div class="item">';
				$html.=__('No Post found',timeline_grid_textdomain);  // .item	
				$html.='</div>';  // .item					
				
				endif;
				
				include timeline_grid_plugin_dir.'/grid-items/scripts.php';	
				$html.='</div>';  // .timeline-grid

					$html .= "<script>jQuery(window).load(function(){jQuery('#timeline-grid-".$post_id." .grid-items').masonry({isFitWidth: true}); });</script>";
					
					$html .= "<script>jQuery(window).load(function(){
						 
						jQuery('.timeline-grid .grid-items .item').each(function(){
								
								posLeft = jQuery(this).position();
								
								posLeft = posLeft.left;
								
								if(posLeft == 0){
									
									html = '<span class=right-arrow></span>';
						
									jQuery(this).prepend(html);
									jQuery(this).addClass('right-point');			
						
								}
								else{
									html = '<span class=left-arrow></span><span class=left-point></span>';
									jQuery(this).prepend(html);
									jQuery(this).addClass('left-point');	
								}
							});
	
	
					
					
	
					});

					</script>";					
					
					


				


				return $html;
	
	
	}


	
	
	
	}

new class_timeline_grid_shortcodes();