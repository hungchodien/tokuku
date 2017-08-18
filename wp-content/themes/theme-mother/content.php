<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php if ( is_single() ) : ?>
		<h1 class="entry-title cat_block_title"><?php the_title(); ?></h1>
		<?php else : ?>
		<h3 class="loop_title cat_block_title">
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h3>
		<?php endif; // is_single() ?>
        
        <div class="clear">
		<?php
		$width=500;
	$height=500;
		 if ( has_post_thumbnail() && ! post_password_required() && ! is_attachment() ) : ?>
		<div class="entry-thumbnail loop_thumbnail tmb fl">
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

	<div class="search_right fr">
	<?php /*?><p class="date"><?php echo get_the_date('d/m/Y'); ?></p><?php */?>
	<div class="loop_excerpt">
		<?php the_excerpt(); ?>
	</div><!-- .entry-content -->
    <p class="loop_more"><a class="red_bg" href="<?php the_permalink(); ?>">chi tiết</a></p>
    </div>
    </div>

</article><!-- #post -->
