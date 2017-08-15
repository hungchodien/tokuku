<?php 
	/*
		Author: Minh.nguyen250385@gmail.com
	*/
	require_once IF_PLUGIN_TDR_MINHNN_DIR.'/inc/aq_resizer.php';
	
	//add_action( 'save_post', 'Securimage::save_posts_hook' );
	function load_ATC_wp_media_files_tdr() {
  		wp_enqueue_media();
	}
	add_action( 'admin_enqueue_scripts', 'load_ATC_wp_media_files_tdr' );
	
function the_slug_exists($post_name) {
	  global $wpdb;
	    if($wpdb->get_row("SELECT post_name FROM ".$wpdb->prefix."posts WHERE post_name = '" . $post_name . "'", 'ARRAY_A')) {
	        return true;
	    } else {
	        return false;
	    }
   }
function formatMoney12($number, $fractional=false) {
	if ($fractional) {
		$number = sprintf('%.2f', $number);
	}
	while (true) {
		$replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
			if ($replaced != $number) {
				$number = $replaced;
			} else{
					break;
				}
			}
		return $number;
} 

function tdr_save_options(){
	
	$theme_options	= get_option( "tdr_theme_options" );
	
	$array_option_tdr=array();
	
	for( $i = 0; $i < count($_POST['header_option_values_line']); $i++ ):
		$header_option_texts_line=($_POST['header_option_texts_line'][$i] != '' ) ? $_POST['header_option_texts_line'][$i] : '';
		$header_option_values_line=($_POST['header_option_values_line'][$i] != '' ) ? $_POST['header_option_values_line'][$i] : '';
		if(!empty($header_option_texts_line)):
			$header_option_texts_lines=strtolower(str_replace(" ", "_", $header_option_texts_line));
			$array_list_option=array(
				$header_option_texts_lines =>addslashes($header_option_values_line),
				"group_tdr" =>array(
					"tdr_name"=>$header_option_texts_lines,
					"tdr_choise"=>"line",
					"tdr_value"=>addslashes($header_option_values_line),
					$header_option_texts_lines =>addslashes($header_option_values_line)
				));
			array_push($array_option_tdr,$array_list_option);
		endif;
	endfor;
	
	for( $i = 0; $i < count($_POST['header_option_values_muti_line']); $i++ ):
		$header_option_texts_muti_line=($_POST['header_option_texts_muti_line'][$i] != '' ) ? $_POST['header_option_texts_muti_line'][$i] : ''; 
		$header_option_values_muti_line=($_POST['header_option_values_muti_line'][$i] != '' ) ? $_POST['header_option_values_muti_line'][$i] : '';
		if(!empty($header_option_texts_muti_line)):
			$header_option_texts_muti_lines=strtolower(str_replace(" ", "_", $header_option_texts_muti_line));
			$array_list_option=array(
				$header_option_texts_muti_lines =>addslashes($header_option_values_muti_line),
				"group_tdr" =>array(
					"tdr_name"=>$header_option_texts_muti_lines,
					"tdr_choise"=>"muti_line",
					"tdr_value"=>addslashes($header_option_values_muti_line),
					$header_option_texts_muti_lines =>addslashes($header_option_values_muti_line)
				));
			array_push($array_option_tdr,$array_list_option);
			
		endif;
	endfor;
	
	for( $i = 0; $i < count($_POST['header_option_values_img_line']); $i++ ):
		$header_option_texts_img_line=($_POST['header_option_texts_img_line'][$i] != '' ) ? $_POST['header_option_texts_img_line'][$i] : '';
		$header_option_values_img_line=($_POST['header_option_values_img_line'][$i] != '' ) ? $_POST['header_option_values_img_line'][$i] : '';
		if(!empty($header_option_texts_img_line)):
			$header_option_texts_img_lines=strtolower(str_replace(" ", "_", $header_option_texts_img_line));
			$array_list_option=array(
			$header_option_texts_img_lines =>addslashes($header_option_values_img_line),
			"group_tdr" =>array(
				"tdr_name"=>$header_option_texts_img_lines,
				"tdr_choise"=>"img_line",
				"tdr_value"=>addslashes($header_option_values_img_line),
				$header_option_texts_img_lines =>addslashes($header_option_values_img_line)
			));
			array_push($array_option_tdr,$array_list_option);
			
		endif;
	endfor;
	
	$theme_options['mh']=serialize($array_option_tdr);
	$gallery_option_generate=   $_POST['select_checkbox_gallery'];
	
	$array_option_gallery=array();
	for( $j = 0; $j < count($_POST['select_checkbox_gallery']); $j++ ){
		$option_value_gallery =	($_POST['select_checkbox_gallery'][$j] != '' ) ? $_POST['select_checkbox_gallery'][$j] : '';
		//echo $option_value_gallery ;
		if(!empty( $option_value_gallery )){ 
			array_push($array_option_gallery,wp_filter_post_kses( $option_value_gallery ));
		}
	}
	$theme_options['select_checkbox_gallery']=serialize($array_option_gallery);
	//print_r($array_option_gallery);
	$updated =	update_option( "tdr_theme_options", $theme_options );
	
	wp_redirect( admin_url( 'admin.php?page=atn_minnn&updated=true' ) );
	exit;
}
   
function get_img_by_size($img_url,$width,$height){
	$image_resize = aq_resize($img_url, $width,$height,true);
	if(empty($image_resize)):
		return;
	else:
		return $image_resize;
	endif;
}
function TDR_render_field($array="",$index=0){
	if(!empty($array)):
		$array_index=$array[$index];
		if(!empty($array_index)):
			$string_array=json_encode($array_index);
			return $string_array;
		else:
			return;
		endif;
	endif;
}
//add_action( 'init','get_option_minhnn');
function get_option_minhnn($name){
	$options=get_option('tdr_theme_options');
	$string="";
	if(!empty( $options['mh'] ) ):
		$array_option_autos=unserialize($options['mh']);
		foreach($array_option_autos as $array_option_auto){
			if(!empty($array_option_auto[$name])):
				$string .= $array_option_auto[$name];
			endif;
			
		}
		return stripslashes(stripslashes($string));
	else:
		return $string;
	endif;
}
add_action( 'init','init_atn_postype');
 function init_atn_postype() {

		// Create atn_postype post type
		$labels = array(
			'name' => __( 'Custom Post Type ', 'custom-post-type-atn' ),
			'singular_name' => __( 'Custom Post Type', 'custom-post-type-atn' ),
			'add_new' => __( 'Add New' , 'custom-post-type-atn' ),
			'add_new_item' => __( 'Add New Custom Post Type' , 'custom-post-type-atn' ),
			'edit_item' =>  __( 'Edit Custom Post Type' , 'custom-post-type-atn' ),
			'new_item' => __( 'New Custom Post Type' , 'custom-post-type-atn' ),
			'view_item' => __('View Custom Post Type', 'custom-post-type-atn' ),
			'search_items' => __('Search Custom Post Types', 'custom-post-type-atn' ),
			'not_found' =>  __('No Custom Post Types found', 'custom-post-type-atn' ),
			'not_found_in_trash' => __('No Custom Post Types found in Trash', 'custom-post-type-atn' ),
		);

		register_post_type( 'atn_postype', array(
			'labels' => $labels,
			'public' => false,
			'show_ui' => true,
			'_builtin' =>  false,
			'capability_type' => 'page',
			'hierarchical' => false,
			'rewrite' => false,
			'query_var' => 'atn_postype',
			'supports' => array(
				'title'
			),
			'show_in_menu' => false,
		));

		// Create atn_postype_tax post type
		$labels = array(
			'name' => __( 'Custom Taxonomies', 'custom-post-type-atn' ),
			'singular_name' => __( 'Custom Taxonomy', 'custom-post-type-atn' ),
			'add_new' => __( 'Add New' , 'custom-post-type-atn' ),
			'add_new_item' => __( 'Add New Custom Taxonomy' , 'custom-post-type-atn' ),
			'edit_item' =>  __( 'Edit Custom Taxonomy' , 'custom-post-type-atn' ),
			'new_item' => __( 'New Custom Taxonomy' , 'custom-post-type-atn' ),
			'view_item' => __('View Custom Taxonomy', 'custom-post-type-atn' ),
			'search_items' => __('Search Custom Taxonomies', 'custom-post-type-atn' ),
			'not_found' =>  __('No Custom Taxonomies found', 'custom-post-type-atn' ),
			'not_found_in_trash' => __('No Custom Taxonomies found in Trash', 'custom-post-type-atn' ),
		);

		register_post_type( 'atn_postype_tax', array(
			'labels' => $labels,
			'public' => false,
			'show_ui' => true,
			'_builtin' =>  false,
			'capability_type' => 'page',
			'hierarchical' => false,
			'rewrite' => false,
			'query_var' => 'atn_postype_tax',
			'supports' => array(
				'title'
			),
			'show_in_menu' => false,
		));

		// Add image size for the Custom Post Type icon
		if ( function_exists( 'add_image_size' ) ) {
			add_image_size( 'atn_postype_icon', 16, 16, true );
		}
} // # function init()



