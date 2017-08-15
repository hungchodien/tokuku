<?php

	global $wpdb;

	$table_gallery = $wpdb->prefix . "tdr_gallery";

	$time_current=date("Y-m-d H:i:s");

	if(isset($_POST['submit'])):
		$title_post=addslashes($_POST['title']);
		if(isset($_POST['slug']) && !empty($_POST['slug'])):
			$slug_post=sanitize_title(addslashes($_POST['slug']));
		else:
			$slug_post=sanitize_title($title_post);
		endif;
		
		if($title_post!=""):
			$id_post=(int)$_POST['gallery_id'];
			if($id_post>0):
				$data_gallery=array(
					'title_gallery' =>$title_post,
					'slug_gallery' =>$slug_post,
					'modified'=>$time_current,
					'status'=>0
				);	
				$wpdb->update($table_gallery,$data_gallery,array('gallery_id'=>$id_post));
				wp_redirect(IF_PLUGIN_TDR_MINHNN_ADMIN_DIR."?page=".$_GET['page']."&message=Gallery+has been+saved"); 
			else:

				$data_gallery=array(
					'title_gallery' =>$title_post,
					'slug_gallery' =>$slug_post,
					'created'=>$time_current,
					'modified'=>$time_current,
					'status'=>0
				);	

				$wpdb->insert($table_gallery,$data_gallery);

					wp_redirect(IF_PLUGIN_TDR_MINHNN_ADMIN_DIR."?page=".$_GET['page']."&message=Gallery+has+been+ saved"); 
			endif;

		endif;

	endif;

 
	//$id=0;
	if(isset($_GET['id'])):
	$id=(int)$_GET['id'];
	endif;
	if($id>0):

	$get_galleries = $wpdb->get_results("SELECT * FROM " .$table_gallery. " WHERE `gallery_id`=".$id. " LIMIT 1");

	$title_gallery=$get_galleries[0]->title_gallery;
	$slug_gallery=$get_galleries[0]->slug_gallery;
	$id_gallery=$get_galleries[0]->gallery_id;

	endif;

?>

<div class="wrap tdr_img clear">

	<?php if($id>0): ?>

  		<h2><?php _e('Edit a Gallery') ?></h2>

    <?php else: ?>

    	<h2><?php _e('Save a Gallery') ?></h2>

    <?php endif; ?>

  	<form action="" method="post">

		<input type="hidden" name="gallery_id" value="<?php echo $id_gallery; ?>">

		<table class="form-table">

			<tbody>

				<tr>

					<th><label for="Gallery_title">Title</label>

								

			<span class="galleryhelp">

	<a href="" onclick="return false;" title="Give this gallery a title/name for your own reference."></a>

			</span>

			

			</th>

					<td>

				<input type="text" class="widefat" name="title" value="<?php if(isset($title_gallery)): echo $title_gallery; endif; ?>" id="tdr_title">
					<span class="howto">Title of this gallery for identification purposes.</span>
					</td>

				</tr>
				
                <tr>

					<th><label for="Gallery_title">Slug</label>
					<span class="galleryhelp"><a href="" onclick="return false;" title="Give this gallery a slug for your own reference."></a></span>
					</th>
					<td>
						 <input type="text" class="widefat" name="slug" value="<?php if(isset($slug_gallery)): echo $slug_gallery; endif; ?>" id="tdr_title">
							<span class="howto">Slug of this gallery for identification purposes.</span>
					</td>

				</tr>
                
                
			</tbody>

		</table>

	

		<p class="submit">

		<input type="submit" class="button-primary" value="<?php if($id>0): ?>

  		<?php _e('Edit Gallery') ?>

    <?php else: ?>

    	<?php _e('Save Gallery') ?>

    <?php endif; ?>" name="submit">

		</p>

		<p></p>

	</form>

</div>