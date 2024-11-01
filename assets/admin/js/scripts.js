jQuery(document).ready(function($)
	{


		$(document).on('click', '.reset-content-layouts', function()
			{
				
				if(confirm("Do you really want to reset ?" )){
					
					jQuery.ajax(
						{
					type: 'POST',
					context: this,
					url: timeline_grid_ajax.timeline_grid_ajaxurl,
					data: {"action": "timeline_grid_reset_content_layouts",},
					success: function(data)
							{	
								$(this).html('Reset Done!');
															
								
							}
						});
					
					}
				
				

				
			})




		$(document).on('change', '.select-layout-content', function()
			{
				var layout = $(this).val();		
			
				
				jQuery.ajax(
					{
				type: 'POST',
				url: timeline_grid_ajax.timeline_grid_ajaxurl,
				data: {"action": "timeline_grid_layout_content_ajax","layout":layout},
				success: function(data)
						{	
							//jQuery(".layout-content").html(data);
							jQuery(".layer-content").html(data);
						}
					});
				
			})	

		

		
		$(".timeline_grid_taxonomy").click(function()
			{
				


				var taxonomy = jQuery(this).val();
				
				jQuery(".timeline_grid_loading_taxonomy_category").css('display','block');

						jQuery.ajax(
							{
						type: 'POST',
						url: timeline_grid_ajax.timeline_grid_ajaxurl,
						data: {"action": "timeline_grid_get_taxonomy_category","taxonomy":taxonomy},
						success: function(data)
								{	
									jQuery(".timeline_grid_taxonomy_category").html(data);
									jQuery(".timeline_grid_loading_taxonomy_category").fadeOut('slow');
								}
							});

		
			})
		



	});	







