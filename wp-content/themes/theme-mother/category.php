<?php
/**
 * The template for displaying Category pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content_body">
		<div class="container clear">

		<?php if ( have_posts() ) : ?>
			<header class="entry-header">
				<h1 class="entry-title blue_bg cat_block_title"><?php printf( __( '%s', 'twentythirteen' ), single_cat_title( '', false ) ); ?></h1>
			</header><!-- .archive-header -->

			<?php 
			$width=500;
	$height=580;
	$col = 0; $numcols = 4; ?>
    <div class="row loop_row">
			<?php while ( have_posts() ) : the_post(); ?>
            <?php if ($ct && $ct%$numcols==0) echo '</div><div class="row loop_row">'; ?>

            <div class="loop_block col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php if ( has_post_thumbnail() && ! post_password_required() && ! is_attachment() ) : ?>
		<div class="entry-thumbnail loop_thumbnail tmb">
			<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
					<?php $thumb_sin = get_post_thumbnail_id();
			$img_url_sin = wp_get_attachment_url( $thumb_sin,'full' ); 
			$image_sin = aq_resize(wp_get_attachment_url( get_post_thumbnail_id($post->ID) ),$width,$height, true );
			if(!empty($image_sin) && $image_sin!="" ):
			echo '<img class="lazy-load lazy_resize" src="'.$image_sin.'" width="'.$width.'" height="'.$height.'"  alt="" />';	
			else:
				the_post_thumbnail('lazy-load'); 
			endif; ?></a>
		</div>
		<?php endif; ?>

		<?php if ( is_single() ) : ?>
		<h1 class="entry-title blue_bg cat_block_title"><?php the_title(); ?></h1>
		<?php else : ?>
        <div class="owl_txt">
		<h3 class="loop_title">
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h3>
		<?php endif; ?>
	
    <?php if ( is_category('news') || is_category('events') ) : ?>
	<p class="date"><?php echo get_the_date('d/m/Y'); ?></p>
    <?php endif; ?>
   
	<div class="loop_excerpt">
		<?php the_excerpt(); ?>
	</div><!-- .entry-content -->
    
    <?php $new_price = get_post_meta($post->ID,'wpcf-new-price',true); 
	$old_price = get_post_meta($post->ID,'wpcf-old-price',true); 
	?>
    <div class="clear prices">
    <?php if (!empty($new_price)): ?><p class="fl new_price red"><?php echo $new_price; ?> đ</p><?php endif; ?>
    <?php if (!empty($old_price)): ?><p class="fl old_price"><?php echo $old_price; ?> đ</p><?php endif; ?>
    </div>
    
    <p class="loop_more"><a class="red_bg" href="<?php the_permalink(); ?>">chi tiết</a></p>
</div>
</article>
                </div>
                
                
<?php $ct++; ?>
			<?php endwhile; ?>
            </div>
            
            

			<div class="pagenavi clear"><?php wp_pagenavi(); ?></div>
		
		<?php endif; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>
