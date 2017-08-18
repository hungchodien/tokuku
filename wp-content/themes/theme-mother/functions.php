<?php


function xulidulieuAreaNganhCompany() {
    if(isset($_POST['action'])){
        $action = $_POST['action'];
        $name_group = $_POST['name_group'];
        $type_option = $_POST['type_option'];
        $id = $_POST['id'];
        $data_slug = $_POST['data-slug'];
         ////truy vấn đưa ra 3 loại dữ liệu
        /// nếu là area : nganh + company
        /// nếu company : -> lọc các company thuộc nganh + lọc các area trong company.
        /// nếu bấm vào company chuyển trang.
        ///
        if($type_option == 'area'){
            if($id == -1 ){
                $args = array(
                    'post_type' => 'cong-ty',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'tourirt-tokuku-category',
                            'operator' => 'EXISTS'
                        ),
                    ),
                );
                $query = new WP_Query( $args );
                $strCompany_return = '<option value="-1"> chọn vùng</option>';
                foreach ($query->posts as $key => $value){
                    $strCompany_return .= '<option class="ajax-none-company" value = "'.get_permalink( $value->ID).'">'.
                            $value->post_title." </option>";
                }





                ///load all area
                $terms = get_terms( array(
                    'taxonomy' => 'tourirt-tokuku-category',
                    'hide_empty' => false,  ) );
                $strNganh_return = "<option value=\"-1\"> chọn ngành</option>";
                foreach($terms as $key => $term){
                    $strNganh_return .= "<option class='ajax-nganh' data-id-area='$term->term_id' value='$term->term_id'> "
                        .$term->name." </option>";
                }



                $data_retrun = array( "congty" => $strCompany_return , "nganh" => $strNganh_return);
                echo json_encode($data_retrun);
                //echo $loop_area->request;


            }else {
                /// b1: area
                $args = array(
                    'post_type' => 'cong-ty',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'tourirt-tokuku-area',
                            'field' => 'id',
                            'terms' => $id,
                            'operator' => 'in'
                        ),
                    ),
                );
                $loop_area = new WP_Query($args);
                $id_company_arr = array();
                $strCompany_return = '';
                if($loop_area->have_posts()){
                    $key = 0;
                    while ($loop_area->have_posts()){
                        $loop_area->the_post();
                        $strCompany_return .= '<option class="ajax-none-company" value = "'.get_permalink( get_the_ID()).'">'
                            .$loop_area->post->post_title."</option>";
                        array_push($id_company_arr , $loop_area->post->ID);
                        $key++;
                    }
                }
                $nganh_arr = array();
                foreach ($id_company_arr as $values ){
                    $nganh = get_the_terms($values, 'tourirt-tokuku-category' );
                    foreach ($nganh as $item){
                        array_push($nganh_arr , array( $item->term_id , $item->slug , 1));
                    }
                }
                $strNganh_return = '';
                foreach ($nganh_arr as $key => $item ){
                    ///kierm tra trung
                    ///kieemr tra trungf
                    for ($keyh = 0 ; $keyh < $key ; $keyh++){
                        if($nganh_arr[$keyh][0] == $nganh_arr[$key][0]){
                            $item[2] = 0;
                            break;
                        }
                    }
                    if($item[2] != 0){
                        $strNganh_return .= "<option class='ajax-nganh' data-id-area='$item[0]' value='$item[0]'> 
                                        $item[1]
                                    </option>";
                    }
                }
                $data_retrun = array( "congty" => $strCompany_return , "nganh" => $strNganh_return);
                echo json_encode($data_retrun);
                //echo $loop_area->request;
            }
        }
        else {
            if($type_option == "nganh"){
                /// b1: area
                $args = array(
                    'post_type' => 'cong-ty',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'tourirt-tokuku-category',
                            'field' => 'id',
                            'terms' => $_POST['id_nganh'],
                            'operator' => 'in'
                        )
                    ),
                );
                if($_POST['id_nganh'] == -1){
                    $args = array(
                        'post_type' => 'cong-ty',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'tourirt-tokuku-category',
                                'operator' => 'EXISTS'
                            ),
                        ),
                    );
                }
                $loop_nganh = new WP_Query($args);
                $id_company_arr = array();
                $strCompany_return = '';
                if($loop_nganh->have_posts()){
                    $key = 0;
                    while ($loop_nganh->have_posts()){
                        $loop_nganh->the_post();

                        ///kieemr tra cais posst nayf cos taxolomi area khoong
                        /// neeus cos xem cos cais naof trungf id thif laays
                        if($_POST['id_area'] != -1){
                            $kiemtratontai = has_term( $_POST['id_area'], 'tourirt-tokuku-area', $loop_nganh->post->ID );
                            if($kiemtratontai)
                                $strCompany_return .= '<option class="ajax-none-company" value = "'.get_permalink( get_the_ID()).'">'
                                    .$loop_nganh->post->post_title."</option>";
                        }else {
                            $strCompany_return .= '<option class="ajax-none-company" value = "'.get_permalink( get_the_ID()).'">'
                            .$loop_nganh->post->post_title."</option>";
                        }
                        array_push($id_company_arr , $loop_nganh->post->ID);
                        $key++;
                    }
                }
                $data_retrun = array( "congty" => $strCompany_return );
                echo json_encode($data_retrun);
                //echo $loop_area->request;
            }
        }
    }else {
        echo "hung";
    }
    die();
}
add_action('wp_ajax_getdata_ajax', 'xulidulieuAreaNganhCompany');
add_action('wp_ajax_nopriv_getdata_ajax', 'xulidulieuAreaNganhCompany');


