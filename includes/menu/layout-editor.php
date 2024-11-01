<?php	


/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access



if(empty($_POST['timeline_grid_hidden']))
	{
		$timeline_grid_layout_content = get_option( 'timeline_grid_layout_content' );
		//$timeline_grid_layout_hover = get_option( 'timeline_grid_layout_hover' );

	}
else
	{	
		if($_POST['timeline_grid_hidden'] == 'Y') {
			//Form data sent
			
			//$timeline_grid_layout_content = stripslashes_deep($_POST['timeline_grid_layout_content']);			
			$timeline_grid_layout_content = get_option( 'timeline_grid_layout_content' );
			//$timeline_grid_layout_hover = get_option( 'timeline_grid_layout_hover',true );
			//var_dump($timeline_grid_layout_hover);
			
			if(!empty($_POST['timeline_grid_layout_content'])){
				$timeline_grid_layout_content = array_merge($timeline_grid_layout_content, stripslashes_deep($_POST['timeline_grid_layout_content']));
				update_option('timeline_grid_layout_content', $timeline_grid_layout_content);
				
				}

/*

			if(!empty($_POST['timeline_grid_layout_hover'])){
				$timeline_grid_layout_hover = array_merge($timeline_grid_layout_hover, stripslashes_deep($_POST['timeline_grid_layout_hover']));
				
				
				update_option('timeline_grid_layout_hover', $timeline_grid_layout_hover);
				
				}

*/
			
			//var_dump($_POST['timeline_grid_layout_hover']);
		

			?>
			<div class="updated"><p><strong><?php _e('Changes Saved.', 'timeline_grid' ); ?></strong></p></div>
	
			<?php
			} 
	}

?>

<div class="wrap">

	<div id="icon-tools" class="icon32"><br></div><?php echo "<h2>".__(timeline_grid_plugin_name.' - Layout Editor', 'timeline_grid')."</h2>";?>
		<form  method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
            <input type="hidden" name="timeline_grid_hidden" value="Y">
            <?php settings_fields( 'timeline_grid_plugin_options' );
                    do_settings_sections( 'timeline_grid_plugin_options' );
                
				
				if(!empty($_GET['layout_content'])){
					$layout_content = sanitize_text_field($_GET['layout_content']);
					$layout_id = 'timeline_grid_layout_content';					
					
					}
					