function atn_postype_create_custom_post_types() {

		// vars
		$atn_postypes = array();
		$atn_postype_taxs = array();

		// query custom post types
		$get_atn_postype = array(
			'numberposts' 	   => -1,
			'post_type' 	   => 'atn_postype',
			'post_status'      => 'publish',
			'suppress_filters' => false,
		);
		$atn_postype_post_types = get_posts( $get_atn_postype );

		// create array of post meta
		if( $atn_postype_post_types ) {
			foreach( $atn_postype_post_types as $atn_postype ) {
				$atn_postype_meta = get_post_meta( $atn_postype->ID, '', true );

				// text
				$atn_postype_name                = ( array_key_exists( 'atn_postype_name', $atn_postype_meta ) && $atn_postype_meta['atn_postype_name'][0] ? esc_html( $atn_postype_meta['atn_postype_name'][0] ) : 'no_name' );
				$atn_postype_label               = ( array_key_exists( 'atn_postype_label', $atn_postype_meta ) && $atn_postype_meta['atn_postype_label'][0] ? esc_html( $atn_postype_meta['atn_postype_label'][0] ) : $atn_postype_name );
				$atn_postype_singular_name       = ( array_key_exists( 'atn_postype_singular_name', $atn_postype_meta ) && $atn_postype_meta['atn_postype_singular_name'][0] ? esc_html( $atn_postype_meta['atn_postype_singular_name'][0] ) : $atn_postype_label );
				$atn_postype_description         = ( array_key_exists( 'atn_postype_description', $atn_postype_meta ) && $atn_postype_meta['atn_postype_description'][0] ? $atn_postype_meta['atn_postype_description'][0] : '' );
				$atn_postype_icon                = ( array_key_exists( 'atn_postype_icon', $atn_postype_meta ) && $atn_postype_meta['atn_postype_icon'][0] ? $atn_postype_meta['atn_postype_icon'][0] : false );
				$atn_postype_custom_rewrite_slug = ( array_key_exists( 'atn_postype_custom_rewrite_slug', $atn_postype_meta ) && $atn_postype_meta['atn_postype_custom_rewrite_slug'][0] ? esc_html( $atn_postype_meta['atn_postype_custom_rewrite_slug'][0] ) : $atn_postype_name );
				$atn_postype_menu_position       = ( array_key_exists( 'atn_postype_menu_position', $atn_postype_meta ) && $atn_postype_meta['atn_postype_menu_position'][0] ? (int) $atn_postype_meta['atn_postype_menu_position'][0] : null );

				// dropdown
				$atn_postype_public              = ( array_key_exists( 'atn_postype_public', $atn_postype_meta ) && $atn_postype_meta['atn_postype_public'][0] == '1' ? true : false );
				$atn_postype_show_ui             = ( array_key_exists( 'atn_postype_show_ui', $atn_postype_meta ) && $atn_postype_meta['atn_postype_show_ui'][0] == '1' ? true : false );
				$atn_postype_has_archive         = ( array_key_exists( 'atn_postype_has_archive', $atn_postype_meta ) && $atn_postype_meta['atn_postype_has_archive'][0] == '1' ? true : false );
				$atn_postype_exclude_from_search = ( array_key_exists( 'atn_postype_exclude_from_search', $atn_postype_meta ) && $atn_postype_meta['atn_postype_exclude_from_search'][0] == '1' ? true : false );
				$atn_postype_capability_type     = ( array_key_exists( 'atn_postype_capability_type', $atn_postype_meta ) && $atn_postype_meta['atn_postype_capability_type'][0] ? $atn_postype_meta['atn_postype_capability_type'][0] : 'post' );
				$atn_postype_hierarchical        = ( array_key_exists( 'atn_postype_hierarchical', $atn_postype_meta ) && $atn_postype_meta['atn_postype_hierarchical'][0] == '1' ? true : false );
				$atn_postype_rewrite             = ( array_key_exists( 'atn_postype_rewrite', $atn_postype_meta ) && $atn_postype_meta['atn_postype_rewrite'][0] == '1' ? true : false );
				$atn_postype_withfront           = ( array_key_exists( 'atn_postype_withfront', $atn_postype_meta ) && $atn_postype_meta['atn_postype_withfront'][0] == '1' ? true : false );
				$atn_postype_feeds               = ( array_key_exists( 'atn_postype_feeds', $atn_postype_meta ) && $atn_postype_meta['atn_postype_feeds'][0] == '1' ? true : false );
				$atn_postype_pages               = ( array_key_exists( 'atn_postype_pages', $atn_postype_meta ) && $atn_postype_meta['atn_postype_pages'][0] == '1' ? true : false );
				$atn_postype_query_var           = ( array_key_exists( 'atn_postype_query_var', $atn_postype_meta ) && $atn_postype_meta['atn_postype_query_var'][0] == '1' ? true : false );
				$atn_postype_show_in_menu        = ( array_key_exists( 'atn_postype_show_in_menu', $atn_postype_meta ) && $atn_postype_meta['atn_postype_show_in_menu'][0] == '1' ? true : false );

				// checkbox
				$atn_postype_supports            = ( array_key_exists( 'atn_postype_supports', $atn_postype_meta ) && $atn_postype_meta['atn_postype_supports'][0] ? $atn_postype_meta['atn_postype_supports'][0] : 'a:2:{i:0;s:5:"title";i:1;s:6:"editor";}' );
				$atn_postype_builtin_taxonomies  = ( array_key_exists( 'atn_postype_builtin_taxonomies', $atn_postype_meta ) && $atn_postype_meta['atn_postype_builtin_taxonomies'][0] ? $atn_postype_meta['atn_postype_builtin_taxonomies'][0] : 'a:0:{}' );

				$atn_postype_rewrite_options     = array();
				if ( $atn_postype_rewrite )      { $atn_postype_rewrite_options['slug'] = _x( $atn_postype_custom_rewrite_slug, 'URL Slug', 'custom-post-type-atn' ); }
				if ( $atn_postype_withfront )    { $atn_postype_rewrite_options['with_front'] = $atn_postype_withfront; }
				if ( $atn_postype_feeds )        { $atn_postype_rewrite_options['feeds'] = $atn_postype_feeds; }
				if ( $atn_postype_pages )        { $atn_postype_rewrite_options['pages'] = $atn_postype_pages; }

				$atn_postypes[] = array(
					'atn_postype_id'                  => $atn_postype->ID,
					'atn_postype_name'                => $atn_postype_name,
					'atn_postype_label'               => $atn_postype_label,
					'atn_postype_singular_name'       => $atn_postype_singular_name,
					'atn_postype_description'         => $atn_postype_description,
					'atn_postype_icon'                => $atn_postype_icon,
					'atn_postype_custom_rewrite_slug' => $atn_postype_custom_rewrite_slug,
					'atn_postype_menu_position'       => $atn_postype_menu_position,
					'atn_postype_public'              => (bool) $atn_postype_public,
					'atn_postype_show_ui'             => (bool) $atn_postype_show_ui,
					'atn_postype_has_archive'         => (bool) $atn_postype_has_archive,
					'atn_postype_exclude_from_search' => (bool) $atn_postype_exclude_from_search,
					'atn_postype_capability_type'     => $atn_postype_capability_type,
					'atn_postype_hierarchical'        => (bool) $atn_postype_hierarchical,
					'atn_postype_rewrite'             => $atn_postype_rewrite_options,
					'atn_postype_query_var'           => (bool) $atn_postype_query_var,
					'atn_postype_show_in_menu'        => (bool) $atn_postype_show_in_menu,
					'atn_postype_supports'            => unserialize( $atn_postype_supports ),
					'atn_postype_builtin_taxonomies'  => unserialize( $atn_postype_builtin_taxonomies ),
				);

				// register custom post types
				if ( is_array( $atn_postypes ) ) {
					foreach ($atn_postypes as $atn_postype_post_type) {

						$labels = array(
							'name'                => __( $atn_postype_post_type['atn_postype_label'], 'custom-post-type-atn' ),
							'singular_name'       => __( $atn_postype_post_type['atn_postype_singular_name'], 'custom-post-type-atn' ),
							'add_new'             => __( 'Add New' , 'custom-post-type-atn' ),
							'add_new_item'        => __( 'Add New ' . $atn_postype_post_type['atn_postype_singular_name'] , 'custom-post-type-atn' ),
							'edit_item'           => __( 'Edit ' . $atn_postype_post_type['atn_postype_singular_name'] , 'custom-post-type-atn' ),
							'new_item'            => __( 'New ' . $atn_postype_post_type['atn_postype_singular_name'] , 'custom-post-type-atn' ),
							'view_item'           => __( 'View ' . $atn_postype_post_type['atn_postype_singular_name'], 'custom-post-type-atn' ),
							'search_items'        => __( 'Search ' . $atn_postype_post_type['atn_postype_label'], 'custom-post-type-atn' ),
							'not_found'           => __( 'No ' .  $atn_postype_post_type['atn_postype_label'] . ' found', 'custom-post-type-atn' ),
							'not_found_in_trash'  => __( 'No ' .  $atn_postype_post_type['atn_postype_label'] . ' found in Trash', 'custom-post-type-atn' ),
						);

						$args = array(
							'labels'              => $labels,
							'description'         => $atn_postype_post_type['atn_postype_description'],
							'menu_icon'           => $atn_postype_post_type['atn_postype_icon'],
							'rewrite'             => $atn_postype_post_type['atn_postype_rewrite'],
							'menu_position'       => $atn_postype_post_type['atn_postype_menu_position'],
							'public'              => $atn_postype_post_type['atn_postype_public'],
							'show_ui'             => $atn_postype_post_type['atn_postype_show_ui'],
							'has_archive'         => $atn_postype_post_type['atn_postype_has_archive'],
							'exclude_from_search' => $atn_postype_post_type['atn_postype_exclude_from_search'],
							'capability_type'     => $atn_postype_post_type['atn_postype_capability_type'],
							'hierarchical'        => $atn_postype_post_type['atn_postype_hierarchical'],
							'show_in_menu'        => $atn_postype_post_type['atn_postype_show_in_menu'],
							'query_var'           => $atn_postype_post_type['atn_postype_query_var'],
							'publicly_queryable'  => true,
							'_builtin'            => false,
							'supports'            => $atn_postype_post_type['atn_postype_supports'],
							'taxonomies'          => $atn_postype_post_type['atn_postype_builtin_taxonomies']
						);

						if( $atn_postype_post_type['atn_postype_name'] != 'no_name' )
							register_post_type( $atn_postype_post_type['atn_postype_name'], $args);
					}
				}
			}
		}

		// query custom taxonomies
		$get_atn_postype_tax = array(
			'numberposts' 	   => -1,
			'post_type' 	   => 'atn_postype_tax',
			'post_status'      => 'publish',
			'suppress_filters' => false,
		);
		$atn_postype_taxonomies = get_posts( $get_atn_postype_tax );

		// create array of post meta
		if( $atn_postype_taxonomies ) {
			foreach( $atn_postype_taxonomies as $atn_postype_tax ) {
				$atn_postype_meta = get_post_meta( $atn_postype_tax->ID, '', true );

				// text
				$atn_postype_tax_name                = ( array_key_exists( 'atn_postype_tax_name', $atn_postype_meta ) && $atn_postype_meta['atn_postype_tax_name'][0] ? esc_html( $atn_postype_meta['atn_postype_tax_name'][0] ) : 'no_name' );
				$atn_postype_tax_label               = ( array_key_exists( 'atn_postype_tax_label', $atn_postype_meta ) && $atn_postype_meta['atn_postype_tax_label'][0] ? esc_html( $atn_postype_meta['atn_postype_tax_label'][0] ) : $atn_postype_tax_name );
				$atn_postype_tax_singular_name       = ( array_key_exists( 'atn_postype_tax_singular_name', $atn_postype_meta ) && $atn_postype_meta['atn_postype_tax_singular_name'][0] ? esc_html( $atn_postype_meta['atn_postype_tax_singular_name'][0] ) : $atn_postype_tax_label );
				$atn_postype_tax_custom_rewrite_slug = ( array_key_exists( 'atn_postype_tax_custom_rewrite_slug', $atn_postype_meta ) && $atn_postype_meta['atn_postype_tax_custom_rewrite_slug'][0] ? esc_html( $atn_postype_meta['atn_postype_tax_custom_rewrite_slug'][0] ) : $atn_postype_tax_name );

				// dropdown
				$atn_postype_tax_show_ui             = ( array_key_exists( 'atn_postype_tax_show_ui', $atn_postype_meta ) && $atn_postype_meta['atn_postype_tax_show_ui'][0] == '1' ? true : false );
				$atn_postype_tax_hierarchical        = ( array_key_exists( 'atn_postype_tax_hierarchical', $atn_postype_meta ) && $atn_postype_meta['atn_postype_tax_hierarchical'][0] == '1' ? true : false );
				$atn_postype_tax_rewrite             = ( array_key_exists( 'atn_postype_tax_rewrite', $atn_postype_meta ) && $atn_postype_meta['atn_postype_tax_rewrite'][0] == '1' ? array( 'slug' => _x( $atn_postype_tax_custom_rewrite_slug, 'URL Slug', 'custom-post-type-atn' ) ) : false );
				$atn_postype_tax_query_var           = ( array_key_exists( 'atn_postype_tax_query_var', $atn_postype_meta ) && $atn_postype_meta['atn_postype_tax_query_var'][0] == '1' ? true : false );

				// checkbox
				$atn_postype_tax_post_types          = ( array_key_exists( 'atn_postype_tax_post_types', $atn_postype_meta ) && $atn_postype_meta['atn_postype_tax_post_types'][0] ? $atn_postype_meta['atn_postype_tax_post_types'][0] : 'a:0:{}' );

				$atn_postype_taxs[] = array(
					'atn_postype_tax_id'                  => $atn_postype_tax->ID,
					'atn_postype_tax_name'                => $atn_postype_tax_name,
					'atn_postype_tax_label'               => $atn_postype_tax_label,
					'atn_postype_tax_singular_name'       => $atn_postype_tax_singular_name,
					'atn_postype_tax_custom_rewrite_slug' => $atn_postype_tax_custom_rewrite_slug,
					'atn_postype_tax_show_ui'             => (bool) $atn_postype_tax_show_ui,
					'atn_postype_tax_hierarchical'        => (bool) $atn_postype_tax_hierarchical,
					'atn_postype_tax_rewrite'             => $atn_postype_tax_rewrite,
					'atn_postype_tax_query_var'           => (bool) $atn_postype_tax_query_var,
					'atn_postype_tax_builtin_taxonomies'  => unserialize( $atn_postype_tax_post_types ),
				);

				// register custom post types
				if ( is_array( $atn_postype_taxs ) ) {
					foreach ($atn_postype_taxs as $atn_postype_taxonomy) {

						$labels = array(
							'name'                       => _x( $atn_postype_taxonomy['atn_postype_tax_label'], 'taxonomy general name', 'custom-post-type-atn' ),
							'singular_name'              => _x( $atn_postype_taxonomy['atn_postype_tax_singular_name'], 'taxonomy singular name' ),
							'search_items'               => __( 'Search ' . $atn_postype_taxonomy['atn_postype_tax_label'], 'custom-post-type-atn' ),
							'popular_items'              => __( 'Popular ' . $atn_postype_taxonomy['atn_postype_tax_label'], 'custom-post-type-atn' ),
							'all_items'                  => __( 'All ' . $atn_postype_taxonomy['atn_postype_tax_label'], 'custom-post-type-atn' ),
							'parent_item'                => __( 'Parent ' . $atn_postype_taxonomy['atn_postype_tax_singular_name'], 'custom-post-type-atn' ),
							'parent_item_colon'          => __( 'Parent ' . $atn_postype_taxonomy['atn_postype_tax_singular_name'], 'custom-post-type-atn' . ':' ),
							'edit_item'                  => __( 'Edit ' . $atn_postype_taxonomy['atn_postype_tax_singular_name'], 'custom-post-type-atn' ),
							'update_item'                => __( 'Update ' . $atn_postype_taxonomy['atn_postype_tax_singular_name'], 'custom-post-type-atn' ),
							'add_new_item'               => __( 'Add New ' . $atn_postype_taxonomy['atn_postype_tax_singular_name'], 'custom-post-type-atn' ),
							'new_item_name'              => __( 'New ' . $atn_postype_taxonomy['atn_postype_tax_singular_name'], 'custom-post-type-atn' . ' Name' ),
							'separate_items_with_commas' => __( 'Seperate ' . $atn_postype_taxonomy['atn_postype_tax_label'], 'custom-post-type-atn' . ' with commas' ),
							'add_or_remove_items'        => __( 'Add or remove ' . $atn_postype_taxonomy['atn_postype_tax_label'], 'custom-post-type-atn' ),
							'choose_from_most_used'      => __( 'Choose from the most used ' . $atn_postype_taxonomy['atn_postype_tax_label'], 'custom-post-type-atn' ),
							'menu_name'                  => __( 'All ' . $atn_postype_taxonomy['atn_postype_tax_label'], 'custom-post-type-atn' )
						);

						$args = array(
							'label'               => $atn_postype_taxonomy['atn_postype_tax_label'],
							'labels'              => $labels,
							'rewrite'             => $atn_postype_taxonomy['atn_postype_tax_rewrite'],
							'show_ui'             => $atn_postype_taxonomy['atn_postype_tax_show_ui'],
							'hierarchical'        => $atn_postype_taxonomy['atn_postype_tax_hierarchical'],
							'query_var'           => $atn_postype_taxonomy['atn_postype_tax_query_var'],
						);

						if( $atn_postype_taxonomy['atn_postype_tax_name'] != 'no_name' )
							register_taxonomy( $atn_postype_taxonomy['atn_postype_tax_name'], $atn_postype_taxonomy['atn_postype_tax_builtin_taxonomies'], $args );
					}
				}
			}
		}

		// flush permalink structure
		// global $wp_rewrite;
		// $wp_rewrite->flush_rules();

} // # function atn_postype_create_custom_post_types()

