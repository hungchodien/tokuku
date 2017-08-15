<?php
	/*
		Author: Minh.nguyen250385@gmail.com
	*/
	global $wpdb;
	$table_gallery = $wpdb->prefix."tdr_gallery";
	$table_img = $wpdb->prefix ."tdr_image";
	$table_join_gallery_img = $wpdb->prefix."tdr_gallery_img";
	$sql="";
	if($wpdb->get_var("SHOW TABLES LIKE '$table_gallery'") != $table_gallery){
		$sql = "CREATE TABLE $table_gallery (
		  `gallery_id` int UNSIGNED PRIMARY KEY NOT NULL auto_increment,
		  `title_gallery` varchar(255),
		  `slug_gallery` varchar(255),
		  `created` datetime,
		  `modified` datetime,
		  `status` int default '0'
		)CHARACTER SET utf8 COLLATE utf8_general_ci;";
	}
	
	if($wpdb->get_var("SHOW TABLES LIKE '$table_img'") != $table_img){
		$sql.= "CREATE TABLE $table_img (
		  `slider_id` int UNSIGNED PRIMARY KEY NOT NULL auto_increment,
		  `title` varchar(255),
		  `description` varchar(1000),
		  `image_url` varchar(1000),
		  `image_url_mobile` NVARCHAR(1000),
		  `slider_bg` NVARCHAR(1000),
		  `alt` NVARCHAR(1000),
		  `uselink` varchar(1) default 'N',
		  `linktarget` varchar(20),
		  `link` varchar(1000),
		  `onclick` varchar(1000),
		  `order` int(11),
		  `created` datetime,
		  `modified` datetime,
		  `status` int default '0'
		)CHARACTER SET utf8 COLLATE utf8_general_ci;";
	}
	if($wpdb->get_var("SHOW TABLES LIKE '$table_join_gallery_img'") != $table_join_gallery_img){
		$sql.= "CREATE TABLE $table_join_gallery_img (
		  `id` int UNSIGNED PRIMARY KEY NOT NULL auto_increment,
		  `slider_id` int,
		  `gallery_id` int,
		  `created` datetime,
		  `modified` datetime,
		  `status` int default '0'
		)CHARACTER SET utf8 COLLATE utf8_general_ci;";
	}
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);
	
	