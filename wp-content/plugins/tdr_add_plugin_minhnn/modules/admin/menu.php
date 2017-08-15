<?php 
	/*
	  Author:Minh Nguyen @2015
	  Email: minh.nguyen250385@gmail.com
	*/
add_action( 'init','atn_postype_create_custom_post_types');
add_action( 'add_meta_boxes','atn_postype_create_meta_boxes');
add_action( 'save_post','atn_postype_save_post');
add_action( 'manage_posts_custom_column','atn_postype_custom_columns', 10, 2);
add_action( 'manage_posts_custom_column','atn_postype_tax_custom_columns', 10, 2);
add_action( 'admin_footer','atn_postype_admin_footer');
//add_action( 'wp_prepare_attachment_for_js','wp_prepare_attachment_for_js', 10, 3);
// filters
add_filter( 'manage_atn_postype_posts_columns','atn_postype_change_columns');
add_filter( 'manage_edit-atn_postype_sortable_columns','atn_postype_sortable_columns');
add_filter( 'manage_atn_postype_tax_posts_columns','atn_postype_tax_change_columns');
add_filter( 'manage_edit-atn_postype_tax_sortable_columns','atn_postype_tax_sortable_columns');
add_filter( 'post_updated_messages','atn_postype_post_updated_messages');
// set textdomain
load_plugin_textdomain( 'atn_postype', false, basename( dirname(__FILE__) ).'/lang' );	
add_action( 'admin_menu', 'register_add_menu_add_to_tdr' );
function register_add_menu_add_to_tdr(){
 add_menu_page( 'Tokyodesignroom', 'TDR All In One', 'manage_options', 'atn_minnn', 'atn_minnn',IF_PLUGIN_TDR_MINHNN_HOME_DIR.'/img/auto_get_news_minhnn.png');
 add_submenu_page('atn_minnn',__('Setting TDR'),'Setting TDR','manage_options', 'atn_minnn','atn_minnn');
 add_submenu_page('atn_minnn',__('Postype TDR','TDR'), __('Postype TDR','custom-post-type-atn'),'manage_options', 'edit.php?post_type=atn_postype');
 add_submenu_page( 'atn_minnn', __('Taxonomies TDR', 'custom-post-type-atn' ), __('Taxonomies TDR', 'custom-post-type-atn' ), 'manage_options','edit.php?post_type=atn_postype_tax');
 add_submenu_page( 'atn_minnn', __('Slishow TDR', 'slishow-atn' ), __('Slishow TDR', 'slishow-atn' ), 'manage_options','slishow_atn','slishow_atn');
 add_submenu_page( 'atn_minnn_hide', __('Slishow Gallery TDR', 'slishow-atn' ), __('Slishow Gallery TDR', 'slishow-atn' ), 'manage_options','slishow_atn_galleries','slishow_atn_galleries');

 //add_submenu_page('atn_minnn',__('Gallery TDR'),'Gallery TDR','manage_options', 'atn_gallert','atn_gallert');
}

// let's start by enqueuing our styles correctly
function wptuts_admin_add_to_tdr_css() {
	
    wp_register_style( 'wptuts_admin_tdr_img_css', IF_PLUGIN_TDR_MINHNN_HOME_DIR.'/css/style.css');
	wp_enqueue_style( 'wptuts_admin_tdr_img_css' );
	wp_enqueue_style('thickbox');
	wp_register_style( 'jquery_ui_css', IF_PLUGIN_TDR_MINHNN_HOME_DIR.'/css/jquery-ui.css');
	wp_enqueue_style( 'jquery_ui_css' );
	wp_register_style( 'colorbox_css', IF_PLUGIN_TDR_MINHNN_HOME_DIR.'/css/colorbox.css');
	wp_enqueue_style( 'colorbox_css' );
	
	wp_register_style( 'jquery_confirm_css', IF_PLUGIN_TDR_MINHNN_HOME_DIR.'/css/jquery.confirm.css');
	wp_enqueue_style( 'jquery_confirm_css' );
}
function wptuts_admin_add_to_tdr_scripts() 
{
 
		 wp_enqueue_script('jquery');
		 wp_enqueue_script('media-upload');
		 wp_enqueue_script('thickbox');
		 wp_register_script('media-admin-scrip', IF_PLUGIN_TDR_MINHNN_HOME_DIR.'/js/media-admin-script.js', array('jquery','media-upload','thickbox'));
		 wp_enqueue_script('media-admin-scrip');
		 
		 wp_register_script('jQuery_toolTip_js', IF_PLUGIN_TDR_MINHNN_HOME_DIR.'/js/jQuery.toolTip.js', array('jquery'));
		 wp_enqueue_script('jQuery_toolTip_js');
		 
		 wp_register_script('colorbox_js', IF_PLUGIN_TDR_MINHNN_HOME_DIR.'/js/colorbox.js', array('jquery'));
		 wp_enqueue_script('colorbox_js');
		 
		 wp_register_script('jquery_lightbox_min', IF_PLUGIN_TDR_MINHNN_HOME_DIR.'/js/jquery.lightbox.min.js', array('jquery'));
		 wp_enqueue_script('jquery_lightbox_min');
	
		 wp_register_script('jquery_confirm_js', IF_PLUGIN_TDR_MINHNN_HOME_DIR.'/js/jquery.confirm.js', array('jquery'));
		 wp_enqueue_script('jquery_confirm_js');
}
add_action('admin_print_scripts', 'wptuts_admin_add_to_tdr_scripts');
add_action( 'admin_enqueue_scripts', 'wptuts_admin_add_to_tdr_css' );
function atn_minnn(){
	require_once IF_PLUGIN_TDR_MINHNN_MODULES_DIR.'/admin/setting.php';
}
function slishow_atn(){
	require_once IF_PLUGIN_TDR_MINHNN_MODULES_DIR.'/admin/slishow/manage_img.php';
}
function slishow_atn_galleries(){
	require_once IF_PLUGIN_TDR_MINHNN_MODULES_DIR.'/admin/slishow/manage_galleries.php';
}