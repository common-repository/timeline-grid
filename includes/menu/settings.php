<?php	


/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access



if(empty($_POST['timeline_grid_hidden']))
	{
		$timeline_grid_options = get_option( 'timeline_grid_options' );


	}
else
	{	
		if($_POST['timeline_grid_hidden'] == 'Y') {
			//Form data sent
			
			if(empty($_POST['timeline_grid_options']))
				{
					$_POST['timeline_grid_options'] = array();
				}
			
			$timeline_grid_options = stripslashes_deep($_POST['timeline_grid_options']);
			update_option('timeline_grid_options', $timeline_grid_options);
		

			?>
			<div class="updated"><p><strong><?php _e('Changes Saved.', 'timeline_grid' ); ?></strong></p></div>
	
			<?php
			} 
	}
	
	

	
	
?>





<div class="wrap">

	<div id="icon-tools" class="icon32"><br></div><?php echo "<h2>".__(timeline_grid_plugin_name.' Settings', 'timeline_grid')."</h2>";?>
		<form  method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
	<input type="hidden" name="timeline_grid_hidden" value="Y">
        <?php settings_fields( 'timeline_grid_plugin_options' );
				do_settings_sections( 'timeline_grid_plugin_options' );
			
		?>

    <div class="para-settings timeline_grid-settings">
    
        <ul class="tab-nav"> 
            <li nav="1" class="nav1 active">Options</li>        
            <li nav="2" class="nav1">Help & support</li>       
   
        </ul> <!-- tab-nav end --> 
		<ul class="box">

            <li style="display: block;" class="box1 tab-box active">
				<div class="option-box">
                    <p class="option-title"><?php _e('Reset Content Layouts','timeline_grid'); ?></p>
                    <p class="option-info">you can reset content layouts here, saved & customized layout will reset permanetly.</p>
                    
                    <div class="button reset-content-layouts">Reset Layouts</div>

                </div>

                
                
                
            </li>


            <li style="display: none;" class="box2 tab-box active">
				<div class="option-box">
                    <p class="option-title">Need Help ?</p>
                    <p class="option-info">Feel free to contact with any issue for this plugin, Ask any question via forum <a href="<?php echo timeline_grid_qa_url; ?>"><?php echo timeline_grid_qa_url; ?></a> <strong style="color:#139b50;">(free)</strong><br />

					<?php
                
                    if(timeline_grid_customer_type=="free")
                        {
                    
                            echo 'You are using <strong> '.timeline_grid_customer_type.' version  '.timeline_grid_version.'</strong> of <strong>'.timeline_grid_plugin_name.'</strong>, To get more feature you could try our premium version. ';
                            echo '<br /><a href="'.timeline_grid_pro_url.'">'.timeline_grid_pro_url.'</a>';
                            
                        }
                    else
                        {
                    
                            echo 'Thanks for using <strong> premium version  '.timeline_grid_version.'</strong> of <strong>'.timeline_grid_plugin_name.'</strong> ';	
                            
                            
                        }
                    
                     ?>       

                    
                    </p>

                </div>
                
				<div class="option-box">
                    <p class="option-title">Submit Reviews...</p>
                    <p class="option-info">We are working hard to build some awesome plugins for you and spend thousand hour for plugins. we wish your three(3) minute by submitting five star reviews at wordpress.org. if you have any issue please submit at forum.</p>
                	<img class="timeline_grid-pro-pricing" src="<?php echo timeline_grid_plugin_url."assets/admin/images/five-star.png";?>" /><br />
                    <a target="_blank" href="<?php echo timeline_grid_wp_reviews; ?>">
                		<?php echo timeline_grid_wp_reviews; ?>
               		</a>
                    
                    
                    
                </div>
				<div class="option-box">
                    <p class="option-title">Please Share</p>
                    <p class="option-info">If you like this plugin please share with your social share network.</p>
                    <?php
                    
						echo timeline_grid_share_plugin();
					?>
                </div>
                
				<div class="option-box">
                    <p class="option-title">Video Tutorial</p>
                    <p class="option-info">Please watch this video tutorial.</p>
                	<iframe width="640" height="480" src="<?php echo timeline_grid_tutorial_video_url; ?>" frameborder="0" allowfullscreen></iframe>
                </div>
                
                
                
                
            </li>            
        </ul>
    
    
		

        
    </div>




<!-- 

<p class="submit">
	<input class="button button-primary" type="submit" name="Submit" value="<?php _e('Save Changes','timeline_grid' ); ?>" />
</p>

-->


		</form>


</div>
