/*
Using WordPress Media Uploader System with plugin settings
Author: minh.nguyen250385@gmail.com
Author URI: http://tokyodesignroom.com
*/
jQuery( document ).ready( function( e ){
		/*jQuery( '.tbl_choise_img_set' ).click(function() {
			
			window.send_to_editor = function(html) {
				alert('ok');
				imgurl		=	jQuery( 'img', html ).attr( 'src' );
				jQuery( '#site_logo' ).val( imgurl );
				tb_remove();
			}
		});*/
		
		
		
		
		jQuery('#wpbody .wrap').wrapInner('<div id="atn_postype-col-left" />');
		jQuery('#wpbody .wrap').wrapInner('<div id="atn_postype-cols" />');
		jQuery('#atn_postype-col-right').removeClass('hidden').prependTo('#atn_postype-cols-left');
		jQuery('#atn_postype-cpt-overview').removeClass('hidden').insertBefore('#atn_postype-col-left #ajax-response');
		jQuery('#atn_postype-col-left > .icon32').insertBefore('#atn_postype-cols');
		jQuery('#atn_postype-col-left > h2').insertBefore('#atn_postype-cols-left');
		
		
		
		jQuery('.create_option_class').live('click', function( event ){
			event.preventDefault();
			var choise_option=jQuery(this).parent().find('.select_option_choise').val();
			var line_html='<div class="group_item_theme clear">'+
                       '<div class="left_item_theme"><input type="text" value="" placeholder="Please enter Name Field"  name="header_option_texts_line[]" /></div>'+
                       '<div class="right_item_theme"><input type="text" class="regular-text" placeholder="Please enter Value Field" name="header_option_values_line[]" value="" /><input type="button" class="button button-secondary tbl_button_delete_clean" value="Delete" name="delete_tbl"></div>'
                       '</div>';
			var muti_line_html='<div class="group_item_theme clear">'+
                       '<div class="left_item_theme"><input type="text" value="" placeholder="Please enter Name Field"  name="header_option_texts_muti_line[]" /></div>'+
                       '<div class="right_item_theme"><textarea class="regular-area" name="header_option_values_muti_line[]" cols="5" rows="5"></textarea><input type="button" class="button button-secondary tbl_button_delete_clean" value="Delete" name="delete_tbl"></div>'
                       '</div>';
			var img_line_html='<div class="group_item_theme clear">'+
                        '<div class="left_item_theme"><input type="text" value="" placeholder="Please enter Name Field"  name="header_option_texts_img_line[]" /></div>'+
                        '<div class="right_item_theme">'+
	                        
	                       	 	'<input type="text" class="regular-text img_option_line"  name="header_option_values_img_line[]" value="" /><input type="button" class="button button-secondary tbl_choise_img_set" id="choise_img" value="Select Images" name="choise_img"><input type="button" class="button button-secondary tbl_button_delete_clean" value="Delete" name="delete_tbl">'+     
	                        	'<div class="mutioption_tdr_img"></div>'+
	                        
                        '</div>'+
                  '</div>';
			switch(choise_option){
				case "line":
					jQuery('.minhnn_group_theme_options .group_item_auto_theme').append(line_html);
				break;
				case "muti_line":
					jQuery('.minhnn_group_theme_options .group_item_auto_theme').append(muti_line_html);	
				break;
				case "img_line":
					jQuery('.minhnn_group_theme_options .group_item_auto_theme').append(img_line_html);
				break;
				default:
				alert('Select one option');
			}
		});
		
		jQuery('.tbl_button_delete_clean').live('click', function( event ){
			event.preventDefault();
			//jQuery(this).parent().parent().remove();
			var elem = jQuery(this).parent().parent();
			
			jQuery.confirm({
				'title'		: 'Delete Confirmation',
				'message'	: 'You are about to delete this option. <br />It cannot be restored at a later time! Continue?',
				'buttons'	: {
					'Yes'	: {
						'class'	: 'blue',
						'action': function(){
							elem.remove();
						}
					},
					'No'	: {
						'class'	: 'gray',
						'action': function(){}	// Nothing to do in this case. You can as well omit the action property.
					}
				}
			});
			
			
		});
		
		
		
		var url_img='';
		var url_set_html='';
		
		
		jQuery('.tbl_choise_img_set').live('click', function( event ){
		var file_frame;
		event.preventDefault();
		var this_click=jQuery(this);
		if (file_frame) {
				file_frame.open();
				return;
		}
		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
				title: 'Upload a slide',
				button: {
					text: 'Select Image',
				},
				library : { type : 'image'},
				multiple: false  // Set to true to allow multiple files to be selected
		});
		file_frame.on( 'select', function() { 
		attachment = file_frame.state().get('selection').first().toJSON();
		var url=attachment['url'];
		//var url_resize=attachment['sizes']['thumbnail']['url'];
		var html_show='<a href="' + url + '" class="colorbox" onclick="jQuery.colorbox({href:\'' + url + '\'}); return false;"><img class="slideshow_dropshadow" style="width:80px;" src="' + url + '" /></a>';
		this_click.parent().find('.img_option_line').val(url);
		this_click.parent().find('.mutioption_tdr_img').html(html_show);
		//alert('ok');
		});
		file_frame.open();

	});
		
		
		
		
		
		
		
		jQuery( '.faviconadd' ).click(function() {
			window.send_to_editor = function(html) {
				imgurl		=	jQuery( 'img', html ).attr( 'src' );
				jQuery( '#site_favicon' ).val( imgurl );
				tb_remove();
			}
		});
		
		jQuery( ".create_thumnail_click" ).delegate( ".add_news_gallery_img", "click", function(){
			var count_div_group=jQuery('.group_minhnn_gallery').length+1;
			var html_gallery='<div class="clear group_minhnn_gallery ui-state-item"><input type="text" value="" id="Slide_image_file" style="width:50%;" name="Slide_image_file[]"><input type="text" name="postion_img[]" value="'+count_div_group+'" id="postion_img" style="width:5%;" /><input type="text" name="name_img[]" value="" id="name_img" placeholder="Name.."/><input type="button" class="button button-secondary" id="Slide_mediaupload" value="Select Images" name="Slide_mediaupload[]"><input type="hidden" id="Slide_attachment_id" value="" name="Slide_attachment_id"><input type="hidden" id="Slide_attachment_name" value="" name="attachment_name[]"><div id="Slide_mediaupload_image"></div><div class="wpt-repct"><div class="js_mover_glr js-wpt-repdrag wpt-repdrag ui-sortable-handle">&nbsp;</div><a class="js-wpt-repdelete button button-small" data-wpt-type="image" data-wpt-id="wpcf-thumnail-gallery" style="display: inline-block;">Delete thumnail gallery</a></div></div>';
			var row_coll =	jQuery( this ).closest( '.container_gallery_file_post' );
			var newRow=jQuery('.container_gallery_file_post').append(html_gallery ); 
			
			newRow.find( '.js-wpt-repdelete' ).click( function() {
				jQuery( this ).closest( '.group_minhnn_gallery' ).remove();
			});
		});
		jQuery( ".wpt-repct" ).delegate( ".js-wpt-repdelete", "click", function(){
			jQuery( this ).closest( '.group_minhnn_gallery' ).remove();
		});
		
		jQuery('.ui_sortable').sortable({
              stop: function(event, ui){
			        var cnt = 1;
			        jQuery(this).children('.group_minhnn_gallery').each(function(){
			            jQuery(this).children('input#postion_img').val(cnt);
			            cnt++;
			        });
			    }
         });
		
		
		
		
		
		jQuery( ".theme_options" ).delegate( ".addnewrow", "click", function(){
			var html			=	'<tr><td><label class="fleld_name">Field Name</label></td><td><input type="text" class="regular-text" name="header_option_values[]" value="" /><a href="javascript:;" class="addnewrow"></a><a href="javascript:;" class="deleterow"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="description">Enter your own label name, please click on "Field Name" label.</span></td></tr>';
			var row				=	jQuery( this ).closest( 'tr' );
			var newRow			=	jQuery( html ).insertAfter( row ); 
			
			newRow.find( '.deleterow' ).click( function() {
				jQuery( this ).closest( 'tr' ).remove();
			});
		});
		jQuery( '.deleterow' ).click( function() {
			jQuery( this ).closest( 'tr' ).remove();
		});
		jQuery( ".theme_options" ).delegate( "label.fleld_name", "click", function(){
			$text				=	jQuery( this ).html();
			jQuery( this ).replaceWith( '<input type="text" name="header_option_texts[]" value="' + $text + '" />' );
			console.log(jQuery( this ).closest( 'td' ).find( 'input').attr( 'class' ));
		});
		
		
		var file_frame;
	
	jQuery('.media-uploader-button').click(function(e) {
		e.preventDefault();

		if ( file_frame ) {
			file_frame.open();
			return;
		}

		file_frame = wp.media.frames.file_frame = wp.media({
			title: 'Add Icon',
			button: {
				text: 'Select icon',
			},
			multiple: false
		});

		file_frame.on( 'select', function() {
			attachment = file_frame.state().get('selection').first().toJSON();
			console.log(attachment);
			if ( attachment ) {

				var url;

				if ( attachment.sizes.atn_postype_icon ) {
					url = attachment.sizes.atn_postype_icon.url;
				} else {
					url = attachment.url;
				}
				jQuery('#atn_postype_icon').val( url );
				jQuery('.current-atn_postype-icon').html('<img src="'+url+'" height="16" width="16" />');
				jQuery('.remove-atn_postype-icon').show();
				jQuery('.media-uploader-button').html('Edit icon');

			}
		});

		file_frame.open();
		return false;
	});

	jQuery('.remove-atn_postype-icon').click(function(e) {
		e.preventDefault();
		jQuery('#atn_postype_icon').val('');
		jQuery('.current-atn_postype-icon').html('');
		jQuery('.remove-atn_postype-icon').hide();
		jQuery('.media-uploader-button').html('Add icon');
	});
		
		
		
});

function jqCheckAll(checker, formid, name) {					
	jQuery('input:checkbox[name="' + name + '[]"]').each(function() {
		jQuery(this).attr("checked", checker.checked);
	});
}

	