//if ( ! function_exists( 'aq_resize' ) ) {
    //include( get_template_directory() . '/inc/aq_rezise.php' );
	require_once('inc/aq_resizer.php');
//}
if ( ! function_exists( 'theme_setup' ) ) :
	function theme_setup() {
		load_theme_textdomain( 'wpTDR', get_template_directory() . '/languages' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
	// This theme uses wp_nav_menu() in two locations.
		register_nav_menus( array(
		    'menu-pc-3-infor' => __('menu pc 3 infor','wpTDR'),
			'top-menu' => __('Top Menu','wpTDR'),
			'footer-menu1' => __('Footer Menu 1','wpTDR'),
			'footer-menu2' => __('Footer Menu 2','wpTDR'),
		));
		
		add_theme_support( 'html5', array(
			'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
		));
		add_theme_support( 'post-formats', array(
			'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
		));
		$default_color="#FFF";
	//$default_color = trim( $color_scheme[0], '#' );

		// Setup the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'twentyfifteen_custom_background_args', array(
			'default-color'      => $default_color,
			'default-attachment' => 'fixed',
		)));
	}
endif; // setup theme

add_action( 'after_setup_theme', 'theme_setup' );
// post thumbnail support
	if ( function_exists( 'add_image_size' ) ) add_theme_support( 'post-thumbnails' );

	/*if ( function_exists( 'add_image_size' ) ) {
		//add_image_size( 'loop_thumb', 600, 392, true );
		//add_image_size( 'detail_thumb', 600, 296, true );
	}*/

function wpTDR_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Widget Area', 'twentyfifteen' ),
		'id'            => 'sidebar-theme',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'twentyfifteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar(array(
        'name' => __('Widget Page', 'page'),
        'id' => 'sidebar-page',
        'description' => __('Widget Page', ''),
        'before_widget' => '<div class="widget-page clear">',
        'after_widget' => '</div>',
        'before_title' => '<div class="tab-page-sidebar">',
        'after_title' => '</div>',
    ));
}
add_action( 'widgets_init', 'wpTDR_widgets_init' );
	
