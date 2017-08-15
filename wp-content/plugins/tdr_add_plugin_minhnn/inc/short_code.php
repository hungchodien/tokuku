<?php
/*
	Author: minh.nguyen250385@gmail.com
	Create: 15-03-2016
	Website: http://tokyodesignroom.com
*/
if ( ! session_id() ) {
    session_start();
}

function record_sort($records, $field, $reverse=false)
{
    $hash = array();
    
    foreach($records as $record)
    {
        $hash[$record[$field]] = $record;
    }
    
    ($reverse)? krsort($hash) : ksort($hash);
    
    $records = array();
    
    foreach($hash as $record)
    {
        $records []= $record;
    }
    
    return $records;
}

//echo $options['select_checkbox_gallery'];
function minhnn_register_meta_boxes($post_type) {
	$array_option_minhnn=get_option('tdr_theme_options');
	$array_metabox_gallery=unserialize($array_option_minhnn['select_checkbox_gallery']);
	//$array_metabox_gallery="";
	//print_r( $array_metabox_gallery);
    
	if ( in_array( $post_type, $array_metabox_gallery ) ) {
		add_meta_box( 'meta-box-id1', __( 'TDR Images Gallery', 'TDR Images Gallery' ), 'minhnn_display_callback', $post_type,'advanced','high');
	}
}
add_action( 'add_meta_boxes', 'minhnn_register_meta_boxes' );
 
/**
 * Meta box display callback.
 *
 * @param WP_Post $post Current post object.
 */