function atn_postype_create_meta_boxes() {
	// add options meta box
		add_meta_box(
			'atn_postype_options',
			__( 'Options', 'custom-post-type-atn' ),
			'atn_postype_meta_box',
			'atn_postype',
			'advanced',
			'high'
	);
	add_meta_box(
			'atn_postype_tax_options',
			__( 'Options', 'custom-post-type-atn' ),
			'atn_postype_tax_meta_box',
			'atn_postype_tax',
			'advanced',
			'high'
	);
} // # function atn_postype_create_meta_boxes()
function atn_postype_meta_box( $post ) {

		// get post meta values
		$values = get_post_custom( $post->ID );

		// text fields
		$atn_postype_name                          = isset( $values['atn_postype_name'] ) ? esc_attr( $values['atn_postype_name'][0] ) : '';
		$atn_postype_label                         = isset( $values['atn_postype_label'] ) ? esc_attr( $values['atn_postype_label'][0] ) : '';
		$atn_postype_singular_name                 = isset( $values['atn_postype_singular_name'] ) ? esc_attr( $values['atn_postype_singular_name'][0] ) : '';
		$atn_postype_description                   = isset( $values['atn_postype_description'] ) ? esc_attr( $values['atn_postype_description'][0] ) : '';
		$atn_postype_icon                          = isset( $values['atn_postype_icon'] ) ? esc_attr( $values['atn_postype_icon'][0] ) : '';
		$atn_postype_custom_rewrite_slug           = isset( $values['atn_postype_custom_rewrite_slug'] ) ? esc_attr( $values['atn_postype_custom_rewrite_slug'][0] ) : '';
		$atn_postype_menu_position                 = isset( $values['atn_postype_menu_position'] ) ? esc_attr( $values['atn_postype_menu_position'][0] ) : '';

		// select fields
		$atn_postype_public                        = isset( $values['atn_postype_public'] ) ? esc_attr( $values['atn_postype_public'][0] ) : '';
		$atn_postype_show_ui                       = isset( $values['atn_postype_show_ui'] ) ? esc_attr( $values['atn_postype_show_ui'][0] ) : '';
		$atn_postype_has_archive                   = isset( $values['atn_postype_has_archive'] ) ? esc_attr( $values['atn_postype_has_archive'][0] ) : '';
		$atn_postype_exclude_from_search           = isset( $values['atn_postype_exclude_from_search'] ) ? esc_attr( $values['atn_postype_exclude_from_search'][0] ) : '';
		$atn_postype_capability_type               = isset( $values['atn_postype_capability_type'] ) ? esc_attr( $values['atn_postype_capability_type'][0] ) : '';
		$atn_postype_hierarchical                  = isset( $values['atn_postype_hierarchical'] ) ? esc_attr( $values['atn_postype_hierarchical'][0] ) : '';
		$atn_postype_rewrite                       = isset( $values['atn_postype_rewrite'] ) ? esc_attr( $values['atn_postype_rewrite'][0] ) : '';
		$atn_postype_withfront                     = isset( $values['atn_postype_withfront'] ) ? esc_attr( $values['atn_postype_withfront'][0] ) : '';
		$atn_postype_feeds                         = isset( $values['atn_postype_feeds'] ) ? esc_attr( $values['atn_postype_feeds'][0] ) : '';
		$atn_postype_pages                         = isset( $values['atn_postype_pages'] ) ? esc_attr( $values['atn_postype_pages'][0] ) : '';
		$atn_postype_query_var                     = isset( $values['atn_postype_query_var'] ) ? esc_attr( $values['atn_postype_query_var'][0] ) : '';
		$atn_postype_show_in_menu                  = isset( $values['atn_postype_show_in_menu'] ) ? esc_attr( $values['atn_postype_show_in_menu'][0] ) : '';

		// checkbox fields
		$atn_postype_supports                      = isset( $values['atn_postype_supports'] ) ? unserialize( $values['atn_postype_supports'][0] ) : array();
		$atn_postype_supports_title                = ( isset( $values['atn_postype_supports'] ) && in_array( 'title', $atn_postype_supports ) ? 'title' : '' );
		$atn_postype_supports_editor               = ( isset( $values['atn_postype_supports'] ) && in_array( 'editor', $atn_postype_supports ) ? 'editor' : '' );
		$atn_postype_supports_excerpt              = ( isset( $values['atn_postype_supports'] ) && in_array( 'excerpt', $atn_postype_supports ) ? 'excerpt' : '' );
		$atn_postype_supports_trackbacks           = ( isset( $values['atn_postype_supports'] ) && in_array( 'trackbacks', $atn_postype_supports ) ? 'trackbacks' : '' );
		$atn_postype_supports_custom_fields        = ( isset( $values['atn_postype_supports'] ) && in_array( 'custom-fields', $atn_postype_supports ) ? 'custom-fields' : '' );
		$atn_postype_supports_comments             = ( isset( $values['atn_postype_supports'] ) && in_array( 'comments', $atn_postype_supports ) ? 'comments' : '' );
		$atn_postype_supports_revisions            = ( isset( $values['atn_postype_supports'] ) && in_array( 'revisions', $atn_postype_supports ) ? 'revisions' : '' );
		$atn_postype_supports_featured_image       = ( isset( $values['atn_postype_supports'] ) && in_array( 'thumbnail', $atn_postype_supports ) ? 'thumbnail' : '' );
		$atn_postype_supports_author               = ( isset( $values['atn_postype_supports'] ) && in_array( 'author', $atn_postype_supports ) ? 'author' : '' );
		$atn_postype_supports_page_attributes      = ( isset( $values['atn_postype_supports'] ) && in_array( 'page-attributes', $atn_postype_supports ) ? 'page-attributes' : '' );
		$atn_postype_supports_post_formats         = ( isset( $values['atn_postype_supports'] ) && in_array( 'post-formats', $atn_postype_supports ) ? 'post-formats' : '' );

		$atn_postype_builtin_taxonomies            = isset( $values['atn_postype_builtin_taxonomies'] ) ? unserialize( $values['atn_postype_builtin_taxonomies'][0] ) : array();
		$atn_postype_builtin_taxonomies_categories = ( isset( $values['atn_postype_builtin_taxonomies'] ) && in_array( 'category', $atn_postype_builtin_taxonomies ) ? 'category' : '' );
		$atn_postype_builtin_taxonomies_tags       = ( isset( $values['atn_postype_builtin_taxonomies'] ) && in_array( 'post_tag', $atn_postype_builtin_taxonomies ) ? 'post_tag' : '' );

		// nonce
		wp_nonce_field( 'atn_postype_meta_box_nonce_action', 'atn_postype_meta_box_nonce_field' );

		// set defaults if new Custom Post Type is being created
		global $pagenow;
		$atn_postype_supports_title                = $pagenow === 'post-new.php' ? 'title' : $atn_postype_supports_title;
		$atn_postype_supports_editor               = $pagenow === 'post-new.php' ? 'editor' : $atn_postype_supports_editor;
		$atn_postype_supports_excerpt              = $pagenow === 'post-new.php' ? 'excerpt' : $atn_postype_supports_excerpt;
		?>
		<table class="atn_postype">
			<tr>
				<td class="label">
					<label for="atn_postype_name"><span class="required">*</span> <?php _e( 'Custom Post Type Name', 'custom-post-type-atn' ); ?></label>
					<p><?php _e( 'The post type name. Used to retrieve custom post type content. Must be all in lower-case and without any spaces.', 'custom-post-type-atn' ); ?></p>
					<p><?php _e( 'e.g. movies', 'custom-post-type-atn' ); ?></p>
				</td>
				<td>
					<input type="text" name="atn_postype_name" id="atn_postype_name" class="widefat" tabindex="1" value="<?php echo $atn_postype_name; ?>" />
				</td>
			</tr>
			<tr>
				<td class="label">
					<label for="atn_postype_label"><?php _e( 'Label', 'custom-post-type-atn' ); ?></label>
					<p><?php _e( 'A plural descriptive name for the post type.', 'custom-post-type-atn' ); ?></p>
					<p><?php _e( 'e.g. Movies', 'custom-post-type-atn' ); ?></p>
				</td>
				<td>
					<input type="text" name="atn_postype_label" id="atn_postype_label" class="widefat" tabindex="2" value="<?php echo $atn_postype_label; ?>" />
				</td>
			</tr>
			<tr>
				<td class="label">
					<label for="atn_postype_singular_name"><?php _e( 'Singular Name', 'custom-post-type-atn' ); ?></label>
					<p><?php _e( 'A singular descriptive name for the post type.', 'custom-post-type-atn' ); ?></p>
					<p><?php _e( 'e.g. Movie', 'custom-post-type-atn' ); ?></p>
				</td>
				<td>
					<input type="text" name="atn_postype_singular_name" id="atn_postype_singular_name" class="widefat" tabindex="3" value="<?php echo $atn_postype_singular_name; ?>" />
				</td>
			</tr>
			<tr>
				<td class="label top">
					<label for="atn_postype_description"><?php _e( 'Description', 'custom-post-type-atn' ); ?></label>
					<p><?php _e( 'A short descriptive summary of what the post type is.', 'custom-post-type-atn' ); ?></p>
				</td>
				<td>
					<textarea name="atn_postype_description" id="atn_postype_description" class="widefat" tabindex="4" rows="4"><?php echo $atn_postype_description; ?></textarea>
				</td>
			</tr>
			<tr>
				<td colspan="2" class="section">
					<h3><?php _e( 'Visibility', 'custom-post-type-atn' ); ?></h3>
				</td>
			</tr>
			<tr>
				<td class="label">
					<label for="atn_postype_public"><?php _e( 'Public', 'custom-post-type-atn' ); ?></label>
					<p><?php _e( 'Whether a post type is intended to be used publicly either via the admin interface or by front-end users.', 'custom-post-type-atn' ); ?></p>
				</td>
				<td>
					<select name="atn_postype_public" id="atn_postype_public" tabindex="5">
						<option value="1" <?php selected( $atn_postype_public, '1' ); ?>><?php _e( 'True', 'custom-post-type-atn' ); ?> (<?php _e( 'default', 'custom-post-type-atn' ); ?>)</option>
						<option value="0" <?php selected( $atn_postype_public, '0' ); ?>><?php _e( 'False', 'custom-post-type-atn' ); ?></option>
					</select>
				</td>
			</tr>
			<tr>
				<td colspan="2" class="section">
					<h3><?php _e( 'Rewrite Options', 'custom-post-type-atn' ); ?></h3>
				</td>
			</tr>
			<tr>
				<td class="label">
					<label for="atn_postype_rewrite"><?php _e( 'Rewrite', 'custom-post-type-atn' ); ?></label>
					<p><?php _e( 'Triggers the handling of rewrites for this post type.', 'custom-post-type-atn' ); ?></p>
				</td>
				<td>
					<select name="atn_postype_rewrite" id="atn_postype_rewrite" tabindex="6">
						<option value="1" <?php selected( $atn_postype_rewrite, '1' ); ?>><?php _e( 'True', 'custom-post-type-atn' ); ?> (<?php _e( 'default', 'custom-post-type-atn' ); ?>)</option>
						<option value="0" <?php selected( $atn_postype_rewrite, '0' ); ?>><?php _e( 'False', 'custom-post-type-atn' ); ?></option>
					</select>
				</td>
			</tr>
			<tr>
				<td class="label">
					<label for="atn_postype_withfront"><?php _e( 'With Front', 'custom-post-type-atn' ); ?></label>
					<p><?php _e( 'Should the permastruct be prepended with the front base.', 'custom-post-type-atn' ); ?></p>
				</td>
				<td>
					<select name="atn_postype_withfront" id="atn_postype_withfront" tabindex="7">
						<option value="1" <?php selected( $atn_postype_withfront, '1' ); ?>><?php _e( 'True', 'custom-post-type-atn' ); ?> (<?php _e( 'default', 'custom-post-type-atn' ); ?>)</option>
						<option value="0" <?php selected( $atn_postype_withfront, '0' ); ?>><?php _e( 'False', 'custom-post-type-atn' ); ?></option>
					</select>
				</td>
			</tr>
			<tr>
				<td class="label">
					<label for="atn_postype_custom_rewrite_slug"><?php _e( 'Custom Rewrite Slug', 'custom-post-type-atn' ); ?></label>
					<p><?php _e( 'Customize the permastruct slug.', 'custom-post-type-atn' ); ?></p>
					<p><?php _e( 'Default: [Custom Post Type Name]', 'custom-post-type-atn' ); ?></p>
				</td>
				<td>
					<input type="text" name="atn_postype_custom_rewrite_slug" id="atn_postype_custom_rewrite_slug" class="widefat" tabindex="8" value="<?php echo $atn_postype_custom_rewrite_slug; ?>" />
				</td>
			</tr>
			<tr>
				<td colspan="2" class="section">
					<h3><?php _e( 'Front-end Options', 'custom-post-type-atn' ); ?></h3>
				</td>
			</tr>
			<tr>
				<td class="label">
					<label for="atn_postype_feeds"><?php _e( 'Feeds', 'custom-post-type-atn' ); ?></label>
					<p><?php _e( 'Should a feed permastruct be built for this post type. Defaults to "has_archive" value.', 'custom-post-type-atn' ); ?></p>
				</td>
				<td>
					<select name="atn_postype_feeds" id="atn_postype_feeds" tabindex="9">
						<option value="0" <?php selected( $atn_postype_feeds, '0' ); ?>><?php _e( 'False', 'custom-post-type-atn' ); ?> (<?php _e( 'default', 'custom-post-type-atn' ); ?>)</option>
						<option value="1" <?php selected( $atn_postype_feeds, '1' ); ?>><?php _e( 'True', 'custom-post-type-atn' ); ?></option>
					</select>
				</td>
			</tr>
			<tr>
				<td class="label">
					<label for="atn_postype_pages"><?php _e( 'Pages', 'custom-post-type-atn' ); ?></label>
					<p><?php _e( 'Should the permastruct provide for pagination.', 'custom-post-type-atn' ); ?></p>
				</td>
				<td>
					<select name="atn_postype_pages" id="atn_postype_pages" tabindex="10">
						<option value="1" <?php selected( $atn_postype_pages, '1' ); ?>><?php _e( 'True', 'custom-post-type-atn' ); ?> (<?php _e( 'default', 'custom-post-type-atn' ); ?>)</option>
						<option value="0" <?php selected( $atn_postype_pages, '0' ); ?>><?php _e( 'False', 'custom-post-type-atn' ); ?></option>
					</select>
				</td>
			</tr>
			<tr>
				<td class="label">
					<label for="atn_postype_exclude_from_search"><?php _e( 'Exclude From Search', 'custom-post-type-atn' ); ?></label>
					<p><?php _e( 'Whether to exclude posts with this post type from front end search results.', 'custom-post-type-atn' ); ?></p>
				</td>
				<td>
					<select name="atn_postype_exclude_from_search" id="atn_postype_exclude_from_search" tabindex="11">
						<option value="0" <?php selected( $atn_postype_exclude_from_search, '0' ); ?>><?php _e( 'False', 'custom-post-type-atn' ); ?> (<?php _e( 'default', 'custom-post-type-atn' ); ?>)</option>
						<option value="1" <?php selected( $atn_postype_exclude_from_search, '1' ); ?>><?php _e( 'True', 'custom-post-type-atn' ); ?></option>
					</select>
				</td>
			</tr>
			<tr>
				<td class="label">
					<label for="atn_postype_has_archive"><?php _e( 'Has Archive', 'custom-post-type-atn' ); ?></label>
					<p><?php _e( 'Enables post type archives.', 'custom-post-type-atn' ); ?></p>
				</td>
				<td>
					<select name="atn_postype_has_archive" id="atn_postype_has_archive" tabindex="12">
						<option value="0" <?php selected( $atn_postype_has_archive, '0' ); ?>><?php _e( 'False', 'custom-post-type-atn' ); ?> (<?php _e( 'default', 'custom-post-type-atn' ); ?>)</option>
						<option value="1" <?php selected( $atn_postype_has_archive, '1' ); ?>><?php _e( 'True', 'custom-post-type-atn' ); ?></option>
					</select>
				</td>
			</tr>
			<tr>
				<td colspan="2" class="section">
					<h3><?php _e( 'Admin Menu Options', 'custom-post-type-atn' ); ?></h3>
				</td>
			</tr>
			<tr>
				<td class="label">
					<label for="atn_postype_show_ui"><?php _e( 'Show UI', 'custom-post-type-atn' ); ?></label>
					<p><?php _e( 'Whether to generate a default UI for managing this post type in the admin.', 'custom-post-type-atn' ); ?></p>
				</td>
				<td>
					<select name="atn_postype_show_ui" id="atn_postype_show_ui" tabindex="13">
						<option value="1" <?php selected( $atn_postype_show_ui, '1' ); ?>><?php _e( 'True', 'custom-post-type-atn' ); ?> (<?php _e( 'default', 'custom-post-type-atn' ); ?>)</option>
						<option value="0" <?php selected( $atn_postype_show_ui, '0' ); ?>><?php _e( 'False', 'custom-post-type-atn' ); ?></option>
					</select>
				</td>
			</tr>
			<tr>
				<td class="label">
					<label for="atn_postype_menu_position"><?php _e( 'Menu Position', 'custom-post-type-atn' ); ?></label>
					<p><?php _e( 'The position in the menu order the post type should appear. "Show in Menu" must be true.', 'custom-post-type-atn' ); ?></p>
				</td>
				<td>
					<input type="text" name="atn_postype_menu_position" id="atn_postype_menu_position" class="widefat" tabindex="14" value="<?php echo $atn_postype_menu_position; ?>" />
				</td>
			</tr>
			<tr>
				<td class="label">
					<label for="atn_postype_show_in_menu"><?php _e( 'Show in Menu', 'custom-post-type-atn' ); ?></label>
					<p><?php _e( 'Where to show the post type in the admin menu. "Show UI" must be true.', 'custom-post-type-atn' ); ?></p>
				</td>
				<td>
					<select name="atn_postype_show_in_menu" id="atn_postype_show_in_menu" tabindex="15">
						<option value="1" <?php selected( $atn_postype_show_in_menu, '1' ); ?>><?php _e( 'True', 'custom-post-type-atn' ); ?> (<?php _e( 'default', 'custom-post-type-atn' ); ?>)</option>
						<option value="0" <?php selected( $atn_postype_show_in_menu, '0' ); ?>><?php _e( 'False', 'custom-post-type-atn' ); ?></option>
					</select>
				</td>
			</tr>
			<tr>
				<td class="label">
					<label for="atn_postype_menu_position"><?php _e( 'Icon', 'custom-post-type-atn' ); ?></label>
				</td>
				<td>
					<div class="atn_postype-icon">
						<div class="current-atn_postype-icon"><?php if ( $atn_postype_icon ) { ?><img src="<?php echo $atn_postype_icon; ?>" /><?php } ?></div>
						<a href="/" class="remove-atn_postype-icon button-secondary"<?php if ( ! $atn_postype_icon ) { ?> style="display: none;"<?php } ?>>Remove icon</a>
						<a  href="/"class="media-uploader-button button-primary" data-post-id="<?php echo $post->ID; ?>"><?php if ( ! $atn_postype_icon ) { ?><?php _e( 'Add icon', 'custom-post-type-atn' ); ?><?php } else { ?><?php _e( 'Edit icon', 'custom-post-type-atn' ); ?><?php } ?></a>
					</div>
					<input type="hidden" name="atn_postype_icon" id="atn_postype_icon" class="widefat" value="<?php echo $atn_postype_icon; ?>" />
				</td>
			</tr>
			<tr>
				<td colspan="2" class="section">
					<h3><?php _e( 'Wordpress Integration', 'custom-post-type-atn' ); ?></h3>
				</td>
			</tr>
			<tr>
				<td class="label">
					<label for="atn_postype_capability_type"><?php _e( 'Capability Type', 'custom-post-type-atn' ); ?></label>
					<p><?php _e( 'The post type to use to build the read, edit, and delete capabilities.', 'custom-post-type-atn' ); ?></p>
				</td>
				<td>
					<select name="atn_postype_capability_type" id="atn_postype_capability_type" tabindex="16">
						<option value="post" <?php selected( $atn_postype_capability_type, 'post' ); ?>><?php _e( 'Post', 'custom-post-type-atn' ); ?> (<?php _e( 'default', 'custom-post-type-atn' ); ?>)</option>
						<option value="page" <?php selected( $atn_postype_capability_type, 'page' ); ?>><?php _e( 'Page', 'custom-post-type-atn' ); ?></option>
					</select>
				</td>
			</tr>
			<tr>
				<td class="label">
					<label for="atn_postype_hierarchical"><?php _e( 'Hierarchical', 'custom-post-type-atn' ); ?></label>
					<p><?php _e( 'Whether the post type is hierarchical (e.g. page).', 'custom-post-type-atn' ); ?></p>
				</td>
				<td>
					<select name="atn_postype_hierarchical" id="atn_postype_hierarchical" tabindex="17">
						<option value="0" <?php selected( $atn_postype_hierarchical, '0' ); ?>><?php _e( 'False', 'custom-post-type-atn' ); ?> (<?php _e( 'default', 'custom-post-type-atn' ); ?>)</option>
						<option value="1" <?php selected( $atn_postype_hierarchical, '1' ); ?>><?php _e( 'True', 'custom-post-type-atn' ); ?></option>
					</select>
				</td>
			</tr>
			<tr>
				<td class="label">
					<label for="atn_postype_query_var"><?php _e( 'Query Var', 'custom-post-type-atn' ); ?></label>
					<p><?php _e( 'Sets the query_var key for this post type.', 'custom-post-type-atn' ); ?></p>
				</td>
				<td>
					<select name="atn_postype_query_var" id="atn_postype_query_var" tabindex="18">
						<option value="1" <?php selected( $atn_postype_query_var, '1' ); ?>><?php _e( 'True', 'custom-post-type-atn' ); ?> (<?php _e( 'default', 'custom-post-type-atn' ); ?>)</option>
						<option value="0" <?php selected( $atn_postype_query_var, '0' ); ?>><?php _e( 'False', 'custom-post-type-atn' ); ?></option>
					</select>
				</td>
			</tr>
			<tr>
				<td class="label top">
					<label for="atn_postype_supports"><?php _e( 'Supports', 'custom-post-type-atn' ); ?></label>
					<p><?php _e( 'Adds the respective meta boxes when creating content for this Custom Post Type.', 'custom-post-type-atn' ); ?></p>
				</td>
				<td>
					<input type="checkbox" tabindex="19" name="atn_postype_supports[]" id="atn_postype_supports_title" value="title" <?php checked( $atn_postype_supports_title, 'title' ); ?> /> <label for="atn_postype_supports_title"><?php _e( 'Title', 'custom-post-type-atn' ); ?> <span class="default">(<?php _e( 'default', 'custom-post-type-atn' ); ?>)</span></label><br />
					<input type="checkbox" tabindex="20" name="atn_postype_supports[]" id="atn_postype_supports_editor" value="editor" <?php checked( $atn_postype_supports_editor, 'editor' ); ?> /> <label for="atn_postype_supports_editor"><?php _e( 'Editor', 'custom-post-type-atn' ); ?> <span class="default">(<?php _e( 'default', 'custom-post-type-atn' ); ?>)</span></label><br />
					<input type="checkbox" tabindex="21" name="atn_postype_supports[]" id="atn_postype_supports_excerpt" value="excerpt" <?php checked( $atn_postype_supports_excerpt, 'excerpt' ); ?> /> <label for="atn_postype_supports_excerpt"><?php _e( 'Excerpt', 'custom-post-type-atn' ); ?> <span class="default">(<?php _e( 'default', 'custom-post-type-atn' ); ?>)</span></label><br />
					<input type="checkbox" tabindex="22" name="atn_postype_supports[]" id="atn_postype_supports_trackbacks" value="trackbacks" <?php checked( $atn_postype_supports_trackbacks, 'trackbacks' ); ?> /> <label for="atn_postype_supports_trackbacks"><?php _e( 'Trackbacks', 'custom-post-type-atn' ); ?></label><br />
					<input type="checkbox" tabindex="23" name="atn_postype_supports[]" id="atn_postype_supports_custom_fields" value="custom-fields" <?php checked( $atn_postype_supports_custom_fields, 'custom-fields' ); ?> /> <label for="atn_postype_supports_custom_fields"><?php _e( 'Custom Fields', 'custom-post-type-atn' ); ?></label><br />
					<input type="checkbox" tabindex="24" name="atn_postype_supports[]" id="atn_postype_supports_comments" value="comments" <?php checked( $atn_postype_supports_comments, 'comments' ); ?> /> <label for="atn_postype_supports_comments"><?php _e( 'Comments', 'custom-post-type-atn' ); ?></label><br />
					<input type="checkbox" tabindex="25" name="atn_postype_supports[]" id="atn_postype_supports_revisions" value="revisions" <?php checked( $atn_postype_supports_revisions, 'revisions' ); ?> /> <label for="atn_postype_supports_revisions"><?php _e( 'Revisions', 'custom-post-type-atn' ); ?></label><br />
					<input type="checkbox" tabindex="26" name="atn_postype_supports[]" id="atn_postype_supports_featured_image" value="thumbnail" <?php checked( $atn_postype_supports_featured_image, 'thumbnail' ); ?> /> <label for="atn_postype_supports_featured_image"><?php _e( 'Featured Image', 'custom-post-type-atn' ); ?></label><br />
					<input type="checkbox" tabindex="27" name="atn_postype_supports[]" id="atn_postype_supports_author" value="author" <?php checked( $atn_postype_supports_author, 'author' ); ?> /> <label for="atn_postype_supports_author"><?php _e( 'Author', 'custom-post-type-atn' ); ?></label><br />
					<input type="checkbox" tabindex="28" name="atn_postype_supports[]" id="atn_postype_supports_page_attributes" value="page-attributes" <?php checked( $atn_postype_supports_page_attributes, 'page-attributes' ); ?> /> <label for="atn_postype_supports_page_attributes"><?php _e( 'Page Attributes', 'custom-post-type-atn' ); ?></label><br />
					<input type="checkbox" tabindex="29" name="atn_postype_supports[]" id="atn_postype_supports_post_formats" value="post-formats" <?php checked( $atn_postype_supports_post_formats, 'post-formats' ); ?> /> <label for="atn_postype_supports_post_formats"><?php _e( 'Post Formats', 'custom-post-type-atn' ); ?></label><br />
				</td>
			</tr>
			<tr>
				<td class="label top">
					<label for="atn_postype_builtin_taxonomies"><?php _e( 'Built-in Taxonomies', 'custom-post-type-atn' ); ?></label>
					<p><?php _e( '', 'custom-post-type-atn' ); ?></p>
				</td>
				<td>
					<input type="checkbox" tabindex="30" name="atn_postype_builtin_taxonomies[]" id="atn_postype_builtin_taxonomies_categories" value="category" <?php checked( $atn_postype_builtin_taxonomies_categories, 'category' ); ?> /> <label for="atn_postype_builtin_taxonomies_categories"><?php _e( 'Categories', 'custom-post-type-atn' ); ?></label><br />
					<input type="checkbox" tabindex="31" name="atn_postype_builtin_taxonomies[]" id="atn_postype_builtin_taxonomies_tags" value="post_tag" <?php checked( $atn_postype_builtin_taxonomies_tags, 'post_tag' ); ?> /> <label for="atn_postype_builtin_taxonomies_tags"><?php _e( 'Tags', 'custom-post-type-atn' ); ?></label><br />
				</td>
			</tr>
		</table>

		<?php

} // # function atn_postype_meta_box()

