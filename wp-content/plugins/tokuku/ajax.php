<?php
/*
Plugin Name: AJAX data
Description: ajax dữ liệu
Version: 1.0
Author: hungtt
Author URI: http://facebook.com/HungSmurf
*/

/*
 @ ajax_pagination_scripts()
 @ Nhúng file ajax-pagination.js vào theme
 */
add_action( 'wp_enqueue_scripts', 'ajax_pagination_scripts' );
function ajax_pagination_scripts() {
    /*
     * Chèn file ajax-pagination.js vào frontend
     */
    wp_enqueue_script( 'ajax-data-script', plugins_url( get_template_directory_uri() .'/tokuku/js/ajax/ajaxdata.js', __FILE__ ),
        array( 'jquery' )
    );
}
