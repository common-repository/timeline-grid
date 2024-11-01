jQuery(document).ready(function($)
	{



		$(document).on('click', '.timeline-grid .add-post', function()
			{
				var new_post_title = $('.new-post-title').val();
				var post_content = $('#new_post_content').text();				
				
				alert(post_content);
				
				
				
					$.ajax(
						{
					type: 'POST',
					context: this,
					url:timeline_grid_ajax.timeline_grid_ajaxurl,
					data: {"action": "timeline_grid_ajax_add_post", "grid_id":grid_id,},
					success: function(data)
							{	
								
								
								$('.grid-items').html('');
								//$('.grid-items').masonry({});
								
								
								var $grid = $('.grid-items').masonry({});				
								
								  // append items to grid
									items = $grid.append( data )
									// add and lay out newly appended items
									.masonry( 'appended', data );
									$grid.masonry( 'reloadItems' );
									$grid.masonry( 'layout' );
								
								$(this).removeClass('loading');
								
							},
			 complete: function () {
				  setTimeout(add_point_and_arrow, 1000);
				}	
							
							
						});
				
				
				
				
				
				})




		$(document).on('keyup', '.nav-search .search', function()
			{
				var keyword = $(this).val();
				var grid_id = $(this).attr('grid_id');				
				
				if(keyword.length>3){
					$(this).addClass('loading');
					
					$('.pagination').fadeOut();
					
					$.ajax(
						{
					type: 'POST',
					context: this,
					url:timeline_grid_ajax.timeline_grid_ajaxurl,
					data: {"action": "timeline_grid_ajax_search", "grid_id":grid_id,"keyword":keyword,},
					success: function(data)
							{	
								
								
								$('.grid-items').html('');
								//$('.grid-items').masonry({});
								
								
								var $grid = $('.grid-items').masonry({});				
								
								  // append items to grid
									items = $grid.append( data )
									// add and lay out newly appended items
									.masonry( 'appended', data );
									$grid.masonry( 'reloadItems' );
									$grid.masonry( 'layout' );
								
								$(this).removeClass('loading');
								
							},
			 complete: function () {
				  setTimeout(add_point_and_arrow, 1000);
				}	
							
							
						});

	
					
					}
				
			})


		$(document).on('click', '.timeline-grid .load-more', function()
			{

				var paged = parseInt($(this).attr('paged'));
				var per_page = parseInt($(this).attr('per_page'));
				var grid_id = parseInt($(this).attr('grid_id'));

						
				$(this).addClass('loading');

			$.ajax(
				{
			type: 'POST',
			context: this,
			url:timeline_grid_ajax.timeline_grid_ajaxurl,
			data: {"action": "timeline_grid_ajax_load_more", "grid_id":grid_id,"per_page":per_page,"paged":paged,},
			success: function(data)
					{	

						//$('.grid-items').append(data);
						var $grid = $('.grid-items').masonry({});				
						
						  // append items to grid
							items = $grid.append( data )
							// add and lay out newly appended items
							.masonry( 'appended', data );
							$grid.masonry('reloadItems');
							$grid.masonry('layout');

							//add_point_and_arrow();

							$(this).attr('paged',(paged+1));
							
							if($(this).hasClass('loading'))
								{
									$(this).removeClass('loading');
								}

						
					},
			 complete: function () {
				  setTimeout(add_point_and_arrow, 1000);
				}



				});

				//add_point_and_arrow();
			})

		
		function add_point_and_arrow(){


						jQuery('.timeline-grid .grid-items .item').each(function(){
								
								jQuery(this).removeClass('right-point');
								jQuery(this).removeClass('left-point');								
								jQuery(this).children('span.right-arrow').remove();
								jQuery(this).children('span.left-arrow').remove();
								jQuery(this).children('span.right-point').remove();																
								jQuery(this).children('span.left-point').remove();								
								
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



			}

	});	