function atn_postype_tax_meta_box( $post ) {

		// get post meta values
		$values = get_post_custom( $post->ID );

		// text fields
		$atn_postype_tax_name                          = isset( $values['atn_postype_tax_name'] ) ? esc_attr( $values['atn_postype_tax_name'][0] ) : '';
		$atn_postype_tax_label                         = isset( $values['atn_postype_tax_label'] ) ? esc_attr( $values['atn_postype_tax_label'][0] ) : '';
		$atn_postype_tax_singular_name                 = isset( $values['atn_postype_tax_singular_name'] ) ? esc_attr( $values['atn_postype_tax_singular_name'][0] ) : '';
		$atn_postype_tax_custom_rewrite_slug           = isset( $values['atn_postype_tax_custom_rewrite_slug'] ) ? esc_attr( $values['atn_postype_tax_custom_rewrite_slug'][0] ) : '';

		// select fields
		$atn_postype_tax_show_ui                       = isset( $values['atn_postype_tax_show_ui'] ) ? esc_attr( $values['atn_postype_tax_show_ui'][0] ) : '';
		$atn_postype_tax_hierarchical                  = isset( $values['atn_postype_tax_hierarchical'] ) ? esc_attr( $values['atn_postype_tax_hierarchical'][0] ) : '';
		$atn_postype_tax_rewrite                       = isset( $values['atn_postype_tax_rewrite'] ) ? esc_attr( $values['atn_postype_tax_rewrite'][0] ) : '';
		$atn_postype_tax_query_var                     = isset( $values['atn_postype_tax_query_var'] ) ? esc_attr( $values['atn_postype_tax_query_var'][0] ) : '';

		// checkbox fields
		$atn_postype_tax_supports                      = isset( $values['atn_postype_tax_supports'] ) ? unserialize( $values['atn_postype_tax_supports'][0] ) : array();
		$atn_postype_tax_supports_title                = ( isset( $values['atn_postype_tax_supports'] ) && in_array( 'title', $atn_postype_supports ) ? 'title' : '' );
		$atn_postype_tax_supports_editor               = ( isset( $values['atn_postype_tax_supports'] ) && in_array( 'editor', $atn_postype_supports ) ? 'editor' : '' );
		$atn_postype_tax_supports_excerpt              = ( isset( $values['atn_postype_tax_supports'] ) && in_array( 'excerpt', $atn_postype_supports ) ? 'excerpt' : '' );
		$atn_postype_tax_supports_trackbacks           = ( isset( $values['atn_postype_tax_supports'] ) && in_array( 'trackbacks', $atn_postype_supports ) ? 'trackbacks' : '' );
		$atn_postype_tax_supports_custom_fields        = ( isset( $values['atn_postype_tax_supports'] ) && in_array( 'custom-fields', $atn_postype_supports ) ? 'custom-fields' : '' );
		$atn_postype_tax_supports_comments             = ( isset( $values['atn_postype_tax_supports'] ) && in_array( 'comments', $atn_postype_supports ) ? 'comments' : '' );
		$atn_postype_tax_supports_revisions            = ( isset( $values['atn_postype_tax_supports'] ) && in_array( 'revisions', $atn_postype_supports ) ? 'revisions' : '' );
		$atn_postype_tax_supports_featured_image       = ( isset( $values['atn_postype_tax_supports'] ) && in_array( 'thumbnail', $atn_postype_supports ) ? 'thumbnail' : '' );
		$atn_postype_tax_supports_author               = ( isset( $values['atn_postype_tax_supports'] ) && in_array( 'author', $atn_postype_supports ) ? 'author' : '' );
		$atn_postype_tax_supports_page_attributes      = ( isset( $values['atn_postype_tax_supports'] ) && in_array( 'page-attributes', $atn_postype_supports ) ? 'page-attributes' : '' );
		$atn_postype_tax_supports_post_formats         = ( isset( $values['atn_postype_tax_supports'] ) && in_array( 'post-formats', $atn_postype_supports ) ? 'post-formats' : '' );

		$atn_postype_tax_post_types                    = isset( $values['atn_postype_tax_post_types'] ) ? unserialize( $values['atn_postype_tax_post_types'][0] ) : array();
		$atn_postype_tax_post_types_post               = ( isset( $values['atn_postype_tax_post_types'] ) && in_array( 'post', $atn_postype_tax_post_types ) ? 'post' : '' );
		$atn_postype_tax_post_types_page               = ( isset( $values['atn_postype_tax_post_types'] ) && in_array( 'page', $atn_postype_tax_post_types ) ? 'page' : '' );

		// nonce
		wp_nonce_field( 'atn_postype_meta_box_nonce_action', 'atn_postype_meta_box_nonce_field' );
		?>
		<table class="atn_postype">
			<tr>
				<td class="label">
					<label for="atn_postype_tax_name"><span class="required">*</span> <?php _e( 'Custom Taxonomy Name', 'custom-post-type-atn' ); ?></label>
					<p><?php _e( 'The taxonomy name. Used to retrieve custom taxonomy content.', 'custom-post-type-atn' ); ?></p>
					<p><?php _e( 'e.g. movies', 'custom-post-type-atn' ); ?></p>
				</td>
				<td>
					<input type="text" name="atn_postype_tax_name" id="atn_postype_tax_name" class="widefat" tabindex="1" value="<?php echo $atn_postype_tax_name; ?>" />
				</td>
			</tr>
			<tr>
				<td class="label">
					<label for="atn_postype_tax_label"><?php _e( 'Label', 'custom-post-type-atn' ); ?></label>
					<p><?php _e( 'A plural descriptive name for the taxonomy.', 'custom-post-type-atn' ); ?></p>
					<p><?php _e( 'e.g. Movies', 'custom-post-type-atn' ); ?></p>
				</td>
				<td>
					<input type="text" name="atn_postype_tax_label" id="atn_postype_tax_label" class="widefat" tabindex="2" value="<?php echo $atn_postype_tax_label; ?>" />
				</td>
			</tr>
			<tr>
				<td class="label">
					<label for="atn_postype_tax_singular_name"><?php _e( 'Singular Name', 'custom-post-type-atn' ); ?></label>
					<p><?php _e( 'A singular descriptive name for the taxonomy.', 'custom-post-type-atn' ); ?></p>
					<p><?php _e( 'e.g. Movie', 'custom-post-type-atn' ); ?></p>
				</td>
				<td>
					<input type="text" name="atn_postype_tax_singular_name" id="atn_postype_tax_singular_name" class="widefat" tabindex="3" value="<?php echo $atn_postype_tax_singular_name; ?>" />
				</td>
			</tr>
			<tr>
				<td class="label">
					<label for="atn_postype_tax_show_ui"><?php _e( 'Show UI', 'custom-post-type-atn' ); ?></label>
					<p><?php _e( 'Whether to generate a default UI for managing this taxonomy in the admin.', 'custom-post-type-atn' ); ?></p>
				</td>
				<td>
					<select name="atn_postype_tax_show_ui" id="atn_postype_tax_show_ui" tabindex="4">
						<option value="1" <?php selected( $atn_postype_tax_show_ui, '1' ); ?>><?php _e( 'True', 'custom-post-type-atn' ); ?> (<?php _e( 'default', 'custom-post-type-atn' ); ?>)</option>
						<option value="0" <?php selected( $atn_postype_tax_show_ui, '0' ); ?>><?php _e( 'False', 'custom-post-type-atn' ); ?></option>
					</select>
				</td>
			</tr>
			<tr>
				<td class="label">
					<label for="atn_postype_tax_hierarchical"><?php _e( 'Hierarchical', 'custom-post-type-atn' ); ?></label>
					<p><?php _e( 'Whether the taxonomy is hierarchical (e.g. page).', 'custom-post-type-atn' ); ?></p>
				</td>
				<td>
					<select name="atn_postype_tax_hierarchical" id="atn_postype_tax_hierarchical" tabindex="5">
						<option value="0" <?php selected( $atn_postype_tax_hierarchical, '0' ); ?>><?php _e( 'False', 'custom-post-type-atn' ); ?> (<?php _e( 'default', 'custom-post-type-atn' ); ?>)</option>
						<option value="1" <?php selected( $atn_postype_tax_hierarchical, '1' ); ?>><?php _e( 'True', 'custom-post-type-atn' ); ?></option>
					</select>
				</td>
			</tr>
			<tr>
				<td class="label">
					<label for="atn_postype_tax_rewrite"><?php _e( 'Rewrite', 'custom-post-type-atn' ); ?></label>
					<p><?php _e( 'Triggers the handling of rewrites for this taxonomy.', 'custom-post-type-atn' ); ?></p>
				</td>
				<td>
					<select name="atn_postype_tax_rewrite" id="atn_postype_tax_rewrite" tabindex="6">
						<option value="1" <?php selected( $atn_postype_tax_rewrite, '1' ); ?>><?php _e( 'True', 'custom-post-type-atn' ); ?> (<?php _e( 'default', 'custom-post-type-atn' ); ?>)</option>
						<option value="0" <?php selected( $atn_postype_tax_rewrite, '0' ); ?>><?php _e( 'False', 'custom-post-type-atn' ); ?></option>
					</select>
				</td>
			</tr>
			<tr>
				<td class="label">
					<label for="atn_postype_tax_custom_rewrite_slug"><?php _e( 'Custom Rewrite Slug', 'custom-post-type-atn' ); ?></label>
					<p><?php _e( 'Customize the permastruct slug.', 'custom-post-type-atn' ); ?></p>
					<p><?php _e( 'Default: [Custom Taxonomy Name]', 'custom-post-type-atn' ); ?></p>
				</td>
				<td>
					<input type="text" name="atn_postype_tax_custom_rewrite_slug" id="atn_postype_tax_custom_rewrite_slug" class="widefat" tabindex="7" value="<?php echo $atn_postype_tax_custom_rewrite_slug; ?>" />
				</td>
			</tr>
			<tr>
				<td class="label">
					<label for="atn_postype_tax_query_var"><?php _e( 'Query Var', 'custom-post-type-atn' ); ?></label>
					<p><?php _e( 'Sets the query_var key for this taxonomy.', 'custom-post-type-atn' ); ?></p>
				</td>
				<td>
					<select name="atn_postype_tax_query_var" id="atn_postype_tax_query_var" tabindex="8">
						<option value="1" <?php selected( $atn_postype_tax_query_var, '1' ); ?>><?php _e( 'True', 'custom-post-type-atn' ); ?> (<?php _e( 'default', 'custom-post-type-atn' ); ?>)</option>
						<option value="0" <?php selected( $atn_postype_tax_query_var, '0' ); ?>><?php _e( 'False', 'custom-post-type-atn' ); ?></option>
					</select>
				</td>
			</tr>
			<tr>
				<td class="label top">
					<label for="atn_postype_tax_post_types"><?php _e( 'Post Types', 'custom-post-type-atn' ); ?></label>
					<p><?php _e( '', 'custom-post-type-atn' ); ?></p>
				</td>
				<td>
					<input type="checkbox" tabindex="9" name="atn_postype_tax_post_types[]" id="atn_postype_tax_post_types_post" value="post" <?php checked( $atn_postype_tax_post_types_post, 'post' ); ?> /> <label for="atn_postype_tax_post_types_post"><?php _e( 'Posts', 'custom-post-type-atn' ); ?></label><br />
					<input type="checkbox" tabindex="10" name="atn_postype_tax_post_types[]" id="atn_postype_tax_post_types_page" value="page" <?php checked( $atn_postype_tax_post_types_page, 'page' ); ?> /> <label for="atn_postype_tax_post_types_page"><?php _e( 'Pages', 'custom-post-type-atn' ); ?></label><br />
					<?php
						$post_types = get_post_types( array( 'public' => true, '_builtin' => false ) );
						$i = 10;
						foreach ( $post_types as $post_type ) {
							$checked = in_array( $post_type, $atn_postype_tax_post_types )  ? 'checked="checked"' : '';
							?>
							<input type="checkbox" tabindex="<?php echo $i; ?>" name="atn_postype_tax_post_types[]" id="atn_postype_tax_post_types_<?php echo $post_type; ?>" value="<?php echo $post_type; ?>" <?php echo $checked; ?> /> <label for="atn_postype_tax_post_types_<?php echo $post_type; ?>"><?php echo ucfirst( $post_type ); ?></label><br />
							<?php
							$i++;
						}
					?>
				</td>
			</tr>
		</table>
		<?php

} // # function atn_postype_meta_box()

