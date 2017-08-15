<?php 
	global $wpdb;
	$table_gallery = $wpdb->prefix . "tdr_gallery";
	$url_action=IF_PLUGIN_TDR_MINHNN_ADMIN_DIR."?page=slishow_atn_galleries";
	$url_action_img=IF_PLUGIN_TDR_MINHNN_ADMIN_DIR."?page=slishow_atn";
	$where_edition=" 1=1 ";
?>

<div class="wrap tdr_img clear">

	<h2>Manage Galleries <a class="add-new-h2" rel="" href="<?php IF_PLUGIN_TDR_MINHNN_ADMIN_DIR;?>?page=slishow_atn_galleries&amp;method=save" target="_self" title="">Add New</a></h2>

    <?php if(isset($_GET['message'])):?>

	<div class="updated fade">

		<p><?php echo $_GET['message']; ?></p>

	</div>

    <?php endif; ?>
<form onsubmit="if (!confirm('Are you sure you wish to execute this action on the selected galleries?')) { return false; }" action="<?php echo $url_action; ?>&method=delete" method="post">

			<div class="tablenav">

				<div class="alignleft actions">				

					<select name="action" class="action">

						<option value="">- Bulk Actions -</option>

						<option value="delete">Delete</option>

					</select>

					<input type="submit" class="button" value="Apply" name="execute">
					<a title="" target="_self" href="<?php echo $url_action_img; ?>" rel="" class="add-new_before add-new-h2">Manage Images</a> &nbsp; &nbsp;
				</div>

							</div>

			

					

			<table class="widefat">

				<thead>

					<tr>

						<th class="check-column"><input type="checkbox" name="checkboxall" id="checkboxall" value="checkboxall"></th>

						<th class="column-id sortable desc">

							<a href="javascript:void(0);">

								<span>ID</span>

								<span class="sorting-indicator"></span>

							</a>

						</th>

						<th class="column-title sortable desc">

							<a href="javascript:void(0);">

								<span><?php _e('Title');?></span>

								<span class="sorting-indicator"></span>

							</a>

						</th>

						

						<th class="column-modified sorted desc">

							<a href="javascript:void(0);">

								<span><?php _e('Slug');?></span>

								<span class="sorting-indicator"></span>

							</a>

						</th>
                       <th class="column-modified sorted desc">

							<a href="javascript:void(0);">

								<span><?php _e('Short Code');?></span>

								<span class="sorting-indicator"></span>

							</a>

						</th>

					</tr>

				</thead>

				<tfoot>

					<tr>

						<th class="check-column"><input type="checkbox" name="checkboxall" id="checkboxall" value="checkboxall"></th>

						<th class="column-id sortable desc">

							<a href="javascript:void(0);">

								<span>ID</span>

								<span class="sorting-indicator"></span>

							</a>

						</th>

						<th class="column-title sortable desc">

							<a href="javascript:void(0);">

								<span><?php _e('Title');?></span>

								<span class="sorting-indicator"></span>

							</a>

						</th>
					
						<th class="column-title sortable desc">

							<a href="javascript:void(0);">
								<span><?php _e('Slug');?></span>
								<span class="sorting-indicator"></span>
							</a>

						</th>		

						<th class="column-modified sorted desc">

							<a href="javascript:void(0);">
								<span><?php _e('Short Code');?></span>
								<span class="sorting-indicator"></span>
							</a>
						</th>

					</tr>

				</tfoot>

				

                <?php 

				

    $data_galleries = $wpdb->get_results("SELECT * FROM " .$table_gallery."  WHERE ".$where_edition." ORDER BY `modified` DESC");

	

	if($data_galleries):

           $i=0;

           foreach($data_galleries as $data_gallery): 

               $i++;

        	

				?>

                		<tbody>

							<tr class="<?php echo (ceil($i/2) == ($i/2)) ? "" : "alternate"; ?>">

			<th class="check-column"><input type="checkbox" name="post_id[]" value="<?php echo $data_gallery->gallery_id;?>" id="checklist2"></th>

							<td><?php echo $data_gallery->gallery_id;?></td>

							<td>
					<a class="row-title" href="<?php echo $url_action; ?>&method=save&id=<?php echo $data_gallery->gallery_id;?>" title=""><?php echo $data_gallery->title_gallery;?></a>
						<div class="row-actions">
								<span class="edit"><a class="wpco" rel="" href="<?php echo $url_action; ?>&method=save&id=<?php echo $data_gallery->gallery_id;?>" target="_self" title="">Edit</a> |</span>
								<span class="delete"><a class="submitdelete" rel="" onclick="if (!confirm('Are you sure you want to permanently remove this slide?')) { return false; }" href="<?php echo $url_action; ?>&method=delete&id=<?php echo $data_gallery->gallery_id;?>" target="_self" title="">Delete</a></span>
						</div>
							</td>
							<td><?php echo $data_gallery->slug_gallery;?></td>
                            <td>
                            <div class="group_short_code clear">
                           	 <strong class="note">Use option</strong>:   <b>[tdrSlider slug="<?php echo $data_gallery->slug_gallery ?>" option="1" width="980" height="320" order="DESC" orderby="date"]</b>
                            </div>
                        	<ul class="li_note clear">
                                	<li>Slug(string): value slug gallery</li>
                                    <li>Option(0/1): =0 resize img . =1 not resize</li>
                                    <li>Width: value width</li>
                                    <li>Height: value height</li>
                                    <li>order: value: DESC/ASC</li>
                                    <li>orderby: date/order</li>
                                 </ul>
                                <b>Shortcode Return Data json</b>
                            </td>
							
						</tr>

                        </tbody>

					<?php 

						endforeach;

					endif;

					?>						
			</table>
			<div class="tablenav"></div>
		</form>
</div>