function minhnn_display_callback( $post ) {
    // Display code/markup goes here. Don't forget to include nonces!
	wp_nonce_field( 'atn_minhnn_custom_box', 'atn_minhnn_custom_box_nonce' );
	$metabox_get=get_post_meta( $post->ID, 'minhnn_gallery_images', true );
	//print_r($metabox_get);
	$value_metaboxs = json_decode($metabox_get);
	$array_option_minhnn=get_option('tdr_theme_options');
	//$data_img=get_post_meta( '1', 'non-existing_meta', true )
	
	?>
    <div style="display: block;" id="typediv_media">
			<table class="form-table">
				<tbody>

        			<tr>
						<td class="title_select_img"><label for=""><?php _e('Select Image')?></label></td>
					</tr>
                    <tr>
        				<td class="content_select_img">
            <div class="clear container_gallery_file_post ui_sortable">	
            
            <?php 
			if($metabox_get=="" || empty($metabox_get)):?>
            <div class="clear group_minhnn_gallery ui-state-item">
                		<input type="text" value="" id="Slide_image_file" style="width:50%;" name="Slide_image_file[]">
                        <input type="text" name="postion_img[]" style="width:5%;" value="1" id="postion_img" placeholder="postion.."/>
                         <input type="text" name="name_img[]" value="" id="name_img" placeholder="Name.."/>
                        <input type="button" class="button button-secondary" id="Slide_mediaupload" value="Select Images" name="Slide_mediaupload[]">
						<input type="hidden" id="Slide_attachment_id" value="" name="attachment_id">
						<input type="hidden" id="Slide_attachment_name" value="" name="attachment_name[]">
                		<div id="Slide_mediaupload_image">
								<!-- image goes here -->
						</div>
                        <div class="wpt-repct">
	                		<div class="js_mover_glr js-wpt-repdrag wpt-repdrag ui-sortable-handle">&nbsp;</div>
	           				<a class="js-wpt-repdelete button button-small" data-wpt-type="image" data-wpt-id="wpcf-thumnail-gallery" style="display: inline-block;">Delete thumnail gallery</a>
	           			 </div>
                </div><!--group_minhnn_gallery-->
			<?php
			else:
				foreach($value_metaboxs as $value_metabox):
				
			?>
            
                <div class="clear group_minhnn_gallery ui-state-item">
                		<input type="text" value="<?php echo $value_metabox->thumnail; ?>" id="Slide_image_file" style="width:50%;" name="Slide_image_file[]">
                        <input type="text" name="postion_img[]" style="width:5%;" value="<?php echo $value_metabox->postion; ?>" id="postion_img" placeholder="postion.."/>
                        <input type="text" name="name_img[]" value="<?php echo $value_metabox->name; ?>" id="name_img" placeholder="Name.."/>
                        <input type="button" class="button button-secondary" id="Slide_mediaupload" value="Select Images" name="Slide_mediaupload[]">
						<input type="hidden" id="Slide_attachment_id" value="" name="attachment_id">
						<input type="hidden" id="Slide_attachment_name" value="" name="attachment_name[]">
                		<div id="Slide_mediaupload_image">
								<?php 
									if($value_metabox->thumnail!=""):
								?>
                                	<img class="slideshow_dropshadow" style="width:80px;" src="<?php echo $value_metabox->thumnail; ?>">
                                <?php endif; ?>
						</div>
                        <div class="wpt-repct">
	                		<div class="js_mover_glr js-wpt-repdrag wpt-repdrag ui-sortable-handle">&nbsp;</div>
	           				<a class="js-wpt-repdelete button button-small" data-wpt-type="image" data-wpt-id="wpcf-thumnail-gallery" style="display: inline-block;">Delete thumnail gallery</a>
	           			 </div>
                </div><!--group_minhnn_gallery-->
             <?php 
			 	endforeach;
				endif;
			 ?>   
                
                
            </div>      
                <div class="clear create_thumnail_click">        
                	<a href="javascript:void(0);" class="add_news_gallery_img" data-wpt-type="image" data-wpt-id="wpcf-thumnail-gallery">Add new Thumnail Gallery</a>        
                </div>
				<script type="text/javascript">
						jQuery(document).ready(function() {
							var url_img='';
							var url_set_html='';
							jQuery('#Slide_mediaupload').live('click', function( event ){
							var file_frame;
							event.preventDefault();
							var this_click=jQuery(this);
							if (file_frame) {
								file_frame.open();
									return;
							}
							file_frame = wp.media.frames.file_frame = wp.media({
										title: 'Upload a slide',
										button: {
											text: 'Select Slide Image',
										},
										library : { type : 'image'},
										multiple: false  // Set to true to allow multiple files to be selected
								});
								file_frame.on( 'select', function() {
									attachment = file_frame.state().get('selection').first().toJSON();
									var html_show='<a href="' + attachment.url + '" class="colorbox" onclick="jQuery.colorbox({href:\'' + attachment.url + '\'}); return false;"><img class="slideshow_dropshadow" style="width:80px;" src="' + attachment.sizes.thumbnail.url + '" /></a>';
										
										//url_set_html='<a href="' + attachment.url + '" class="colorbox" onclick="jQuery.colorbox({href:\'' + attachment.url + '\'}); return false;"><img class="slideshow_dropshadow" style="width:80px;" src="' + attachment.sizes.thumbnail.url + '" /></a>';
					//this_click.closest( '.group_minhnn_gallery' ).find('#Slide_attachment_id').val(attachment.id);
					//this_click.closest( '.group_minhnn_gallery' ).find( '#Slide_image_file').val(url_img);
					this_click.closest( '.group_minhnn_gallery' ).find('#Slide_image_file').val(attachment.url);
					//this_click.closest( '.group_minhnn_gallery' ).find('#Slide_attachment_name').val(attachment.title);
					this_click.closest( '.group_minhnn_gallery' ).find('#Slide_mediaupload_image').html(html_show);

									});

							file_frame.open();

								});

                        	});

                        	</script>

        				</td>

        			</tr>

        		</tbody>

        	</table>

        </div>
    <?php
}
 
/**
 * Save meta box content.
 *
 * @param int $post_id Post ID
 */
function minhnn_save_meta_box( $post_id ) {
    // Check if our nonce is set.
	if ( ! isset( $_POST['atn_minhnn_custom_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['atn_minhnn_custom_box_nonce'], 'atn_minhnn_custom_box' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
			return $post_id;

	$file_array=$_POST['Slide_image_file'];
	$file_postion=$_POST['postion_img'];
	$file_name=$_POST['name_img'];
	//$file_array_fitter=array_filter($file_array);
	$data_slide_img_count=count($file_array);
	$array_data=array();
	for($i=0;$i<$data_slide_img_count;$i++){
		$img_txt=$file_array[$i];
		$postion_txt=(int)$file_postion[$i];
		$name_txt=$file_name[$i];
		$array_list=array(
			"thumnail"=>$img_txt,
			"postion"=>$postion_txt,
			"name"=>$name_txt
		);
		if($img_txt!=""):
		array_push($array_data,$array_list);
		endif;
	}
	$array_datas=record_sort($array_data,'postion');
	$string_data=json_encode($array_datas);
	//$string_data=sanitize_text_field("aaaaaa");
	update_post_meta( $post_id, 'minhnn_gallery_images', $string_data);
}
add_action( 'save_post', 'minhnn_save_meta_box' );