function atn_postype_save_post( $post_id ) {

		// verify if this is an auto save routine.
		// If it is our form has not been submitted, so we dont want to do anything
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return;

		// if our nonce isn't there, or we can't verify it, bail
		if( !isset( $_POST['atn_postype_meta_box_nonce_field'] ) || !wp_verify_nonce( $_POST['atn_postype_meta_box_nonce_field'], 'atn_postype_meta_box_nonce_action' ) ) return;

		// update custom post type meta values
		if( isset($_POST['atn_postype_name']) )
			update_post_meta( $post_id, 'atn_postype_name', sanitize_text_field( str_replace( ' ', '', $_POST['atn_postype_name'] ) ) );

		if( isset($_POST['atn_postype_label']) )
			update_post_meta( $post_id, 'atn_postype_label', sanitize_text_field( $_POST['atn_postype_label'] ) );

		if( isset($_POST['atn_postype_singular_name']) )
			update_post_meta( $post_id, 'atn_postype_singular_name', sanitize_text_field( $_POST['atn_postype_singular_name'] ) );

		if( isset($_POST['atn_postype_description']) )
			update_post_meta( $post_id, 'atn_postype_description', esc_textarea( $_POST['atn_postype_description'] ) );

		if( isset($_POST['atn_postype_icon']) )
			update_post_meta( $post_id, 'atn_postype_icon', esc_textarea( $_POST['atn_postype_icon'] ) );

		if( isset( $_POST['atn_postype_public'] ) )
			update_post_meta( $post_id, 'atn_postype_public', esc_attr( $_POST['atn_postype_public'] ) );

		if( isset( $_POST['atn_postype_show_ui'] ) )
			update_post_meta( $post_id, 'atn_postype_show_ui', esc_attr( $_POST['atn_postype_show_ui'] ) );

		if( isset( $_POST['atn_postype_has_archive'] ) )
			update_post_meta( $post_id, 'atn_postype_has_archive', esc_attr( $_POST['atn_postype_has_archive'] ) );

		if( isset( $_POST['atn_postype_exclude_from_search'] ) )
			update_post_meta( $post_id, 'atn_postype_exclude_from_search', esc_attr( $_POST['atn_postype_exclude_from_search'] ) );

		if( isset( $_POST['atn_postype_capability_type'] ) )
			update_post_meta( $post_id, 'atn_postype_capability_type', esc_attr( $_POST['atn_postype_capability_type'] ) );

		if( isset( $_POST['atn_postype_hierarchical'] ) )
			update_post_meta( $post_id, 'atn_postype_hierarchical', esc_attr( $_POST['atn_postype_hierarchical'] ) );

		if( isset( $_POST['atn_postype_rewrite'] ) )
			update_post_meta( $post_id, 'atn_postype_rewrite', esc_attr( $_POST['atn_postype_rewrite'] ) );

		if( isset( $_POST['atn_postype_withfront'] ) )
			update_post_meta( $post_id, 'atn_postype_withfront', esc_attr( $_POST['atn_postype_withfront'] ) );

		if( isset( $_POST['atn_postype_feeds'] ) )
			update_post_meta( $post_id, 'atn_postype_feeds', esc_attr( $_POST['atn_postype_feeds'] ) );

		if( isset( $_POST['atn_postype_pages'] ) )
			update_post_meta( $post_id, 'atn_postype_pages', esc_attr( $_POST['atn_postype_pages'] ) );

		if( isset($_POST['atn_postype_custom_rewrite_slug']) )
			update_post_meta( $post_id, 'atn_postype_custom_rewrite_slug', sanitize_text_field( $_POST['atn_postype_custom_rewrite_slug'] ) );

		if( isset( $_POST['atn_postype_query_var'] ) )
			update_post_meta( $post_id, 'atn_postype_query_var', esc_attr( $_POST['atn_postype_query_var'] ) );

		if( isset($_POST['atn_postype_menu_position']) )
			update_post_meta( $post_id, 'atn_postype_menu_position', sanitize_text_field( $_POST['atn_postype_menu_position'] ) );

		if( isset( $_POST['atn_postype_show_in_menu'] ) )
			update_post_meta( $post_id, 'atn_postype_show_in_menu', esc_attr( $_POST['atn_postype_show_in_menu'] ) );

		$atn_postype_supports = isset( $_POST['atn_postype_supports'] ) ? $_POST['atn_postype_supports'] : array();
			update_post_meta( $post_id, 'atn_postype_supports', $atn_postype_supports );

		$atn_postype_builtin_taxonomies = isset( $_POST['atn_postype_builtin_taxonomies'] ) ? $_POST['atn_postype_builtin_taxonomies'] : array();
			update_post_meta( $post_id, 'atn_postype_builtin_taxonomies', $atn_postype_builtin_taxonomies );

		// update taxonomy meta values
		if( isset($_POST['atn_postype_tax_name']) )
			update_post_meta( $post_id, 'atn_postype_tax_name', sanitize_text_field( str_replace( ' ', '', $_POST['atn_postype_tax_name'] ) ) );

		if( isset($_POST['atn_postype_tax_label']) )
			update_post_meta( $post_id, 'atn_postype_tax_label', sanitize_text_field( $_POST['atn_postype_tax_label'] ) );

		if( isset($_POST['atn_postype_tax_singular_name']) )
			update_post_meta( $post_id, 'atn_postype_tax_singular_name', sanitize_text_field( $_POST['atn_postype_tax_singular_name'] ) );

		if( isset( $_POST['atn_postype_tax_show_ui'] ) )
			update_post_meta( $post_id, 'atn_postype_tax_show_ui', esc_attr( $_POST['atn_postype_tax_show_ui'] ) );

		if( isset( $_POST['atn_postype_tax_hierarchical'] ) )
			update_post_meta( $post_id, 'atn_postype_tax_hierarchical', esc_attr( $_POST['atn_postype_tax_hierarchical'] ) );

		if( isset( $_POST['atn_postype_tax_rewrite'] ) )
			update_post_meta( $post_id, 'atn_postype_tax_rewrite', esc_attr( $_POST['atn_postype_tax_rewrite'] ) );

		if( isset($_POST['atn_postype_tax_custom_rewrite_slug']) )
			update_post_meta( $post_id, 'atn_postype_tax_custom_rewrite_slug', sanitize_text_field( $_POST['atn_postype_tax_custom_rewrite_slug'] ) );

		if( isset( $_POST['atn_postype_tax_query_var'] ) )
			update_post_meta( $post_id, 'atn_postype_tax_query_var', esc_attr( $_POST['atn_postype_tax_query_var'] ) );

		$atn_postype_tax_post_types = isset( $_POST['atn_postype_tax_post_types'] ) ? $_POST['atn_postype_tax_post_types'] : array();
			update_post_meta( $post_id, 'atn_postype_tax_post_types', $atn_postype_tax_post_types );

	} // # function save_post()

	function atn_postype_change_columns( $cols ) {

		$cols = array(
			'cb'                    => '<input type="checkbox" />',
			'title'                 => __( 'Post Type', 'custom-post-type-atn' ),
			'custom_post_type_name' => __( 'Custom Post Type Name', 'custom-post-type-atn' ),
			'icon'                 => __( 'Icon', 'custom-post-type-atn' ),
			'slug'           => __( 'Slug', 'custom-post-type-atn' ),
			'postion'           => __( 'Postion', 'custom-post-type-atn' ),
		);
		return $cols;

} // # function atn_postype_change_columns()



