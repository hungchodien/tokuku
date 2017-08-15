<?php 
	global $wpdb;
	$table_gallery = $wpdb->prefix . "tdr_gallery";
	$table_img = $wpdb->prefix . "tdr_image";
	$table_join_gallery_img = $wpdb->prefix . "tdr_gallery_img";
	
	
	$time_current=date("Y-m-d H:i:s");
	if(isset($_POST['submit'])):
		if(!empty($_POST['galleries'])):
		$title_post=$_POST['title'];
		if(empty($title_post)):
			$title_post=$_POST['attachment_name'];
		endif;
		$description_post=$_POST['description'];
		$galleries=$_POST['galleries'];
		
			
		
		$media_file=$_POST['media_file'];
		$media_file_mobile=$_POST['media_file_mobile'];
		if(empty($_POST['media_file']) && empty($_POST['image_url'])):
			wp_redirect(IF_PLUGIN_TDR_MINHNN_ADMIN_DIR."?page=".$_GET['page']."&message=Images Not Insert. Please Choose Image"); 
		endif;
		if(empty($media_file)):
			$media_file=$_POST['image_url'];
		endif;
		
		if(empty($media_file_mobile)):
			$media_file_mobile=$_POST['image_url_mobile'];
		endif;
		//$image_url=$_POST['image_url'];
		$uselink=$_POST['uselink'];
		$onclick=mb_convert_encoding($_POST['onclick'],"HTML-ENTITIES","UTF-8");
		$link=$_POST['link'];
		$linktarget=$_POST['linktarget'];
		
		$order=(int)$_POST['order'];
		
		$alt=$_POST['alt'];
		$slider_bg=$_POST['slider_bg'];
		$id_img=(int)$_POST['id_img'];
		
		if($id_img>0):
			$data_img=array(
					'title' =>$title_post,
					'description' =>$description_post,
					'image_url' =>$media_file,
					'image_url_mobile' =>$media_file_mobile,
					'uselink' =>$uselink,
					'onclick' => $onclick,
					'linktarget' =>$linktarget,
					'link' =>$link,
					'alt' =>$alt,
					'slider_bg'=>$slider_bg,
					'order' =>$order,
					'modified'=>$time_current,
					'status'=>0
				);	
			$wpdb->update($table_img,$data_img,array('slider_id'=>$id_img));
			$m=0;
			$wpdb->delete($table_join_gallery_img,array('slider_id'=>$id_img));
			for($m=0;$m<count($galleries);$m++):
				$id_gallery=$galleries[$m];
				$array_gallery_img=array(
					'slider_id' =>$id_img,
					'gallery_id' =>$id_gallery,
					'created'=>$time_current,
					'modified'=>$time_current,
					'status'=>0
				);
				$wpdb->insert($table_join_gallery_img,$array_gallery_img);
			endfor;
			wp_redirect(IF_PLUGIN_TDR_MINHNN_ADMIN_DIR."?page=".$_GET['page']."&message=Images+has been+saved"); 		
		else:
			$data_img=array(
					'title' =>$title_post,
					'description' =>$description_post,
					'image_url' =>$media_file,
					'image_url_mobile' =>$media_file_mobile,
					'uselink' =>$uselink,
					'onclick' => $onclick,
					'linktarget' =>$linktarget,
					'link' =>$link,
					'alt' =>$alt,
					'slider_bg'=>$slider_bg,
					'order' =>$order,
					'created'=>$time_current,
					'modified'=>$time_current,
					'status'=>0
				);	
				//print_r($data_img);
				$wpdb->insert($table_img,$data_img);
				$id_img=$wpdb->insert_id;
				//echo $wpdb->last_query;
				$m=0;
			$wpdb->delete($table_join_gallery_img,array('slider_id'=>$id_img));
			for($m=0;$m<count($galleries);$m++):
				$id_gallery=$galleries[$m];
				$array_gallery_img=array(
					'slider_id' =>$id_img,
					'gallery_id' =>$id_gallery,
					'created'=>$time_current,
					'modified'=>$time_current,
					'status'=>0
				);
				$wpdb->insert($table_join_gallery_img,$array_gallery_img);
			endfor;
			wp_redirect(IF_PLUGIN_TDR_MINHNN_ADMIN_DIR."?page=".$_GET['page']."&message=Images+has+been+ saved"); 
		endif;
	else:
		echo "<div class='error_note clear'><p>Please check at least one gallery</p></div>";
	endif;	
