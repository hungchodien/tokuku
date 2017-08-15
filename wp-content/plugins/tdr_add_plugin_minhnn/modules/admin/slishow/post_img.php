<?php 

	global $wpdb;
	$table_img = $wpdb->prefix . "tdr_img";
	$url_action=IF_PLUGIN_TDR_MINHNN_ADMIN_DIR."?page=slishow_atn";
	$url_action_gallery=IF_PLUGIN_TDR_MINHNN_ADMIN_DIR."?page=slishow_atn_galleries";
	$where_news=" 1=1 ";
	$count_row = $wpdb->get_results("SELECT count(*) as `count_news` FROM `" .$wpdb->prefix ."tdr_image` `A` INNER JOIN `".$wpdb->prefix ."tdr_gallery_img` `B` ON `A`.`slider_id`=`B`.`slider_id` INNER JOIN `".$wpdb->prefix ."tdr_gallery` `C` ON `B`.`gallery_id`=`C`.`gallery_id` WHERE".$where_news);
	//print_r( $count_row);			
					$numrows=$count_row[0]->count_news;
					$rowsperpage =30;
					$range = 3;

					//echo $numrows;

					$totalpages = ceil($numrows / $rowsperpage);

					if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {

					   $currentpage = (int) $_GET['currentpage'];

					} else {

					    $currentpage = 1;
					} 
					if ($currentpage > $totalpages) {
						$currentpage = $totalpages;
					} 
					if ($currentpage < 1) {
						$currentpage = 1;
					}
					$offset = ($currentpage - 1) * $rowsperpage;
		?>
<div class="wrap Gallery slideshow">

	<h2>Manage Images 