function atn_postype_sortable_columns() {

		return array(
			'title'                 => 'title'
		);

	} // # function atn_postype_sortable_columns()

function atn_postype_custom_columns( $column, $post_id ) {

		switch ( $column ) {
			case "custom_post_type_name":
				echo get_post_meta( $post_id, 'atn_postype_name', true);
				break;
			case "icon":
				$icon_post=get_post_meta( $post_id, 'atn_postype_icon', true);
			 if(!empty($icon_post)):
				echo '<img src="'.$icon_post.'"/>';
			 endif;
				break;
			case "slug":
				echo get_post_meta( $post_id, 'atn_postype_custom_rewrite_slug', true);
			break;
			case "postion":
				echo get_post_meta( $post_id, 'atn_postype_menu_position', true);
			break;
		}

	} // # function atn_postype_custom_columns()

function atn_postype_tax_change_columns( $cols ) {

		$cols = array(
			'cb'                    => '<input type="checkbox" />',
			'title'                 => __( 'Taxonomy', 'custom-post-type-atn' ),
			'custom_post_type_name' => __( 'Taxonomy Name', 'custom-post-type-atn' ),
			'label'                 => __( 'Label', 'custom-post-type-atn' ),
			'slug'                 => __( 'Slug', 'custom-post-type-atn' ),
			'postype'                 => __( 'Postype', 'custom-post-type-atn' )
		);
		return $cols;

	} // # function atn_postype_tax_change_columns()