endif;
	
	if(isset($_GET['id'])):
		$id=(int)$_GET['id'];
	else:
		$id=0;
	endif;
	
	if($id>0):
$get_images = $wpdb->get_results("SELECT * FROM " .$table_img. " WHERE `slider_id`=".$id. " LIMIT 1");

$get_images_slider = $wpdb->get_results("SELECT `gallery_id` FROM " .$table_join_gallery_img. " WHERE `slider_id`=".$id);
	
	endif;
	
	
?>

<div class="wrap Gallery slideshow-gallery slideshow">
	
	<?php if($id>0): ?>
  		<h2><?php _e('Edit a Images') ?></h2>
    <?php else: ?>
    	<h2><?php _e('Save a Image') ?></h2>
    <?php endif; ?>
	<form enctype="multipart/form-data" method="post" action="" id="add_img_frm">
		<input type="hidden" value="<?php  if(isset($get_images[0]->slider_id)): echo $get_images[0]->slider_id; endif; ?>" name="id_img">
		<input type="hidden" value="" name="order">
	
		<table class="form-table">
			<tbody>
				<tr>
					<th><label for="Slide.title">Title</label>
								
			<span class="galleryhelp">
				<a title="This title is for your reference in management and it will also be used to display the title of the slide in the information bar if you have that turned on." onclick="return false;" href=""></a>
			</span>
			
			</th>
					<td>
	<input type="text" id="Slide.title" value="<?php if(isset($get_images[0]->title)): echo $get_images[0]->title; endif;?>" name="title" class="widefat">
						                        <span class="howto">Title/name of your slide as it will be displayed to your users.</span>
											</td>
				</tr>
				<tr>
					<th><label for="Slide.description">Description</label>
								
			<span class="galleryhelp">
				<a title="The description is specifically used for the information bar if you have that turned on." onclick="return false;" href=""></a>
			</span>
			
			</th>
					<td>
		<textarea name="description" cols="100%" rows="5" class="widefat"><?php if(isset($get_images[0]->description)): echo $get_images[0]->description; endif; ?></textarea>
		<span class="howto">Description of your slide as it will be displayed to your users below the title.</span>
											</td>
				</tr>
				
              <tr>
					<th><label for="Slide.alt">Alt Image</label>
								
			<span class="galleryhelp">
				<a title="The alt is specifically used for the information images." onclick="return false;" href=""></a>
			</span>
			
			</th>
					<td>
		<input type="text" name="alt"  class="widefat" value="<?php if(isset($get_images[0]->alt)): echo $get_images[0]->alt;  endif;?>">
		<span class="howto">Alt of your slide as it will be displayed to your users below the title.</span>
											</td>
				</tr>  
                
                <tr>
					<th><label for="Slide.slider_bg">Background Slishow</label>
								
			<span class="galleryhelp">
				<a title="The Background is specifically used for the Background Slishow." onclick="return false;" href=""></a>
			</span>
			
			</th>
					<td>
		<input type="text" name="slider_bg"  class="widefat" value="<?php if(isset($get_images[0]->slider_bg)): echo $get_images[0]->slider_bg; endif; ?>">
		<span class="howto">Background Slishow. Ex:#b4dae3</span>
											</td>
				</tr>   
                
                 <tr>
					<th><label for="Slide.order">Sort Image</label>
								
			<span class="galleryhelp">
				<a title="Sort order Images" onclick="return false;" href=""></a>
			</span>
			
			</th>
					<td>
		<input type="text" name="order" class="widefat" value="<?php if(isset($get_images[0]->order)):  echo $get_images[0]->order; endif; ?>">
		<span class="howto">Sort of your slide.</span>
											</td>
				</tr>  
			</tbody>
		</table>
		
		
		
		<table class="form-table">
			<tbody>
				<tr>
					<th><label for="checkboxall">Galleries</label>
								
			<span class="galleryhelp">
				<a title="You can organize/assign a slide to multiple galleries as needed. It is easy to display a slideshow with the slides of a specific gallery then." onclick="return false;" href=""></a>
			</span>
			
			</th>
					<td>
                    <div class="clear choise_gallery">
													<label style="font-weight:bold"><input type="checkbox" id="checkboxall" value="checkboxall" name="checkboxall" onclick="jqCheckAll(this,'','galleries');"> Select All</label><br>
         <?php 
		 $get_galleries = $wpdb->get_results("SELECT * FROM " .$table_gallery. " ORDER BY `gallery_id` DESC");
		 if(!empty($get_galleries)):
		 foreach($get_galleries as $get_gallerys){ 
		 	
			//checked="checked"
		 ?>                                        
		<label><input type="checkbox"  
        <?php 
			if(!empty($get_images_slider)):
			 foreach($get_images_slider as $get_images_sliders){ 
			 $gallery_id_check=$get_images_sliders->gallery_id;
			 if($get_gallerys -> gallery_id==$gallery_id_check):?>
             checked="checked"
             <?php
			 endif;
		?>
        
        <?php }  endif;?>
         id="Slide_galleries_<?php echo $get_gallerys -> gallery_id; ?>"  value="<?php echo $get_gallerys -> gallery_id; ?>" name="galleries[]"><?php echo $get_gallerys -> title_gallery; ?></label><br>
		
        <?php } endif; ?>
        </div>
		<span class="howto">Assign this slide to one or more galleries.</span>
					</td>
				</tr>
                <tr>
                	<th><label for="Slide.type.media">Image Type</label>
                				
			<span class="galleryhelp">
				<a title="Do you want to specify a URL to your image or upload the image file manually? Specifying a URL will still copy the image file remotely from the location to your server so uploading is recommended to prevent any restrictions or errors." onclick="return false;" href=""></a>
			</span>
			
			</th>
                    <td>
                    	<label><input type="radio" id="Slide.type.media" value="media" name="Slide[type]" checked="checked" onclick="jQuery('#typediv_media').show(); jQuery('#typediv_file').hide(); jQuery('#typediv_url').hide(); jQuery('#typediv_media_mobile').show(); jQuery('#typediv_file_mobile').hide(); jQuery('#typediv_url_mobile').hide();"> Media Upload</label>
                    	
                        <label><input type="radio" id="Slide.type.url" value="url" name="Slide[type]" onclick="jQuery('#typediv_url').show(); jQuery('#typediv_media').hide(); jQuery('#typediv_file').hide(); jQuery('#typediv_url_mobile').show(); jQuery('#typediv_media_mobile').hide(); jQuery('#typediv_file_mobile').hide();"> Specify URL</label>
        <span class="howto">Do you want to upload an image or specify a local/remote image URL?</span>
                    </td>
                </tr>
            </tbody>
        </table>
        
        <!-- Choose/upload file with the WordPress media uploader -->
        <div style="display: block;" id="typediv_media">
        	<table class="form-table">
        		<tbody>
        			<tr>
        				<th><label for="">Choose Image</label></th>
        				<td>
        					<div id="Slide_mediaupload_image">
                            	<?php if(isset($get_images[0]->image_url)): $url_img_edit=$get_images[0]->image_url; ?>
	                        		<a href="<?php echo $url_img_edit; ?>" class="colorbox" onclick="jQuery.colorbox({href:'<?php echo $url_img_edit; ?>'}); return false;">
	                                <img class="slideshow_dropshadow" style="width:100px;" src="<?php echo $url_img_edit; ?>">
	                                </a>
                                <?php endif; ?>
                        	</div>
                        
                        	<input type="button" class="button button-secondary" id="Slide_mediaupload" value="Choose File" name="Slide_mediaupload">
                       <input type="text" value="<?php if(isset($get_images[0]->image_url)): echo $get_images[0]->image_url; endif; ?>" id="Slide_image_file" style="width:50%;" name="media_file">
                        	<input type="hidden" id="Slide_attachment_id" value="" name="attachment_id">
                        	<input type="hidden" id="Slide_attachment_name" value="<?php if(isset($get_images[0]->title)): echo $get_images[0]->title; endif; ?>" name="attachment_name">
                        	                        	
                        	<script type="text/javascript">
                        	jQuery(document).ready(function() {
								var file_frame;
								
								jQuery('#Slide_mediaupload').live('click', function( event ){
									event.preventDefault();
									
									// If the media frame already exists, reopen it.
									if (file_frame) {
										file_frame.open();
										return;
									}
									
									// Create the media frame.
									file_frame = wp.media.frames.file_frame = wp.media({
										title: 'Upload a slide',
										button: {
											text: 'Select as Slide Image',
										},
										multiple: false  // Set to true to allow multiple files to be selected
									});
										
									// When an image is selected, run a callback.
									file_frame.on( 'select', function() {
										// We set multiple to false so only get one image from the uploader
										attachment = file_frame.state().get('selection').first().toJSON();
										
										// Do something with attachment.id and/or attachment.url here
										
										jQuery('#Slide_attachment_id').val(attachment.id);
										jQuery('#Slide_image_file').val(attachment.url);
										jQuery('#Slide_attachment_name').val(attachment.title);
										jQuery('#Slide_mediaupload_image').html('<a href="' + attachment.url + '" class="colorbox" onclick="jQuery.colorbox({href:\'' + attachment.url + '\'}); return false;"><img class="slideshow_dropshadow" style="width:100px;" src="' + attachment.sizes.thumbnail.url + '" /></a>');
									});
									
									// Finally, open the modal
									file_frame.open();
								});
                        	});
                        	</script>
        				</td>
        			</tr>
        		</tbody>
        	</table>
        </div>
        
        
         <div style="display: block;" id="typediv_media_mobile">
        	<table class="form-table">
        		<tbody>
        			<tr>
        				<th><label for="">Choose Image Mobile</label></th>
        				<td>
        					<div id="Slide_mediaupload_mobile_image">
                        		<?php if(isset($get_images[0]->image_url_mobile)): $url_img_mobile_edit=$get_images[0]->image_url_mobile; ?>
	                        		<a href="<?php echo $url_img_mobile_edit; ?>" class="colorbox" onclick="jQuery.colorbox({href:'<?php echo $url_img_mobile_edit; ?>'}); return false;">
	                                <img class="slideshow_dropshadow" style="width:100px;" src="<?php echo $url_img_mobile_edit; ?>">
	                                </a>
                                <?php endif; ?>
                        	</div>
                        
                        	<input type="button" class="button button-secondary" id="Slide_mobile_mediaupload" value="Choose File" name="Slide_mobile_mediaupload">
                       <input type="text" value="<?php if(isset($get_images[0]->image_url_mobile)): echo $get_images[0]->image_url_mobile; endif; ?>" id="Slide_mobile_image_file" style="width:50%;" name="media_file_mobile">
                        	<input type="hidden" id="Slide_mobile_attachment_id" value="" name="attachment_mobile_id">
                        	<input type="hidden" id="Slide_mobile_attachment_name" value="<?php if(isset($get_images[0]->title)): echo $get_images[0]->title; endif; ?>" name="attachment_mobile_name">
                        	                        	
                        	<script type="text/javascript">
                        	jQuery(document).ready(function() {
								var file_frame_mobile;
								
								jQuery('#Slide_mobile_mediaupload').live('click', function( event ){
									event.preventDefault();
									
									// If the media frame already exists, reopen it.
									if (file_frame_mobile) {
										file_frame_mobile.open();
										return;
									}
									
									// Create the media frame.
									file_frame_mobile = wp.media.frames.file_frame_mobile = wp.media({
										title: 'Upload a slide',
										button: {
											text: 'Select as Slide Image',
										},
										multiple: false  // Set to true to allow multiple files to be selected
									});
										
									// When an image is selected, run a callback.
									file_frame_mobile.on( 'select', function() {
										// We set multiple to false so only get one image from the uploader
										attachment = file_frame_mobile.state().get('selection').first().toJSON();
										
										// Do something with attachment.id and/or attachment.url here
										
										jQuery('#Slide_mobile_attachment_id').val(attachment.id);
										jQuery('#Slide_mobile_image_file').val(attachment.url);
										jQuery('#Slide_mobile_attachment_name').val(attachment.title);
										jQuery('#Slide_mediaupload_mobile_image').html('<a href="' + attachment.url + '" class="colorbox" onclick="jQuery.colorbox({href:\'' + attachment.url + '\'}); return false;"><img class="slideshow_dropshadow" style="width:100px;" src="' + attachment.sizes.thumbnail.url + '" /></a>');
									});
									
									// Finally, open the modal
									file_frame_mobile.open();
								});
                        	});
                        	</script>
        				</td>
        			</tr>
        		</tbody>
        	</table>
        </div>
        
        
        
        
        <div style="display: none;" id="typediv_file">
        	<table class="form-table">
            	<tbody>
                	<tr>
                    	<th><label for="Slide.image_file">Choose Image</label>
                    				
			<span class="galleryhelp">
				<a title="Simply choose an image file from your computer to upload for this slide. Only .jpg, .png and .gif are supported and in rare cases .bmp but please try and prevent using .bmp files." onclick="return false;" href=""></a>
			</span>
			
		
                </tbody>
            </table>
        </div>
        
         <div style="display: none;" id="typediv_file_mobile">
        	<table class="form-table">
            	<tbody>
                	<tr>
                    	<th><label for="Slide.image_file_mobile">Choose Image Mobile</label>
                    				
			<span class="galleryhelp">
				<a title="Simply choose an image file from your computer to upload for this slide. Only .jpg, .png and .gif are supported and in rare cases .bmp but please try and prevent using .bmp files." onclick="return false;" href=""></a>
			</span>
			
		
                </tbody>
            </table>
        </div>
        
        <div style="display:none;" id="typediv_url">
            <table class="form-table">
                <tbody>
                    <tr>
                        <th><label for="Slide.image_url">Image URL</label>
                        			
			<span class="galleryhelp">
				<a title="Specify an absolute URL to an image file to use for this slide. The image will be copied from the location to your server." onclick="return false;" href=""></a>
			</span>
			
			</th>
                        <td>
                            <input type="text" id="Slide.image_url" value="<?php if(isset($get_images[0]->image_url)): echo $get_images[0]->image_url; endif; ?>" name="image_url" class="widefat">
                            <span class="howto">Local or remote image location eg. http://domain.com/path/to/image.jpg</span>
                                                    </td>
                    </tr>
                </tbody>
            </table>
        </div>    
               
        <div style="display:none;" id="typediv_url_mobile">
            <table class="form-table">
                <tbody>
                    <tr>
                        <th><label for="Slide.image_url_mobile">Image URL Mobile</label>
                        			
			<span class="galleryhelp">
				<a title="Specify an absolute URL to an image file to use for this slide. The image will be copied from the location to your server." onclick="return false;" href=""></a>
			</span>
			
			</th>
                        <td>
                            <input type="text" id="Slide.image_url_mobile" value="<?php if(isset($get_images[0]->image_url_mobile)):  echo $get_images[0]->image_url_mobile; endif; ?>" name="image_url_mobile" class="widefat">
                            <span class="howto">Local or remote image location eg. http://domain.com/path/to/image.jpg</span>
                                                    </td>
                    </tr>
                </tbody>
            </table>
        </div>           
               
               
               
                
        <table class="form-table">
        	<tbody>
				<tr>
					<th><label for="Slide_uselink_N">Use Link</label>
								
			<span class="galleryhelp">
				<a title="Turn this on to specify a link/URL for this slide to link to when it is clicked." onclick="return false;" href=""></a>
			</span>
			
			</th>
					<td>
                    <?php if(isset($get_images[0]->uselink)): $userlink_check=$get_images[0]->uselink; else: $userlink_check="N"; endif;?>
						<label><input type="radio" id="Slide_uselink_Y" value="Y" name="uselink" onclick="jQuery('#Slide_uselink_div').show();" <?php if($userlink_check=='Y'): ?>  checked="checked" <?php endif; ?>> Yes</label>
						<label><input type="radio" id="Slide_uselink_N" value="N" name="uselink" onclick="jQuery('#Slide_uselink_div').hide();" <?php if($userlink_check!='Y'): ?>  checked="checked" <?php endif; ?>> No</label>
                        <span class="howto">Set this to Yes to link this slide to a link/URL of your choice.</span>
					</td>
				</tr>
			</tbody>
		</table>
		
		<div style=" <?php if($userlink_check=='Y'): ?>  display: block; <?php else: ?>display: none; <?php endif; ?>" id="Slide_uselink_div">
			<table class="form-table">
				<tbody>
					<tr>
						<th><label for="Slide.link">Link To</label>
									
			<span class="galleryhelp">
				<a title="The absolute URL to take the user to when the slide is clicked." onclick="return false;" href=""></a>
			</span>
			
					</th>
						<td>
                        	<input type="text" id="Slide.link" value="<?php if(isset($get_images[0]->link)): echo $get_images[0]->link; endif; ?>" name="link" class="widefat">
                            <span class="howto">Link/URL to go to when a user clicks the slide eg. http://www.domain.com/mypage/</span>
                        </td>
					</tr>
                    
                    <tr>
						<th><label for="Slide.click">Onclick</label>
									
			<span class="galleryhelp">
				<a  title="The absolute URL to take the user to when the slide is clicked." onclick="return false;" href=""></a>
			</span>
			
					</th>
						<td>
                        	<input type="text" id="Slide.onclick" value="<?php if(isset($get_images[0]->onclick)): echo mb_convert_encoding($get_images[0]->onclick,"UTF-8","HTML-ENTITIES"); endif; ?>" name="onclick" class="widefat">
                            <span class="howto">Link/URL to go to when a user clicks the slide eg. http://www.domain.com/mypage/</span>
                        </td>
					</tr>
                    
					<tr>
						<th><label for="Slide_linktarget_self">Link Target</label>
									
			<span class="galleryhelp">
				<a  title="Depending on the purpose of specifying this link, you may want it to open in the same window or in a new window." onclick="return false;" href=""></a>
			</span>
			
			</th>
						<td>
                        <?php if(isset($get_images[0]->linktarget)): $tager_check=$get_images[0]->linktarget; else: $tager_check="_self"; endif; ?>
							<label><input type="radio" id="Slide_linktarget_self" value="_self" name="linktarget" <?php if($tager_check=='_self'): ?>  checked="checked" <?php endif; ?>> Current Window</label>
							<label><input type="radio" id="Slide_linktarget_blank" value="_blank" name="linktarget" <?php if($tager_check!='_self'): ?>  checked="checked" <?php endif; ?>> New/Blank Window</label>
							<span class="howto">Should this link open in the current window or a new window?</span>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		
		<p class="submit">
			<input type="submit" value=" <?php if($id>0): ?>
  		<?php _e('Edit Images') ?>
    <?php else: ?>
    	<?php _e('Save Image') ?>
    <?php endif; ?>" name="submit" class="button-primary">
			</p>
		<p></p>
	</form>
</div>