/*
				elseif(!empty($_GET['layout_hover'])){
					$layout_hover = sanitize_text_field($_GET['layout_hover']); 
					$layout_id = 'timeline_grid_layout_hover';
					}

*/					
					
				else{
					$layout_content = 'flat';
					$layout_hover = 'flat';
					}
				
				
				//var_dump($layout_content);
				
				$class_timeline_grid_functions = new class_timeline_grid_functions();
				
            ?>
		<div class="layout-editor para-settings">
        
        
        
			<?php
            
            ?>

            <div class="layout-items">
            
            <?php
            
            $layout_items = $class_timeline_grid_functions->layout_items();
            
            foreach($layout_items as $item_key=>$name){
                
                ?>
                <div class="item" layout="<?php echo $layout_content; ?>" item_key="<?php echo $item_key; ?>" ><i class="fa fa-plus"></i> <?php echo $name; ?></div>
                <?php
                
                }
            ?>
            
            </div>


            
            <div class="layout-list">
            
            <?php if(isset($_GET['layout_content'])) {?>
                <div class="idle  ">
                <div class="name">Content: <?php echo $layout_content; ?></div>     
       
                <div class="layer-content">
                <div id="layout-container" class="<?php echo $layout_content; ?>">
                <?php
                
                
					if(empty($timeline_grid_layout_content)){
						$layout = $class_timeline_grid_functions->layout_content($layout_content);
						}
					else{
						$layout = $timeline_grid_layout_content[$layout_content];
						
						}
					


                
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
                            
                        elseif($item_key=='thumb_link'){
                            
                            ?>
                            <a href="#"><img style="width:100%; height:auto;" src="<?php echo timeline_grid_plugin_url; ?>assets/admin/images/thumb.png" /></a>
                            <?php
                            }								
							
							
                        elseif($item_key=='title'){
                            
                            ?>
                            Lorem Ipsum is simply
                            <?php
                            }	
							
                        elseif($item_key=='title_link'){
                            
                            ?>
                            <a href="#">Lorem Ipsum is simply</a>
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
                
                <?php } ?>
                
                 <?php if(isset($_GET['layout_hover'])) {
					 
					 //$layout_hover = $_GET['layout_hover'];
				 
					 
					 ?>
                <div class="hover">
                <div class="name">
                
                <select class="select-layout-hover" name="timeline_grid_meta_options[layout][hover]" >
                <?php
                
				
					if(empty($timeline_grid_layout_hover)){
						$layout = $class_timeline_grid_functions->layout_hover($layout_hover);
						}
					else{
						$layout = $timeline_grid_layout_hover[$layout_hover];
						
						}
				
				
                $layout_hover_list = $class_timeline_grid_functions->layout_hover_list();
                foreach($layout_hover_list as $layout_key=>$layout_info){
                    ?>
                    <option  value="<?php echo $layout_key; ?>"><?php echo $layout_key; ?></option>
                    <?php
                    
                    }
                ?>
                </select>
                
                Hover</div>
                <div id="layout-container" class="layer-hover">

				<?php
				
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
                            
                        elseif($item_key=='thumb_link'){
                            
                            ?>
                            <a href="#"><img style="width:100%; height:auto;" src="<?php echo timeline_grid_plugin_url; ?>assets/admin/images/thumb.png" /></a>
                            <?php
                            }								
							
							
                        elseif($item_key=='title'){
                            
                            ?>
                            Lorem Ipsum is simply
                            <?php
                            }	
							
                        elseif($item_key=='title_link'){
                            
                            ?>
                            <a href="#">Lorem Ipsum is simply</a>
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
                
                <?php } ?>                   
            </div>
                    
        	<br />
            <div class="css-editor expandable">
            
                <?php
				
					if(empty($layout)){$layout = array(); 
					
					echo 'you haven\'t selecetd any layout.';
					
					}
					

					
					

					if(isset($_GET['layout_content'])){
						
					
						$i=0;
						foreach($layout as $key=>$items){
							
							?>
							<div class="items" id="<?php echo $key; ?>">
							<div class="header"><span class="remove">X</span><?php echo $items['name']; ?></div>
								<div class="options">
								<?php
								
								 foreach($items as $item_key=>$item_info){
									 
	
									 if($item_key=='css'){
										 
										?>
		<br />
										CSS: <br />
										<a target="_blank" href="http://www.pickplugins.com/demo/post-grid/sample-css-for-layout-editor/">Sample css</a><br />
										<textarea autocorrect="off" autocapitalize="off" spellcheck="false"  style="width:50%" class="custom_css" item_id="<?php echo $items['key']; ?>" name="timeline_grid_layout_content[<?php echo $layout_content; ?>][<?php echo $i; ?>][<?php echo $item_key; ?>]"><?php echo $item_info; ?></textarea><br />
			
										
			
										<?php
										 
										 
										 
										 
										 
										 }
									elseif($item_key=='css_hover'){
										 
										?>
									<br />
										CSS Hover: <br />
										
										<textarea autocorrect="off" autocapitalize="off" spellcheck="false"  style="width:50%" class="custom_css" item_id="<?php echo $items['key']; ?>" name="timeline_grid_layout_content[<?php echo $layout_content; ?>][<?php echo $i; ?>][<?php echo $item_key; ?>]"><?php echo $item_info; ?></textarea><br />
			
										
			
										<?php
										 
										 
										 
										 
										 
										 }
										  
									elseif($item_key=='char_limit'){
											?>
												
												Character limit: <br />
												<input type="text"  name="timeline_grid_layout_content[<?php echo $layout_content; ?>][<?php echo $i; ?>][<?php echo $item_key; ?>]" value="<?php echo $items['char_limit']; ?>" /><br />
		
											<?php
											
											} 
										 
										 
									else{
										?>
											<input type="hidden"  name="timeline_grid_layout_content[<?php echo $layout_content; ?>][<?php echo $i; ?>][<?php echo $item_key; ?>]" value="<?php echo $item_info; ?>" />
	
										<?php
	
										}
										
										if($item_key=='field_id'){
											?>
												
												Meta Key: <br />
												<input type="text"  name="<timeline_grid_layout_content[<?php echo $layout_content; ?>][<?php echo $i; ?>][<?php echo $item_key; ?>]" value="<?php echo $item_info; ?>" /><br />
		
											<?php
											
											}
										
										
										
									 
									
									 }
								?>
								</div>
							</div>
							
							<?php
							
							 $i++;
							}
						
						}
						
					if(isset($_GET['layout_hover'])){
						
					
						$i=0;
						foreach($layout as $key=>$items){
							
							?>
							<div class="items" id="<?php echo $key; ?>">
							<div class="header"><span class="remove">X</span><?php echo $items['name']; ?></div>
								<div class="options">
								<?php
								
								 foreach($items as $item_key=>$item_info){
									 
	
									 if($item_key=='css'){
										 
										?>
		<br />
										CSS: <br />
										<a target="_blank" href="http://www.pickplugins.com/demo/post-grid/sample-css-for-layout-editor/">Sample css</a><br />
										<textarea autocorrect="off" autocapitalize="off" spellcheck="false"  style="width:50%" class="custom_css" item_id="<?php echo $items['key']; ?>" name="timeline_grid_layout_hover[<?php echo $layout_hover; ?>][<?php echo $i; ?>][<?php echo $item_key; ?>]"><?php echo $item_info; ?></textarea><br />
			
										
			
										<?php
										 
										 
										 
										 
										 
										 }
									elseif($item_key=='css_hover'){
										 
										?>
									<br />
										CSS Hover: <br />
										
										<textarea autocorrect="off" autocapitalize="off" spellcheck="false"  style="width:50%" class="custom_css" item_id="<?php echo $items['key']; ?>" name="timeline_grid_layout_hover[<?php echo $layout_hover; ?>][<?php echo $i; ?>][<?php echo $item_key; ?>]"><?php echo $item_info; ?></textarea><br />
			
										
			
										<?php
										 
										 
										 
										 
										 
										 }
										  
									elseif($item_key=='char_limit'){
											?>
												
												Character limit: <br />
												<input type="text"  name="timeline_grid_layout_hover[<?php echo $layout_hover; ?>][<?php echo $i; ?>][<?php echo $item_key; ?>]" value="<?php echo $items['char_limit']; ?>" /><br />
		
											<?php
											
											} 
										 
										 
									else{
										?>
											<input type="hidden"  name="timeline_grid_layout_hover[<?php echo $layout_hover; ?>][<?php echo $i; ?>][<?php echo $item_key; ?>]" value="<?php echo $item_info; ?>" />
	
										<?php
	
										}
										
										if($item_key=='field_id'){
											?>
												
												Meta Key: <br />
												<input type="text"  name="<timeline_grid_layout_hover[<?php echo $layout_hover; ?>][<?php echo $i; ?>][<?php echo $item_key; ?>]" value="<?php echo $item_info; ?>" /><br />
		
											<?php
											
											}
										
										
										
									 
									
									 }
								?>
								</div>
							</div>
							
							<?php
							
							 $i++;
							}
						
						}		
						
										
				?>
            
            </div>
        
       
        
        </div>
    


 <script>
 jQuery(document).ready(function($)
	{
		$(function() {
		$( ".css-editor" ).sortable();
		//$( ".items-container" ).disableSelection();
		});

})

</script>








        <p class="submit">
            <input class="button button-primary" type="submit" name="Submit" value="<?php _e('Save Changes','timeline_grid' ); ?>" />
        </p>


		</form>


</div>