function atn_postype_tax_sortable_columns() {

		return array(
			'title'                 => 'title'
		);

} // # function atn_postype_tax_sortable_columns()


function atn_postype_tax_custom_columns( $column, $post_id ) {

		switch ( $column ) {
			case "custom_post_type_name":
				echo get_post_meta( $post_id, 'atn_postype_tax_name', true);
				break;
			case "label":
				echo get_post_meta( $post_id, 'atn_postype_tax_label', true);
				break;
			case "slug":
				echo get_post_meta( $post_id, 'atn_postype_tax_custom_rewrite_slug', true);
				break;
			case "postype":
				$postype_names=get_post_meta( $post_id, 'atn_postype_tax_post_types',true);
				$group_postype="";
			   if(!empty($postype_names)):
					for($m=0;$m<count($postype_names);$m++):
						$group_postype .= $postype_names[$m].", ";
					endfor;
					echo substr($group_postype,0,-2);
				else:
					echo "";
				endif;
			break;
			
		}

	} // # function atn_postype_tax_custom_columns()

function atn_postype_admin_footer() {

		global $post_type;
		
		if( 'atn_postype' == $post_type ) {

			// Get all public Custom Post Types
			$post_types = get_post_types( array( 'public' => true, '_builtin' => false ), 'objects' );
			// Get all Custom Post Types created by Custom Post Type Atn
			$atn_postype_posts = get_posts( array( 'post_type' => 'atn_postype' ) );
			// Remove all Custom Post Types created by the Custom Post Type Atn plugin
			foreach ( $atn_postype_posts as $atn_postype_post ) {
				$values = get_post_custom( $atn_postype_post->ID );
				unset( $post_types[ $values['atn_postype_name'][0] ] );
			}

			if ( count( $post_types ) != 0 ) {
			?>
         <div id="atn_postype-cols-left">
			<div id="atn_postype-cpt-overview" class="hidden col-footer_over">
				<div id="icon-edit" class="icon32 icon32-posts-atn_postype"><br></div>
				<h2><?php _e( 'Other registered Custom Post Types', 'custom-post-type-atn' ); ?></h2>
				<table class="wp-list-table widefat fixed striped posts" cellspacing="0">
					<thead>
						<tr>
							<th scope="col" id="cb" class="manage-column column-cb check-column">
							</th>
							<th scope="col" id="title" class="manage-column column-title">
								<span><?php _e( 'Post Type', 'custom-post-type-atn' ); ?></span><span class="sorting-indicator"></span>
							</th>
							<th scope="col" id="custom_post_type_name" class="manage-column column-custom_post_type_name">
								<span><?php _e( 'Custom Post Type Name', 'custom-post-type-atn' ); ?></span><span class="sorting-indicator"></span>
							</th>
							<th scope="col" id="label" class="manage-column column-label">
								<span><?php _e( 'Icon', 'custom-post-type-atn' ); ?></span><span class="sorting-indicator"></span>
							</th>
							<th scope="col" id="description" class="manage-column column-description">
								<span><?php _e( 'Description', 'custom-post-type-atn' ); ?></span><span class="sorting-indicator"></span>
							</th>
						</tr>
					</thead>

					<tfoot>
						<tr>
							<th scope="col" class="manage-column column-cb check-column">
							</th>
							<th scope="col" class="manage-column column-title">
								<span><?php _e( 'Post Type', 'custom-post-type-atn' ); ?></span><span class="sorting-indicator"></span>
							</th>
							<th scope="col" class="manage-column column-custom_post_type_name">
								<span><?php _e( 'Custom Post Type Name', 'custom-post-type-atn' ); ?></span><span class="sorting-indicator"></span>
							</th>
							<th scope="col" class="manage-column column-label">
								<span><?php _e( 'Icon', 'custom-post-type-atn' ); ?></span><span class="sorting-indicator"></span>
							</th>
							<th scope="col" class="manage-column column-description">
								<span><?php _e( 'Description', 'custom-post-type-atn' ); ?></span><span class="sorting-indicator"></span>
							</th>
						</tr>
					</tfoot>

					<tbody id="the-list">
						<?php
							// Create list of all other registered Custom Post Types
							foreach ( $post_types as $post_type ) {
								?>
						<tr valign="top">
							<th scope="row" class="check-column">
							</th>
							<td class="post-title page-title column-title">
								<strong><?php echo $post_type->labels->name; ?></strong>
							</td>
							<td class="custom_post_type_name column-custom_post_type_name"><?php echo $post_type->name; ?></td>
							<td class="label column-label">
                            <?php if(!empty($post_type->menu_icon)): ?>
							  		<img src="<?php echo $post_type->menu_icon; ?>" />
                             <?php endif; ?>
                            </td>
							<td class="description column-description"><?php echo $post_type->description; ?></td>
						</tr>
								<?php
							}

							if ( count( $post_types ) == 0 ) {
								?>
						<tr class="no-items"><td class="colspanchange" colspan="5"><?php _e( 'No Custom Post Types found' , 'custom-post-type-atn' ); ?>.</td></tr>
								<?php
							}
						?>
					</tbody>
				</table>

				<div class="tablenav bottom">
					<div class="tablenav-pages one-page">
						<span class="displaying-num">
							<?php
							$count = count( $post_types );
							printf( _n( '%d item', '%d items', $count ), $count );
							?>
						</span>
						<br class="clear">
					</div>
				</div>

			</div>
          </div>
			<?php
			}
		}
		if( 'atn_postype_tax' == $post_type ) {

			// Get all public custom Taxonomies
			$taxonomies = get_taxonomies( array( 'public' => true, '_builtin' => false ), 'objects' );
			// Get all custom Taxonomies created by Custom Post Type Atn
			$atn_postype_tax_posts = get_posts( array( 'post_type' => 'atn_postype_tax' ) );
			// Remove all custom Taxonomies created by the Custom Post Type Atn plugin
			foreach ( $atn_postype_tax_posts as $atn_postype_tax_post ) {
				$values = get_post_custom( $atn_postype_tax_post->ID );
				unset( $taxonomies[ $values['atn_postype_tax_name'][0] ] );
			}

			if ( count( $taxonomies ) != 0 ) {
			?>
          <div id="atn_postype-cols-left">
			<div id="atn_postype-cpt-overview" class="hidden ">
				<div id="icon-edit" class="icon32 icon32-posts-atn_postype"><br></div>
				<h2><?php _e( 'Other registered custom Taxonomies', 'custom-post-type-atn' ); ?></h2>
				<table class="wp-list-table widefat fixed striped posts" cellspacing="0">
					<thead>
						<tr>
							<th scope="col" id="cb" class="manage-column column-cb check-column">
							</th>
							<th scope="col" id="title" class="manage-column column-title">
								<span><?php _e( 'Taxonomy', 'custom-post-type-atn' ); ?></span><span class="sorting-indicator"></span>
							</th>
							<th scope="col" id="custom_post_type_name" class="manage-column column-custom_taxonomy_name">
								<span><?php _e( 'Custom Taxonomy Name', 'custom-post-type-atn' ); ?></span><span class="sorting-indicator"></span>
							</th>
							<th scope="col" id="label" class="manage-column column-label">
								<span><?php _e( 'Label', 'custom-post-type-atn' ); ?></span><span class="sorting-indicator"></span>
							</th>
						</tr>
					</thead>

					<tfoot>
						<tr>
							<th scope="col" class="manage-column column-cb check-column">
							</th>
							<th scope="col" class="manage-column column-title">
								<span><?php _e( 'Taxonomy', 'custom-post-type-atn' ); ?></span><span class="sorting-indicator"></span>
							</th>
							<th scope="col" class="manage-column column-custom_post_type_name">
								<span><?php _e( 'Custom Taxonomy Name', 'custom-post-type-atn' ); ?></span><span class="sorting-indicator"></span>
							</th>
							<th scope="col" class="manage-column column-label">
								<span><?php _e( 'Label', 'custom-post-type-atn' ); ?></span><span class="sorting-indicator"></span>
							</th>
						</tr>
					</tfoot>

					<tbody id="the-list">
						<?php
							// Create list of all other registered Custom Post Types
							foreach ( $taxonomies as $taxonomy ) {
								?>
						<tr valign="top">
							<th scope="row" class="check-column">
							</th>
							<td class="post-title page-title column-title">
								<strong><?php echo $taxonomy->labels->name; ?></strong>
							</td>
							<td class="custom_post_type_name column-custom_post_type_name"><?php echo $taxonomy->name; ?></td>
							<td class="label column-label"><?php echo $taxonomy->labels->name; ?></td>
						</tr>
								<?php
							}

							if ( count( $taxonomies ) == 0 ) {
								?>
						<tr class="no-items"><td class="colspanchange" colspan="4"><?php _e( 'No custom Taxonomies found' , 'custom-post-type-atn' ); ?>.</td></tr>
								<?php
							}
						?>
					</tbody>
				</table>

				<div class="tablenav bottom">
					<div class="tablenav-pages one-page">
						<span class="displaying-num">
							<?php
							$count = count( $taxonomies );
							printf( _n( '%d item', '%d items', $count ), $count );
							?>
						</span>
						<br class="clear">
					</div>
				</div>
               </div>
			</div>
			<?php
			}
		}

} // # function atn_postype_admin_footer()

