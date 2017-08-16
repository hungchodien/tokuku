<?php
/*
Theme Name: Twenty Thirteen
Theme URI: http://wordpress.org/themes/twentythirteen
Author: the WordPress team
Author URI: http://wordpress.org/
Description: The 2013 theme for WordPress takes us back to the blog, featuring a full range of post formats, each displayed beautifully in their own unique way. Design details abound, starting with a vibrant color scheme and matching header images, beautiful typography and icons, and a flexible layout that looks great on any device, big or small.
Version: 1.0
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Tags: black, brown, orange, tan, white, yellow, light, one-column, two-columns, right-sidebar, flexible-width, custom-header, custom-menu, editor-style, featured-images, microformats, post-formats, rtl-language-support, sticky-post, translation-ready
Text Domain: twentythirteen

This theme, like WordPress, is licensed under the GPL.
Use it to make something cool, have fun, and share what you've learned with others.
*/
?>
<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" class="ie" dir="ltr" lang="en-US">
<![endif]-->
<!--[if IE 7]>
<html id="ie7" class="ie" dir="ltr" lang="en-US">
<![endif]-->
<!--[if IE 8]>
<html id="ie8" class="ie" dir="ltr" lang="en-US">
<![endif]-->
<!--[if IE 9]>
<html class="ie" dir="ltr" lang="en-US">
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html  <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
    <title>my website</title>
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="profile" href="http://gmpg.org/xfn/11" />





    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

    <script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/selectivizr.js" type="text/javascript"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/css3-mediaqueries.js" type="text/javascript"></script>

    <?php wp_head(); ?>
    <script src="<?php echo get_template_directory_uri(); ?>/js/matchMedia.js" type="text/javascript"></script>
    <![endif]-->
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/customslider.js"></script>

    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/slider-primary/jquery.fadeImg.js"></script>
    <link rel="stylesheet" href = "<?php echo get_template_directory_uri(); ?>/style.css">
    <script src="<?php echo get_template_directory_uri(); ?>/js/jquery.cookie.js"></script>

</head>
<body <?php body_class(); ?>>


<header id="masthead" class="site-header top_head">
    <div class=" top-glosbe-menu ">
        <div class="btn-left-mobile">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                &#9776;
            </button>
        </div>
        <a href="<?php echo get_option('home') ?>">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo.png" alt = "<?php bloginfo( 'name' ); ?>">
        </a>
        <a class="slogan" href="<?php echo get_option('home') ?>">
            <h1>あなたの旅をもっと豊かにする UnionPay Your Way</h1>
        </a>
        <span>
                    企業リスト　観光情報　お得クーポン
                </span>
        <select class="form-control" id="sel1">
            <option selected >日本語</option>
            <option>english</option>
            <option>Việt nammese</option>
        </select>
    </div>
    <input id="ajax_request" value="<?php echo get_option('home') ?>/wp-admin/admin-ajax.php" type="hidden"/>
</header><!-- .site-header -->

<section id="slider-primary">
    <div class="wrap">
        <div class="slide">

            <?php  $slider_primary =  ( json_decode (do_shortcode(' [tdrSlider slug="slider-primary" option="1" width="980" height="320" order="DESC" orderby="date"]', false))); ?>
            <div>
                <?php
                    foreach ($slider_primary as $key => $value){
                        if($value->url_path_resize):
                        ?>
                        <div class="psAbsolute first" style="background-image:url(<?php echo $value->url_path_resize ?>)">
                            <span class="title"><?php echo $value->title ?></span>
                            <span class="description"><?php echo $value->description ?></span>
                            <span class="time">2017.9.1～2017.11.30??????</span>
                        </div>
                        <?php
                        endif;
                    }
                ?>
            </div>
        </div>
    </div>
</section>