function wpTDR_scripts() {
	//wp_enqueue_style( 'wpTDR-fonts', wpTDR_fonts_url(), array(), null );
	wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/css/bootstrap.min.css' );
	wp_enqueue_style( 'awsome-font-css', get_template_directory_uri() . '/css/font-awesome.min.css' );
	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'),true );
	wp_enqueue_script('lazyload_min-js', get_template_directory_uri() . '/js/jquery.lazyload.min.js', array('jquery'), true);
	wp_enqueue_script('lazyscript_min-js', get_template_directory_uri() . '/js/jquery.lazyscript.min.js', array('jquery'), true);
	wp_enqueue_script('nivoslider-js', get_template_directory_uri() . '/js/jquery.nivo.slider.js', array('jquery'), true);
	wp_enqueue_script('waypoints-js', get_template_directory_uri() . '/js/jquery.waypoints.min.js', array('jquery'), true);
	wp_enqueue_style( 'jquery-sidr-dark-css', get_template_directory_uri() . '/css/jquery.sidr.dark.css' );
	wp_enqueue_style( 'owl-carousel-css', get_template_directory_uri() . '/css/owl.carousel.css' );
	wp_enqueue_script('owl-carousel-js', get_template_directory_uri() . '/js/owl.carousel.js', array('jquery'), true);
	wp_enqueue_style( 'wpTDR-style', get_stylesheet_uri() );
	wp_enqueue_script('jquery-sidr-min-js', get_template_directory_uri() . '/js/jquery.sidr.min.js', array('jquery'), true);
	wp_enqueue_style( 'nivoslider-css', get_template_directory_uri() . '/css/nivo-slider.css' );
	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'support-style-ie', get_template_directory_uri() . '/css/ie.css', array( 'wpTDR-style' ), '20141010' );
	wp_style_add_data( 'support-style-ie', 'conditional', 'lt IE 9' );
	wp_enqueue_script('jquery.main.js', get_template_directory_uri() . '/js/jquery.main.js', array('jquery'), true);
}
add_action( 'wp_enqueue_scripts', 'wpTDR_scripts' );
function mnn_search_form($form ) {
	$form = '<form role="search" method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
	<div class="clear form_search_inc">
	<input type="text" value="' . get_search_query() . '" name="s" id="s" />
	<button type="submit" id="searchsubmit"  value="'. esc_attr__( 'Search' ) .'">
		<i class="fa fa-search fa-2"></i></button>
	</div>
</form>';
	return $form;
}
add_filter( 'get_search_form', 'mnn_search_form' );
function taxonomy_news_queries( $query ) {
	 
    // not an admin page and it is the main query
    if (!is_admin() && $query->is_main_query()){
		//$query->set( 'post_type', 'blogs' );
        if(is_tax('news-category') ){
			$query->set('posts_per_page',1);
        }
		 if(is_tax('events-category') ){
			//$query->set( 'post_type', 'events' );
			$query->set('posts_per_page',1);
        }
		 
		
    }
}
add_action( 'pre_get_posts', 'taxonomy_news_queries' );


function getThumbnailUrl($postID) {
	$imgID = get_post_thumbnail_id($postID); // l?y id c?a hình
	$arrImages = wp_get_attachment_image_src($imgID, false, false); // l?y link hình featured
	return $arrImages[0]; // 0: link hình ; 1: width ; 2: height
}
function resizeThumnail($postID,$width,$height,$class="",$alt="") {
	$src = wp_get_attachment_url( get_post_thumbnail_id($postID));
	if(empty($src)):
		$src =  getThumbnailUrl($postID);
	endif;
	$image = aq_resize( $src, $width,$height, true );
	echo '<img class="lazy '.$class.'" src="'.$image.'" width="'.$width.'" height="'.$height.'"  alt="' . $alt . '" />';
}
function resizeImagesUrl($src,$width,$height,$class="",$alt="") {
	$image = aq_resize( $src, $width,$height, true );
	echo '<img class="lazy '.$class.'" src="'.$image.'" width="'.$width.'" height="'.$height.'"  alt="' . $alt . '" />';
}

function template_chooser($template)   
{    
	 global $wp_query;   
	$post_type = get_query_var('post_type');   
	if( $wp_query->is_search && $post_type == 'products' )   
	{
		return locate_template('archive-search.php');  //  redirect to archive-search.php
	}   
return $template;   
}
add_filter('template_include', 'template_chooser');  

class CSS_Menu_Maker_Walker extends Walker {
	var $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul>\n";
	}
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";
	}
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$class_names = $value = ''; 
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		/* Add active class */
		if(in_array('current-menu-item', $classes)) {
			$classes[] = 'active';
			unset($classes['current-menu-item']);
		}
		/* Check for children */
		$children = get_posts(array('post_type' => 'nav_menu_item', 'nopaging' => true, 'numberposts' => 1, 'meta_key' => '_menu_item_menu_item_parent', 'meta_value' => $item->ID));
		if (!empty($children)) {
			$classes[] = 'has-sub';
		}
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
		$output .= $indent . '<li' . $id . $value . $class_names .'>';
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'><span>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</span></a>';
		$item_output .= $args->after;
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
	function end_el( &$output, $item, $depth = 0, $args = array() ) {
		$output .= "</li>\n";
	}

}