function atn_postype_post_updated_messages( $messages ) {
	global $post, $post_ID;
	$messages['atn_postype' ] = array(
			0 => '', // Unused. Messages start at index 1.
			1 => __( 'Custom Post Type updated.', 'custom-post-type-atn' ),
			2 => __( 'Custom Post Type updated.', 'custom-post-type-atn' ),
			3 => __( 'Custom Post Type deleted.', 'custom-post-type-atn' ),
			4 => __( 'Custom Post Type updated.', 'custom-post-type-atn' ),
			/* translators: %s: date and time of the revision */
			5 => isset($_GET['revision']) ? sprintf( __( 'Custom Post Type restored to revision from %s', 'custom-post-type-atn' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6 => __( 'Custom Post Type published.', 'custom-post-type-atn' ),
			7 => __( 'Custom Post Type saved.', 'custom-post-type-atn' ),
			8 => __( 'Custom Post Type submitted.', 'custom-post-type-atn' ),
			9 => __( 'Custom Post Type scheduled for.', 'custom-post-type-atn' ),
			10 => __( 'Custom Post Type draft updated.', 'custom-post-type-atn' ),
		);
  return $messages;
} // # function atn_postype_post_updated_messages()



function shortcode_showSlider($attr){
	extract(shortcode_atts(array(
        'slug' => 'index-slishow',
		'option'=>'0',
		'width'=>'980',
		"height"=>'400',
		'order'=>'',
		'orderby'=>''
		
    ), $attr));
	global $wpdb;
	$orderby=$attr['orderby'];
	$orderType=$attr['order'];
	$width=$attr['width'];
	$height=$attr['height'];
	$option=$attr['option'];
	$list_item[]=array();
	if(empty($orderType)):
		$order="DESC";
	else:
		$order="ASC";
	endif;
	switch($orderby)
	{
		case "order":
			$order_query="`A`.`order` ".$order;
		break;
		case "date":
			$order_query="`A`.`created` ".$order;
		break;
		default:
			$order_query="`A`.`created` ".$order;
		break;
	}
	$data_imgs = $wpdb->get_results("SELECT * FROM " .$wpdb->prefix ."tdr_image `A`
INNER JOIN `".$wpdb->prefix."tdr_gallery_img` `B` ON `A`.`slider_id`=`B`.`slider_id`
INNER JOIN `".$wpdb->prefix."tdr_gallery` `C` ON `B`.`gallery_id`=`C`.`gallery_id` WHERE 
`C`.`slug_gallery`='".$attr['slug']."'
 ORDER BY ".$order_query);
 
 if(empty($data_imgs)):
	return 'Slug='.$attr['slug'].' gallery does not exist'; 
	else:
		foreach($data_imgs as $data_img):
			$img_url=$data_img->image_url;
			if($option==0):
				$image_resize = aq_resize( $img_url, $width,$height, true );
				if(empty($image_resize)):
					$urlImages=$img_url;
				else:
					$urlImages=$image_resize;
				endif;
			else:
				$urlImages=$img_url;
			endif;
				
			
			array_push($list_item,array(
				"id"=> $data_img->slider_id,
				"title" => $data_img->title,
				"url_path_full" => $data_img->image_url,
				"url_path_resize" => $urlImages,
				"alt" => $data_img->alt,
				"use_link" => $data_img->uselink,
				"link" => $data_img->link,
				"target" => $data_img->linktarget,
				"onclick" => $data_img->onclick,
				"description" => $data_img->description,
				"bg" =>$data_img->slider_bg,
				"width" => $width,
				"height" => $height,
				"id_gallery"=> $data_img->gallery_id,
				"title_gallery"=> $data_img->title_gallery
			));
		endforeach;
		return json_encode($list_item);
		//return $list_item;
	endif;
}	
add_shortcode('tdrSlider', 'shortcode_showSlider');



