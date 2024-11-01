<?php
/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access


function timeline_grid_posttype_register() {
 
        $labels = array(
                'name' => _x('Timeline Grid', 'timeline_grid'),
                'singular_name' => _x('Timeline Grid', 'timeline_grid'),
                'add_new' => _x('New Timeline Grid', 'timeline_grid'),
                'add_new_item' => __('New Timeline Grid'),
                'edit_item' => __('Edit Timeline Grid'),
                'new_item' => __('New Timeline Grid'),
                'view_item' => __('View Timeline Grid'),
                'search_items' => __('Search Timeline Grid'),
                'not_found' =>  __('Nothing found'),
                'not_found_in_trash' => __('Nothing found in Trash'),
                'parent_item_colon' => ''
        );
 
        $args = array(
                'labels' => $labels,
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'query_var' => true,
                'menu_icon' => null,
                'rewrite' => true,
                'capability_type' => 'post',
                'hierarchical' => false,
                'menu_position' => null,
                'supports' => array('title'),
				'menu_icon' => 'dashicons-media-spreadsheet',
				
          );
 
        register_post_type( 'timeline_grid' , $args );

}

add_action('init', 'timeline_grid_posttype_register');





/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function meta_boxes_timeline_grid()
	{
		$screens = array( 'timeline_grid' );
		foreach ( $screens as $screen )
			{
				add_meta_box('timeline_grid_metabox',__( 'Timeline Grid Options','timeline_grid' ),'meta_boxes_timeline_grid_input', $screen);
			}
	}
add_action( 'add_meta_boxes', 'meta_boxes_timeline_grid' );