add_action( 'init', 'add_excerpts_to_pages' );
function add_excerpts_to_pages() {
	add_post_type_support( 'page', 'excerpt' );
}
function wt_get_content_by_page_name($page_name)
{
	global $wpdb;
	$page_name_content = $wpdb->get_var("SELECT post_content FROM $wpdb->posts WHERE post_name = '".$page_name."'");
	return $page_name_content;
}
function wt_get_permalink_by_name($page_name)
{
	global $post;
	global $wpdb;
	$pageid_name = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '".$page_name."'");
	return get_permalink($pageid_name);
}
if( !function_exists( 'wp_get_post_type_link' )  ){
    function wp_get_post_type_link($post_type ){

        global $wp_rewrite; 

        if ( ! $post_type_obj = get_post_type_object( $post_type ) )
            return false;

        if ( get_option( 'permalink_structure' ) && is_array( $post_type_obj->rewrite ) ) {

            $struct = $post_type_obj->rewrite['slug'] ;
            if ( $post_type_obj->rewrite['with_front'] )
                $struct = $wp_rewrite->front . $struct;
            else
                $struct = $wp_rewrite->root . $struct;

            $link = home_url( user_trailingslashit( $struct, 'post_type_archive' ) );       

        } else {
            $link = home_url( '?post_type=' . $post_type );
        }

        return apply_filters( 'the_permalink', $link );
    }
}
//attach our function to the wp_pagenavi filter
add_filter( 'wp_pagenavi', 'ik_pagination', 10, 2 );
//customize the PageNavi HTML before it is output
function ik_pagination($html) {
    $out = '';
  
    //wrap a's and span's in li's
    $out = str_replace("<div","",$html);
    $out = str_replace("class='wp-pagenavi'>","",$out);
    $out = str_replace("<a","<li><a",$out);
    $out = str_replace("</a>","</a></li>",$out);
    $out = str_replace("<span","<li><span",$out);  
    $out = str_replace("</span>","</span></li>",$out);
    $out = str_replace("</div>","",$out);
  
    return '<ul class="pagination pagination-centered">'.$out.'</ul>';
}
 // encoding: utf-8
/*  Copyright 2008  Qian Qin  (email : mail@qianqin.de)
	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.
	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.
	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
/* qTranslate Widget */
class qTranslateWidget extends WP_Widget {
    function qTranslateWidget() {
        $widget_ops = array('classname' => 'widget_qtranslate', 'description' => __('Allows your visitors to choose a Language.','qtranslate') );
        $this->WP_Widget('qtranslate', __('qTranslate Language Chooser','qtranslate'), $widget_ops);
    }

    function widget($args, $instance) {
        extract($args);

        echo $before_widget;
        $title = empty($instance['title']) ? __('Language', 'qtranslate') : apply_filters('widget_title', $instance['title']);
        $hide_title = empty($instance['hide-title']) ? false : 'on';
        $type = $instance['type'];
        if($type!='text'&&$type!='image'&&$type!='both'&&$type!='dropdown') $type='text';
        if($hide_title!='on') { echo $before_title . $title . $after_title; };
        qtrans_generateLanguageSelectCode($type, $this->id);
        echo $after_widget;
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        if(isset($new_instance['hide-title'])) $instance['hide-title'] = $new_instance['hide-title'];
        $instance['type'] = $new_instance['type'];
        return $instance;
    }

