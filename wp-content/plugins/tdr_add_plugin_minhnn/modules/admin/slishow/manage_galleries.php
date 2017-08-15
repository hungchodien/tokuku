<?php 

	if(isset($_GET['method'])):

		$method=$_GET['method'];

	else:

		$method="";

	endif;

	

	if(isset($_GET['id'])):

		$id=(int)$_GET['id'];

	else:

		$id="";

	endif;

	

	if(isset($_GET['page'])):

		$page=$_GET['page'];

	else:

		$page="";

	endif;

	

if($page=='slishow_atn_galleries'):

	if($method=='save'):

		require_once IF_PLUGIN_TDR_MINHNN_MODULES_DIR.'/admin/slishow/add_gallery.php';

	else:

		global $wpdb;

		$table_gallery_delete = $wpdb->prefix . "tdr_gallery";

		$table_join_gallery_img = $wpdb->prefix . "tdr_gallery_img";

		

		if($method=='delete'):

		

			if(!empty($_POST['post_id'])):

				if($_POST['action']=='delete'):

					$post_id_array=$_POST['post_id'];

					//print_r($post_id_array);

					$k=0;

					for($k=0; $k<count($post_id_array); $k++):

						$query_delete_img = "DELETE FROM ".$table_gallery_delete." WHERE `gallery_id` =".$post_id_array[$k]." LIMIT 1";

						$query_delete_join = "DELETE FROM ".$table_join_gallery_img." WHERE `gallery_id` =".$post_id_array[$k];

						$wpdb->query($query_delete_img);

						$wpdb->query($query_delete_join);

					endfor;

					wp_redirect(IF_PLUGIN_TDR_MINHNN_ADMIN_DIR."?page=".$page);

				else:

				wp_redirect(IF_PLUGIN_TDR_MINHNN_ADMIN_DIR."?page=".$page); 

				endif;

			else:

				if($id>0):

					

				$query_delete_img = "DELETE FROM ".$table_gallery_delete." WHERE `gallery_id` =".$id." LIMIT 1";

				$query_delete_join = "DELETE FROM ".$table_join_gallery_img." WHERE `gallery_id` =".$id." LIMIT 1";

				$wpdb->query($query_delete_img);

				$wpdb->query($query_delete_join);

						

					wp_redirect(IF_PLUGIN_TDR_MINHNN_ADMIN_DIR."?page=".$page); 

				else:

				wp_redirect(IF_PLUGIN_TDR_MINHNN_ADMIN_DIR."?page=".$page); 

				endif;

			

			endif;

		else:

			require_once IF_PLUGIN_TDR_MINHNN_MODULES_DIR.'/admin/slishow/post_gallery.php';

		endif;

	endif;

endif;

?>