<a title="" target="_self" href="<?php echo $url_action; ?>&method=save" rel="" class="add-new-h2">Add New</a> 

	</h2>

	 <?php if(isset($_GET['message'])):?>

	<div class="updated fade">

		<p><?php echo $_GET['message']; ?></p>

	</div>

    <?php endif; ?>

		<form method="post" action="<?php echo $url_action; ?>&method=delete" onsubmit="if (!confirm('Are you sure you want to permanently remove this images?')) { return false; }">

			<div class="tablenav">

				<div class="alignleft actions">

					<select class="action" name="action">

						<option value="">- Bulk Actions -</option>

						<option value="delete">Delete</option>

					</select>
					<input type="submit" name="execute" value="Apply" class="button">
					<a title="" target="_self" href="<?php echo $url_action_gallery; ?>" rel="" class="add-new_before add-new-h2">Manage Gallery</a> &nbsp; &nbsp;
                    <a title="" target="_self" href="<?php echo $url_action_gallery; ?>&method=save" rel="" class="add-new_before add-new-h2">Add Gallery</a> 
				</div>

                

                <div class="alignright actions">

                	<ul class="navi" >

    	<li><i>Page Item:</i> </li>

    	    <?php 

		

		$string_page="&currentpage=";

		$currentUrl = $url_action.$string_page;
		if ($currentpage > 1)
		{
			$prevpage = $currentpage - 1;
			echo "<li class='next_btn'> <a href='".$currentUrl.$prevpage."'>&laquo;</a> </li>";
			if($prevpage>3){ echo "<li><a href='".$currentUrl."1' title='First Page 1'>1..</a></li> ";}
			else{ if($prevpage==4){ echo " <li><a href='".$currentUrl."1'>1</a></li> "; }
			else{ echo "";}
		}
		} 
		for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {
				if (($x > 0) && ($x <= $totalpages)) {
					 if ($x == $currentpage) {
						echo "<li class='currentPage'><b style='color:#F00'>$x</b></li> ";
					} else {
						echo " <li><a href='".$currentUrl.$x."'>$x</a></li> ";
						} 
					} 
				} 
			if ($currentpage != $totalpages) {
					$nextpage = $currentpage + 1;
					//echo " <li><a href='#' onclick='LoadPage_Job($totalpages,$category_id);'  title='End-Page -$totalpages'>End</a></li> ";
					echo "<li class='next_btn'> <a href='".$currentUrl.$nextpage."' title='Next'>&raquo;</a> </li>";
					echo " <li><a href='".$currentUrl.$totalpages."' title='End-Page -$totalpages'>End</a></li> ";
			} 
			?>
		</ul>
			</div>
		</div>
		<table class="widefat">
				<thead>
					<tr>
						<th class="check-column"><input type="checkbox" value="checkboxall" id="checkboxall" name="checkboxall"></th>
						<th class="column-id sortable desc">
						<a href="#">

								<span><?php _e('ID');?></span>

								<span class="sorting-indicator"></span>

							</a>

						</th>

						<th class="column-image sortable desc">

							<a href="#">

								<span><?php _e('Image');?></span>

								<span class="sorting-indicator"></span>

							</a>

						</th>

						<th class="column-title sortable desc">

							<a href="#">

								<span><?php _e('Title');?></span>

								<span class="sorting-indicator"></span>

							</a>

						</th>

						<th><?php _e('Galleries');?></th>

                        <th class="column-uselink sortable desc">

							<a href="#">

								<span><?php _e('Link');?></span>

								<span class="sorting-indicator"></span>

							</a>

						</th>

						<th class="column-modified sorted desc">

							<a href="#">

								<span><?php _e('Date');?></span>

								<span class="sorting-indicator"></span>

							</a>

						</th>

						<th class="column-order sortable desc">

							<a href="#">

								<span><?php _e('Order');?></span>

								<span class="sorting-indicator"></span>

							</a>

						</th>

					</tr>

				</thead>

				<tfoot>

                	<tr>

						<th class="check-column"><input type="checkbox" value="checkboxall" id="checkboxall" name="checkboxall"></th>

						<th class="column-id sortable desc">

							<a href="#">

								<span><?php _e('ID');?></span>

								<span class="sorting-indicator"></span>

							</a>

						</th>

						<th class="column-image sortable desc">

							<a href="#">

								<span><?php _e('Image');?></span>

								<span class="sorting-indicator"></span>

							</a>

						</th>

						<th class="column-title sortable desc">

							<a href="#">

								<span><?php _e('Title');?></span>

								<span class="sorting-indicator"></span>

							</a>

						</th>

						<th><?php _e('Galleries');?></th>

                        <th class="column-uselink sortable desc">

							<a href="#">

								<span><?php _e('Link');?></span>

								<span class="sorting-indicator"></span>

							</a>

						</th>

						<th class="column-modified sorted desc">

							<a href="#">

								<span><?php _e('Date');?></span>

								<span class="sorting-indicator"></span>

							</a>

						</th>

						<th class="column-order sortable desc">

							<a href="#">

								<span><?php _e('Order');?></span>

								<span class="sorting-indicator"></span>

							</a>

						</th>

					</tr>

				</tfoot>

                <tbody>

                 <?php
		global $wpdb;
		$table_news = $wpdb->get_results("SELECT * FROM " .$wpdb->prefix ."tdr_image `A`  JOIN `".$wpdb->prefix."tdr_gallery_img` `B` ON `A`.`slider_id`=`B`.`slider_id`  JOIN `".$wpdb->prefix."tdr_gallery` `C` ON `B`.`gallery_id`=`C`.`gallery_id` WHERE ".$where_news." ORDER BY `A`.`created` DESC LIMIT {$offset},{$rowsperpage}");
		if($table_news){
			$i=0;
			foreach($table_news as $news_item) { 
			$i++;
		?>
				<tr class="<?php echo (ceil($i/2) == ($i/2)) ? "" : "alternate"; ?>">
							<th class="check-column"><input type="checkbox" id="checklist1" value="<?php echo $news_item->slider_id;?>" name="post_id[]"></th>
							<td><?php echo $news_item->slider_id;?></td>
							<td style="width:75px;">
								<a rel="slides" class="colorbox cboxElement" onclick="jQuery.colorbox({href:'<?php echo $news_item->image_url; ?>'}); return false;"  href="<?php echo $news_item->image_url;?>">
								<img alt="logo1321988856" src="<?php $url_cut= $news_item->image_url; $image_cut = aq_resize( $url_cut, 50,50, true );echo  $image_cut;?>" class="dropshadow">
								 </a>
							</td>
							<td>
								<a title="" href="<?php echo $url_action; ?>&method=save&id=<?php echo $news_item->slider_id;?>" class="row-title"><?php echo $news_item->title;?></a>
								<div class="row-actions">
									<span class="edit"><a title="" target="_self" href="<?php echo $url_action; ?>&method=save&id=<?php echo $news_item->slider_id;?>" rel="" class="wpco">Edit</a> |</span>
									<span class="delete"><a title="" target="_self" href="<?php echo $url_action; ?>&method=delete&id=<?php echo $news_item->slider_id;?>" onclick="if (!confirm('Are you sure you want to permanently remove this image?')) { return false; }" rel="" class="submitdelete">Delete</a></span>
								</div>
							</td>
                            
							<td><a title="Index Slider<?php echo $news_item->slider_id;?>" href="#"><?php echo $news_item->title_gallery;?></a></td>
							<td><span style="color:red;"><?php echo $news_item->link;?></span></td>
							<td><abbr title="<?php echo $news_item->modified;?>"><?php echo  date('Y-m-d', strtotime($news_item->modified));?></abbr></td>
							<td><?php echo $news_item->order;?></td>
						</tr>
							 <?php 

		   						}

		  					}

						  ?>  
					</tbody>
				</table>
			<div class="tablenav"></div>
		</form>

	</div>