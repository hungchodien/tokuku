<?php  get_header(); ?>
<div id="primary" class="content_body">
        
        <?php while ( have_posts() ) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h2 class="entry_title"><?php the_title(); ?></h2>

		<p class="date"><?php echo get_the_date('Y.m.d'); ?></p>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->

	
</article>

				<?php endwhile; ?>
        

</div><!--#primary-->
<?php get_footer(); ?>