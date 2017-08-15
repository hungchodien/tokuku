<?php
	ob_start();
	@ini_set('log_errors', 1);
    @ini_set('display_errors', 0); 
/*
Plugin Name: TDR All In One Plugin 
Plugin URI: http://www.tokyodesignroom.com
Description: As plugin development project writing practice, continuously improving, developed by minh.nguyen use tokyodesignroom ..... 
Version: 1.0
Author: minh.nguyen250385@gmail.com
Author URI: http://www.tokyodesignroom.com
Text Domain: Tokyodesignroom
License: GPLv2 or later
Copyright 2015 Minh Nguyen
defined('IF_VERSION','1.0');*/
$atc_plugin_name="tdr_add_plugin_minhnn";

if ( ! defined( 'TDR_PLUGIN_NAME' ) )
    define( 'TDR_PLUGIN_NAME', $atc_plugin_name );

if ( ! defined( 'WP_CONTENT_URL' ) )
    define( 'WP_CONTENT_URL', site_url() . '/wp-content' );
if ( ! defined( 'WP_ADMIN_URL' ) )
    define( 'WP_ADMIN_URL', site_url() . '/wp-admin' );

if ( ! defined( 'WP_CONTENT_DIR' ) )
    define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );

if ( ! defined( 'WP_PLUGIN_URL' ) )
    define( 'WP_PLUGIN_URL', WP_CONTENT_URL. '/plugins' );

if ( ! defined( 'WP_PLUGIN_DIR' ) )
    define( 'WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins' );

if ( ! defined( 'IF_PLUGIN_TDR_MINHNN_BASENAME' ) )
	define( 'IF_PLUGIN_TDR_MINHNN_BASENAME', plugin_basename( __FILE__ ) );

if ( ! defined( 'IF_PLUGIN_TDR_MINHNN_DIR' ) )
    define( 'IF_PLUGIN_TDR_MINHNN_DIR', plugin_dir_path( __FILE__ ) );

if ( ! defined( 'IF_PLUGIN_TDR_MINHNN_URL' ) )
    define( 'IF_PLUGIN_TDR_MINHNN_URL', untrailingslashit( plugins_url( '', __FILE__ ) ) );

if ( ! defined( 'IF_PLUGIN_TDR_MINHNN_MODULES_DIR' ) )
    define( 'IF_PLUGIN_TDR_MINHNN_MODULES_DIR', IF_PLUGIN_TDR_MINHNN_DIR . '/modules' );
	

if ( ! defined( 'IF_PLUGIN_TDR_MINHNN_INCLUDES_DIR' ) )
    define( 'IF_PLUGIN_TDR_MINHNN_INCLUDES_DIR', IF_PLUGIN_TDR_MINHNN_DIR . '/inc' );

if ( ! defined( 'IF_PLUGIN_TDR_MINHNN_HOME_DIR' ) )
    define( 'IF_PLUGIN_TDR_MINHNN_HOME_DIR', site_url() . '/wp-content/plugins/'.$atc_plugin_name );
	
if ( ! defined( 'IF_PLUGIN_TDR_MINHNN_CSS_DIR' ) )
    define( 'IF_PLUGIN_TDR_MINHNN_CSS_DIR', IF_PLUGIN_TDR_MINHNN_HOME_DIR . '/css' );
	
if ( ! defined( 'IF_PLUGIN_TDR_MINHNN_JS_DIR' ) )
    define( 'IF_PLUGIN_TDR_MINHNN_JS_DIR', IF_PLUGIN_TDR_MINHNN_HOME_DIR . '/js' );	
	
if ( ! defined( 'IF_PLUGIN_TDR_MINHNN_ADMIN_DIR' ) )
    define( 'IF_PLUGIN_TDR_MINHNN_ADMIN_DIR', admin_url(). 'admin.php' );
	
require_once IF_PLUGIN_TDR_MINHNN_MODULES_DIR . '/admin/menu.php';
// install Database TDR_MINHNN
require_once IF_PLUGIN_TDR_MINHNN_INCLUDES_DIR.'/function.php';
require_once IF_PLUGIN_TDR_MINHNN_INCLUDES_DIR.'/short_code.php';
require_once IF_PLUGIN_TDR_MINHNN_INCLUDES_DIR.'/install_db.php';