    function form($instance) {
        $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'hide-title' => false, 'type' => 'text' ) );
        $title = $instance['title'];
        $hide_title = $instance['hide-title'];
        $type = $instance['type'];
        ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'qtranslate'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
        <p><label for="<?php echo $this->get_field_id('hide-title'); ?>"><?php _e('Hide Title:', 'qtranslate'); ?> <input type="checkbox" id="<?php echo $this->get_field_id('hide-title'); ?>" name="<?php echo $this->get_field_name('hide-title'); ?>" <?php echo ($hide_title=='on')?'checked="checked"':''; ?>/></label></p>
        <p><?php _e('Display:', 'qtranslate'); ?></p>
        <p><label for="<?php echo $this->get_field_id('type'); ?>1"><input type="radio" name="<?php echo $this->get_field_name('type'); ?>" id="<?php echo $this->get_field_id('type'); ?>1" value="text"<?php echo ($type=='text')?' checked="checked"':'' ?>/> <?php _e('Text only', 'qtranslate'); ?></label></p>
        <p><label for="<?php echo $this->get_field_id('type'); ?>2"><input type="radio" name="<?php echo $this->get_field_name('type'); ?>" id="<?php echo $this->get_field_id('type'); ?>2" value="image"<?php echo ($type=='image')?' checked="checked"':'' ?>/> <?php _e('Image only', 'qtranslate'); ?></label></p>
        <p><label for="<?php echo $this->get_field_id('type'); ?>3"><input type="radio" name="<?php echo $this->get_field_name('type'); ?>" id="<?php echo $this->get_field_id('type'); ?>3" value="both"<?php echo ($type=='both')?' checked="checked"':'' ?>/> <?php _e('Text and Image', 'qtranslate'); ?></label></p>
        <p><label for="<?php echo $this->get_field_id('type'); ?>4"><input type="radio" name="<?php echo $this->get_field_name('type'); ?>" id="<?php echo $this->get_field_id('type'); ?>4" value="dropdown"<?php echo ($type=='dropdown')?' checked="checked"':'' ?>/> <?php _e('Dropdown Box', 'qtranslate'); ?></label></p>
        <?php
    }
}
// Language Select Code for non-Widget users
function qtrans_generateLanguageSelectCode($style='', $id='') {
    global $q_config;
    if($style=='') $style='text';
    if(is_bool($style)&&$style) $style='image';
    if(is_404()) $url = get_option('home'); else $url = '';
    if($id=='') $id = 'qtranslate';
    $id .= '-chooser';
    switch($style) {
        case 'image':
        case 'text':
        case 'dropdown':
            echo '<ul class="qtrans_language_chooser" id="'.$id.'">';
            foreach(qtrans_getSortedLanguages() as $language) {
                $classes = array('lang-'.$language);
                if($language == $q_config['language'])
                    $classes[] = 'active';
                echo '<li class="'. implode(' ', $classes) .'"><a href="'.qtrans_convertURL($url, $language).'"';
                // set hreflang
                echo ' hreflang="'.$language.'" title="'.$q_config['language_name'][$language].'"';
                if($style=='image')
                    echo ' class="qtrans_flag qtrans_flag_'.$language.'"';
                echo '><span';
                if($style=='image')
                    echo ' style="display:none"';
                echo '>'.$q_config['language_name'][$language].'</span></a></li>';
            }
            echo "</ul><div class=\"qtrans_widget_end\"></div>";
            if($style=='dropdown') {
                echo "<script type=\"text/javascript\">\n// <![CDATA[\r\n";
                echo "var lc = document.getElementById('".$id."');\n";
                echo "var s = document.createElement('select');\n";
                echo "s.id = 'qtrans_select_".$id."';\n";
                echo "lc.parentNode.insertBefore(s,lc);";
                // create dropdown fields for each language
                foreach(qtrans_getSortedLanguages() as $language) {
                    echo qtrans_insertDropDownElement($language, qtrans_convertURL($url, $language), $id);
                }
                // hide html language chooser text
                echo "s.onchange = function() { document.location.href = this.value;}\n";
                echo "lc.style.display='none';\n";
                echo "// ]]>\n</script>\n";
            }
            break;
        case 'both':
            echo '<ul class="qtrans_language_chooser" id="'.$id.'">';
            foreach(qtrans_getSortedLanguages() as $language) {
                echo '<li';
                if($language == $q_config['language'])
                    echo ' class="active"';
                echo '><a href="'.qtrans_convertURL($url, $language).'"';
                echo ' class="qtrans_flag_'.$language.' qtrans_flag_and_text" title="'.$q_config['language_name'][$language].'"';
                echo '><span>'.$q_config['language_name'][$language].'</span></a></li>';
            }
            echo "</ul><div class=\"qtrans_widget_end\"></div>";
            break;
    }
}
function qtrans_widget_init() {
    register_widget('qTranslateWidget');
}


register_sidebar(array(
    'name' => 'Block after content',
    'id' => 'block-after-content',
    'description' => 'Khu vực sidebar hiển thị dưới mỗi bài viết',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h1 class="widget-title">',
    'after_title' => '</h1>'
));