function meta_boxes_timeline_grid_input( $post ) {
	
	global $post;
	wp_nonce_field( 'meta_boxes_timeline_grid_input', 'meta_boxes_timeline_grid_input_nonce' );
	
	
	$timeline_grid_meta_options = get_post_meta( $post->ID, 'timeline_grid_meta_options', true );
	

	if(!empty($timeline_grid_meta_options['post_types'])){
		$post_types = $timeline_grid_meta_options['post_types'];
		}
	else{
		$post_types = array('post');
		}	
	

	
	if(!empty($timeline_grid_meta_options['post_status'])){
		$post_status = $timeline_grid_meta_options['post_status'];
		}
	else{
		$post_status = array('publish');
		}	
	
	
	if(!empty($timeline_grid_meta_options['posts_per_page'])){
		$posts_per_page = $timeline_grid_meta_options['posts_per_page'];
		
		}
	else{
		$posts_per_page = 10;
		}
	
	
	if(!empty($timeline_grid_meta_options['exclude_post_id']))	
	$exclude_post_id = $timeline_grid_meta_options['exclude_post_id'];
	
	
	if(!empty($timeline_grid_meta_options['query_order'])){
		$query_order = $timeline_grid_meta_options['query_order'];
		}
	else{
		$query_order = 'DESC';
		}	
	
	if(!empty($timeline_grid_meta_options['query_orderby'])){
		$query_orderby = $timeline_grid_meta_options['query_orderby'];
		}
	else{
		$query_orderby = array('date');
		}

	
	if(!empty($timeline_grid_meta_options['query_orderby_meta_key']))
	$query_orderby_meta_key = $timeline_grid_meta_options['query_orderby_meta_key'];
	

	if(!empty($timeline_grid_meta_options['layout']['content'])){
		
		$layout_content = $timeline_grid_meta_options['layout']['content'];	
		}
	else{
		$layout_content = 'flat';	
		}
	
	
	if(!empty($timeline_grid_meta_options['layout']['hover']))
	$layout_hover = $timeline_grid_meta_options['layout']['hover'];		
	
	
	if(!empty($timeline_grid_meta_options['skin'])){
		$skin = $timeline_grid_meta_options['skin'];
		}
	else{
		$skin = 'flat';
		}
		
	
	if(!empty($timeline_grid_meta_options['custom_js'])){
		$custom_js = $timeline_grid_meta_options['custom_js'];
		}
	else{
		$custom_js = '/*Write your js code here*/';
		}
		
	
	if(!empty($timeline_grid_meta_options['custom_css'])){
		$custom_css = $timeline_grid_meta_options['custom_css'];
		}
	else{
		$custom_css = '/*Write your CSS code here*/';
		}
		
	
	if(!empty($timeline_grid_meta_options['width']['desktop'])){
		
		$items_width_desktop = $timeline_grid_meta_options['width']['desktop'];
		}
	else{
		$items_width_desktop = '280px';
		
		}
		
		
	if(!empty($timeline_grid_meta_options['width']['tablet'])){
		
		$items_width_tablet = $timeline_grid_meta_options['width']['tablet'];
		}
	else{
		$items_width_tablet = '280px';
		
		}		
		
	if(!empty($timeline_grid_meta_options['width']['mobile'])){
		
		$items_width_mobile = $timeline_grid_meta_options['width']['mobile'];
		}
	else{
		$items_width_mobile = '90%';
		
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
		$items_fixed_height = '180px';
		
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
		$featured_img_size = 'large';
		
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
		$container_padding = '0 0 30px 0';
		
		}	
		
	if(!empty($timeline_grid_meta_options['container']['bg_color'])){
		
		$container_bg_color = $timeline_grid_meta_options['container']['bg_color'];
		}
	else{
		$container_bg_color = '#fff';
		
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
		
		
		
		
		
		
		
		
		
?>

    <div class="para-settings post-grid-metabox">



        <ul class="tab-nav"> 
            <li nav="1" class="nav1 active"><i class="fa fa-code"></i> <?php _e('Shortcodes','timeline_grid'); ?></li>
            <li nav="2" class="nav2"><i class="fa fa-cubes"></i> <?php _e('Query Post','timeline_grid'); ?></li>
            <li nav="3" class="nav3"><i class="fa fa-object-group"></i> <?php _e('Layout','timeline_grid'); ?></li>
            <li nav="4" class="nav3"><i class="fa fa-magic"></i> <?php _e('Layout settings','timeline_grid'); ?></li>            
            <li nav="5" class="nav4"><i class="fa fa-sliders"></i> <?php _e('Naviagtions','timeline_grid'); ?></li>            
            <li nav="6" class="nav6"><i class="fa fa-css3"></i> <?php _e('Custom Scripts','timeline_grid'); ?></li>           
            
                     
                       
        </ul> <!-- tab-nav end -->
        
		<ul class="box">
            <li style="display: block;" class="box1 tab-box active">
                <div class="option-box">
                    <p class="option-title"><?php _e('Shortcode','timeline_grid'); ?></p>
                    <p class="option-info"><?php _e('Copy this shortcode and paste on page or post where you want to display Timeline Grid. <br />Use PHP code to your themes file to display Timeline Grid.','timeline_grid'); ?></p>
                    <textarea cols="50" rows="1" style="background:#bfefff" onClick="this.select();" >[timeline_grid <?php echo 'id="'.$post->ID.'"';?>]</textarea>
                <br /><br />
                PHP Code:<br />
                <textarea cols="50" rows="1" style="background:#bfefff" onClick="this.select();" ><?php echo '<?php echo do_shortcode("[timeline_grid id='; echo "'".$post->ID."']"; echo '"); ?>'; ?></textarea>  
                </div>
               
            </li>
            <li style="display: none;" class="box2 tab-box ">
                <div class="option-box">
                    <p class="option-title"><?php _e('Post Types','timeline_grid'); ?></p>
                    <p class="option-info"><?php _e('Select post types you want to query post , can be select multiple. <br />Hint: Ctrl + click to select mulitple','timeline_grid'); ?></p>
                    <?php
					echo timeline_grid_posttypes($post_types);
					?>

                </div>
                
     
                <div class="option-box">
                    <p class="option-title"><?php _e('Post Status','timeline_grid'); ?></p>
                    <p class="option-info"><?php _e('Display post from following post status, <br />Hint: Ctrl + click to select mulitple','timeline_grid'); ?></p>
                    
                    <select class="post_status" name="timeline_grid_meta_options[post_status][]" multiple >
                        <option value="publish" <?php if(in_array("publish",$post_status)) echo "selected"; ?>>Publish</option>
                        <option value="pending" <?php if(in_array("pending",$post_status)) echo "selected"; ?>>Pending</option>
                        <option value="draft" <?php if(in_array("draft",$post_status)) echo "selected"; ?>>Draft</option>
                        <option value="auto-draft" <?php if(in_array("auto-draft",$post_status)) echo "selected"; ?>>Auto draft</option>
                        <option value="future" <?php if(in_array("future",$post_status)) echo "selected"; ?>>Future</option>
                        <option value="private" <?php if(in_array("private",$post_status)) echo "selected"; ?>>Private</option>                    
                        <option value="inherit" <?php if(in_array("inherit",$post_status)) echo "selected"; ?>>Inherit</option>                    
                        <option value="trash" <?php if(in_array("trash",$post_status)) echo "selected"; ?>>Trash</option>
                        <option value="any" <?php if(in_array("any",$post_status)) echo "selected"; ?>>Any</option>                                          
                    </select> 
                    
                </div>                         
                        
                <div class="option-box">
                    <p class="option-title"><?php _e('Posts per page','timeline_grid'); ?></p>
                    <p class="option-info"><?php _e('Number of post each pagination. -1 to display all. default is 10 if you left empty.','timeline_grid'); ?></p>
                    <input type="text" placeholder="3" name="timeline_grid_meta_options[posts_per_page]" value="<?php if(!empty($posts_per_page)) echo $posts_per_page; else echo ''; ?>" />
                </div>                        

                <div class="option-box">
                    <p class="option-title"><?php _e('Exclude by post ID','timeline_grid'); ?></p>
                    <p class="option-info"><?php _e('you can exclude post by ID, comma(,) separated','timeline_grid'); ?></p>
                    
                    <input type="text" placeholder="5,3" name="timeline_grid_meta_options[exclude_post_id]" value="<?php if(!empty($exclude_post_id)) echo $exclude_post_id; else echo ''; ?>" />  
                </div>
                              
                
                <div class="option-box">
                    <p class="option-title"><?php _e('Post query order','timeline_grid'); ?></p>
                    <p class="option-info"><?php _e('Query order ascending or descending','timeline_grid'); ?></p>
                    
                    <select class="query_order" name="timeline_grid_meta_options[query_order]" >
                    <option value="ASC" <?php if($query_order=="ASC") echo "selected"; ?>>Ascending</option>
                    <option value="DESC" <?php if($query_order=="DESC") echo "selected"; ?>>Descending</option>
                    </select>
                    
                </div>
                
                
                <div class="option-box">
                    <p class="option-title"><?php _e('Post query orderby','timeline_grid'); ?></p>
                    <p class="option-info"><?php _e('Query orderby parameter, can select multiple','timeline_grid'); ?></p>
                    
                        <select class="query_orderby" name="timeline_grid_meta_options[query_orderby][]"  multiple>
                        <option value="ID" <?php if(in_array("ID",$query_orderby)) echo "selected"; ?>>ID</option>
                        <option value="date" <?php if(in_array("date",$query_orderby)) echo "selected"; ?>>Date</option>
                        <option value="rand" <?php if(in_array("rand",$query_orderby)) echo "selected"; ?>>Rand</option>                    
                        <option value="comment_count" <?php if(in_array("comment_count",$query_orderby)) echo "selected"; ?>>Comment Count</option>
                        <option value="author" <?php if(in_array("author",$query_orderby)) echo "selected"; ?>>Author</option>               
                        <option value="title" <?php if(in_array("title",$query_orderby)) echo "selected"; ?>>Title</option>
                        <option value="name" <?php if(in_array("name",$query_orderby)) echo "selected"; ?>>Name</option>                    
                        <option value="type" <?php if(in_array("type",$query_orderby)) echo "selected"; ?>>Type</option>
                        <option value="meta_value" <?php if(in_array("meta_value",$query_orderby)) echo "selected"; ?>>Meta Value</option>
                        <option value="meta_value_num" <?php if(in_array("meta_value_num",$query_orderby)) echo "selected"; ?>>Meta Value(number)</option>
                        </select>
                        <br />
                        
                        
                        <input type="text" placeholder="meta_key" name="timeline_grid_meta_options[query_orderby_meta_key]" id="query_orderby_meta_key" value="<?php if(!empty($query_orderby_meta_key)) echo $query_orderby_meta_key; ?>" />
                    
                </div>                 

           
                
            </li>
            <li style="display: none;" class="box3 tab-box ">
            
            
            
                <div class="option-box">
                    <p class="option-title"><?php _e('Layout','timeline_grid'); ?></p>
                    <p class="option-info"><?php _e('Choose your layout','timeline_grid'); ?></p>
                    
                    <?php
                    $class_timeline_grid_functions = new class_timeline_grid_functions();
					?>

                    <div class="layout-list">
                        <div class="idle  ">
                        <div class="name">Content
                        
                        <select class="select-layout-content" name="timeline_grid_meta_options[layout][content]" >
                        <?php
                        
                        $layout_content_list = $class_timeline_grid_functions->layout_content_list();
                        foreach($layout_content_list as $layout_key=>$layout_info){
                            ?>
                            <option <?php if($layout_content==$layout_key) echo 'selected'; ?>  value="<?php echo $layout_key; ?>"><?php echo $layout_key; ?></option>
                            <?php
                            
                            }
                        ?>
                        </select>
                        <a target="_blank" class="edit-layout" href="<?php echo admin_url().'edit.php?post_type=timeline_grid&page=timeline_grid_layout_editor&layout_content='.$layout_content;?>" >Edit</a>
                        </div>     
                        
                        <script>
                            jQuery(document).ready(function($)
                                {
                                    $(document).on('change', '.select-layout-content', function()
                                        {
                            
                                            
                                            var layout = $(this).val();		
                                            
                                            $('.edit-layout').attr('href', '<?php echo admin_url().'edit.php?post_type=timeline_grid&page=timeline_grid_layout_editor&layout_content='; ?>'+layout);
                                            })
                                    
                                })
                        </script>
                        
                        
                        
                        
                        
                        
                        
                        <?php
                        
                        if(empty($layout_content)){
                            $layout_content = 'flat-left';
                            }
                        
                        
                        ?>
                        
                                       
                            <div class="layer-content">
                                <div class="<?php echo $layout_content; ?>">
                                <?php
                                $timeline_grid_layout_content = get_option( 'timeline_grid_layout_content' );
                                
                                if(empty($timeline_grid_layout_content)){
                                    $layout = $class_timeline_grid_functions->layout_content($layout_content);
                                    }
                                else{
                                    $layout = $timeline_grid_layout_content[$layout_content];
                                    
                                    }
                                
                              //  $layout = $class_timeline_grid_functions->layout_content($layout_content);
                                
                                //var_dump($layout);
                                
                                foreach($layout as $item_key=>$item_info){
                                    
                                    $item_key = $item_info['key'];
                                    
                                    
                                    
                                    ?>
                                    
            
                                        <div class="item <?php echo $item_key; ?>" style=" <?php echo $item_info['css']; ?> ">
                                        
                                        <?php
                                        
                                        if($item_key=='thumb'){
                                            
                                            ?>
                                            <img style="width:100%; height:auto;" src="<?php echo timeline_grid_plugin_url; ?>assets/admin/images/thumb.png" />
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
                                            
                                            
                                            
                                        else{
                                            
                                            echo $item_info['name'];
                                            
                                            }
                                        
                                        ?>
                                        
                                        
                                        
                                        </div>
                                        <?php
                                    }
                                
                                
                                ?>
                                </div>
                            </div>
                        </div>
                                        
                    </div>

                </div> 
            
            
            
                <div class="option-box">
                    <p class="option-title"><?php _e('Skins','timeline_grid'); ?></p>
                    <p class="option-info"><?php _e('Select grid Skins','timeline_grid'); ?></p>
                    
                    <?php
                    
					
					$skins = $class_timeline_grid_functions->skins();
					
					
					?>
                    
                    <div class="skin-list">
                    
                    <?php 
					//var_dump($skin);
					foreach($skins as $skin_slug=>$skin_info){
						
						?>
                        <div class="skin-container">
                        
                        
                        <?php
                        
						if($skin==$skin_slug){
							
							$checked = 'checked';
							$selected_skin = 'selected';							
							}
						else{
							$checked = '';
							$selected_skin = '';	
							}
						
						?>
                        <div class="checked <?php echo $selected_skin; ?>">
                        
                        <label><input <?php echo $checked; ?> type="radio" name="timeline_grid_meta_options[skin]" value="<?php echo $skin_slug; ?>" ><?php echo $skin_info['name']; ?></label>

                        
                        </div>
                        
                        
                        <div class="skin <?php echo $skin_slug; ?>">
                        
                        
                        <?php
                        
						include timeline_grid_plugin_dir.'skins/index.php';
						
						?>
                        </div>
                        </div>
                        <?php
						
						}
					
					?>
                    
                    
                    
                    </div>
                    
                    
                </div>
                 
            </li>
            <li style="display: none;" class="box4 tab-box ">
            

                
                <div class="option-box">
                    <p class="option-title"><?php _e('Grid Items Background color','timeline_grid'); ?></p>
                    <p class="option-info"><?php _e('Grid item Background color','timeline_grid'); ?></p>
                    
                    Background color type:<br>
                    <label><input <?php if($items_bg_color_type=='fixed') echo 'checked'; ?> type="radio" name="timeline_grid_meta_options[items_bg_color_type]" value="fixed" />Fixed</label><br />
                    
                    <br><br>
                    Fixed Background color:<br>
                    <input type="text" class="color" name="timeline_grid_meta_options[items_bg_color]" value="<?php echo $items_bg_color; ?>" />

                </div>                

                
                <div class="option-box">
                    <p class="option-title"><?php _e('Media Height','timeline_grid'); ?></p>
                    <p class="option-info"><?php _e('Grid item media height','timeline_grid'); ?></p>
					
                    <label><input <?php if($items_height_style=='auto_height') echo 'checked'; ?> type="radio" name="timeline_grid_meta_options[height][style]" value="auto_height" />Auto height</label><br />
                    <label><input <?php if($items_height_style=='fixed_height') echo 'checked'; ?> type="radio" name="timeline_grid_meta_options[height][style]" value="fixed_height" />Fixed height</label><br />                 
                    
                    <div class="">

                    <input type="text" name="timeline_grid_meta_options[height][fixed_height]" value="<?php echo $items_fixed_height; ?>" />
                  	</div>                      

                </div>                
                
                
                <div class="option-box">


					<?php


					$get_intermediate_image_sizes =  get_intermediate_image_sizes();

					
					?>



                    <p class="option-title"><?php _e('Featured Image size','timeline_grid'); ?></p>
                    <select name="timeline_grid_meta_options[featured_img_size]" >
                    
                    <?php
                    
					foreach($get_intermediate_image_sizes as $size_key){
						
						?>
                        <option value="<?php echo $size_key; ?>" <?php if($featured_img_size==$size_key)echo "selected"; ?>>
						
						
						<?php 
						
						$size_key = str_replace('_', ' ',$size_key);
						$size_key = str_replace('-', ' ',$size_key);						
						$size_key = ucfirst($size_key);

						echo $size_key; 
						
						?>
                        
                        </option>
                        
                        
                        <?php
						
						
						}
					
					?>
                    
    
                       
                    </select>
                    
                     <p class="option-title"><?php _e('Featured Image linked to post','timeline_grid'); ?></p>
                    <select name="timeline_grid_meta_options[thumb_linked]" >
                    <option value="yes" <?php if($thumb_linked=="yes")echo "selected"; ?>><?php _e('Yes','timeline_grid'); ?></option>
                    <option value="no" <?php if($thumb_linked=="no")echo "selected"; ?>><?php _e('No','timeline_grid'); ?></option>
      
                       
                    </select>                    
                    
                    
                    <p class="option-title"><?php _e('Media source','timeline_grid'); ?></p>
                    <p class="option-info"><?php _e('Grid item media source','timeline_grid'); ?></p>
                	<?php
                    if(empty($media_source)){
						
						$media_source = $class_timeline_grid_functions->media_source();
						}
					
					
					?>
                
                
                
                
                    
                    <div class="media-source-list expandable">
                    	
                        <?php
                        foreach($media_source as $source_key=>$source_info){
							?>
							<div class="items">
                                <div class="header">
                                <input type="hidden" name="timeline_grid_meta_options[media_source][<?php echo $source_info['id']; ?>][id]" value="<?php echo $source_info['id']; ?>" />
                                <input type="hidden" name="timeline_grid_meta_options[media_source][<?php echo $source_info['id']; ?>][title]" value="<?php echo $source_info['title']; ?>" />
                                
                                <input <?php if(!empty($source_info['checked'])) echo 'checked'; ?> type="checkbox" name="timeline_grid_meta_options[media_source][<?php echo $source_info['id']; ?>][checked]" value="<?php echo $source_info['checked']; ?>" />                                
                                                           
                                
                                <?php echo $source_info['title']; ?>
                                </div>
                            </div>
	
							<?php
							
							
							}
						
						?>
                        
                        
                                           
                        
                        
                    
                  	</div>                      

<script>
jQuery(document).ready(function($)
	{
		$( ".media-source-list" ).sortable({revert: "invalid"});

	})
</script>

                </div>                 
                

                
                <div class="option-box">
                    <p class="option-title"><?php _e('Grid Container options','timeline_grid'); ?></p>
                    <p class="option-info"><?php _e('Grid container ','timeline_grid'); ?></p>
                    
                    <div class="">
                    Padding: <br>
                    <input type="text" name="timeline_grid_meta_options[container][padding]" value="<?php echo $container_padding; ?>" />
                  	</div>
                     <br>
                    <div class="">
                    Background color: <br>
                    <input type="text" class="color" name="timeline_grid_meta_options[container][bg_color]" value="<?php echo $container_bg_color; ?>" />
                  	</div>
                    <br>
                    <div class="">
                    Background image: <br>
                    <img class="bg_image_src" onClick="bg_img_src(this)" src="<?php echo timeline_grid_plugin_url; ?>assets/admin/bg/dark_embroidery.png" />
                    <img class="bg_image_src" onClick="bg_img_src(this)" src="<?php echo timeline_grid_plugin_url; ?>assets/admin/bg/dimension.png" />
                    <img class="bg_image_src" onClick="bg_img_src(this)" src="<?php echo timeline_grid_plugin_url; ?>assets/admin/bg/eight_horns.png" />                     
                    
                    <br>
                    
                    <input type="text" id="container_bg_image" class="container_bg_image" name="timeline_grid_meta_options[container][bg_image]" value="<?php echo $container_bg_image; ?>" /> <div onClick="clear_container_bg_image()" class="button clear-container-bg-image"> Clear</div>
                    
                    <script>
					
					function bg_img_src(img){
						
						src =img.src;
						
						document.getElementById('container_bg_image').value  = src;
						
						}
					
					function clear_container_bg_image(){

						document.getElementById('container_bg_image').value  = '';
						
						}					
					
					
					</script>
                    
                    
                    
                    
                  	</div>                    
                    
                                                        

                </div>                           
            
            
            </li>
            <li style="display: none;" class="box5 tab-box ">
            
                <div class="option-box">
                    <p class="option-title"><?php _e('Navigation','timeline_grid'); ?></p>
                    <p class="option-info"><?php _e('Customize navigation layout.','timeline_grid'); ?></p>
                    
                    
                    <div class="grid-layout">
                    	<div class="grid-up">
                            <label><input <?php if($nav_top_search=='yes') echo 'checked'; ?> type="checkbox" name="timeline_grid_meta_options[nav_top][search]" value="yes" />Search</label>
                        
                        </div>
                        <div class="grid-container">
                        <img src="<?php echo timeline_grid_plugin_url; ?>assets/admin/images/grid.png" />
                        </div>
                    	<div class="grid-bottom">
                        
                         	<label><input <?php if($pagination_type=='none') echo 'checked'; ?>  type="radio" name="timeline_grid_meta_options[nav_bottom][pagination_type]" value="none" />None</label>
                        	<label><input <?php if($pagination_type=='pagination') echo 'checked'; ?> type="radio" name="timeline_grid_meta_options[nav_bottom][pagination_type]" value="pagination" />Pagination</label>
                        	<label><input <?php if($pagination_type=='load_more') echo 'checked'; ?> type="radio" name="timeline_grid_meta_options[nav_bottom][pagination_type]" value="load_more" />Load More</label>                         	


<!-- 
                            <label><input <?php if($pagination_type=='infinite_scroll') echo 'checked'; ?> type="radio" name="timeline_grid_meta_options[nav_bottom][pagination_type]" value="infinite_scroll" />Infinite Scroll</label> 


-->

                      
                            
                        </div> 
                        
                        
                    </div>

                    
                </div>
                
                
                <div class="option-box">
                    <p class="option-title"><?php _e('Pagination themes','timeline_grid'); ?></p>
                    <p class="option-info"><?php _e('Themes for pagination','timeline_grid'); ?></p>
                      
                    <label><input <?php if($pagination_theme=='lite') echo 'checked'; ?> type="radio" name="timeline_grid_meta_options[nav_bottom][pagination_theme]" value="lite" />Lite</label>
                    <label><input <?php if($pagination_theme=='dark') echo 'checked'; ?> type="radio" name="timeline_grid_meta_options[nav_bottom][pagination_theme]" value="dark" />Dark</label> 


                </div>

  
                
            
            </li>
            
            <li style="display: none;" class="box6 tab-box ">
            
                <div class="option-box">
                    <p class="option-title"><?php _e('Custom Js','timeline_grid'); ?></p>
                    <p class="option-info"><?php _e('Add your custom js','timeline_grid'); ?></p>
                    
                    <textarea id="custom_js" name="timeline_grid_meta_options[custom_js]" ><?php echo $custom_js; ?></textarea>

                </div>
                
                
                <div class="option-box">
                    <p class="option-title"><?php _e('Custom CSS','timeline_grid'); ?></p>
                    <p class="option-info"><?php _e('Add your custom CSS','timeline_grid'); ?></p>
                    
                    <textarea id="custom_css" name="timeline_grid_meta_options[custom_css]" ><?php echo $custom_css; ?></textarea>
                    

                </div>                
                
    <script>
	
		var editor = CodeMirror.fromTextArea(document.getElementById("custom_js"), {
		  lineNumbers: true,
		  scrollbarStyle: "simple"
		});
		
		var editor = CodeMirror.fromTextArea(document.getElementById("custom_css"), {
		  lineNumbers: true,
		  scrollbarStyle: "simple"
		});		
		


    </script>
                
                
                
                
            
            </li>
            
            
        </ul>

    
    </div>
    
    
   
    
<?php


	
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function meta_boxes_timeline_grid_save( $post_id ) {

  /*
   * We need to verify this came from the our screen and with proper authorization,
   * because save_post can be triggered at other times.
   */

  // Check if our nonce is set.
  if ( ! isset( $_POST['meta_boxes_timeline_grid_input_nonce'] ) )
    return $post_id;

  $nonce = $_POST['meta_boxes_timeline_grid_input_nonce'];

  // Verify that the nonce is valid.
  if ( ! wp_verify_nonce( $nonce, 'meta_boxes_timeline_grid_input' ) )
      return $post_id;

  // If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
		return $post_id;



	/* OK, its safe for us to save the data now. */
	
	// Sanitize user input.
	$timeline_grid_meta_options = stripslashes_deep( $_POST['timeline_grid_meta_options'] );
	update_post_meta( $post_id, 'timeline_grid_meta_options', $timeline_grid_meta_options );	
	
		
}
add_action( 'save_post', 'meta_boxes_timeline_grid_save' );






?>