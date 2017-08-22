<?php  get_header(); ?>
    <div id="primary" class="content_body">
        <div class="container clear">
            <div class="row">
                <div class="main_content col-sm-9 col-sm-push-3">
                    1234
                    <?php while ( have_posts() ) : the_post();?>

                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <header class="entry-header">
                                <h1 class="entry-title blue_bg cat_block_title"><?php the_title(); ?></h1>
                            </header><!-- .entry-header -->

                            <div class="entry-content">
                                <?php the_content(); ?>
                            </div><!-- .entry-content -->

                        </article>

                    <?php endwhile; ?>
                </div>
                <?php get_sidebar(); ?>
            </div>
        </div><!--.content_inc-->
    </div><!--#primary-->
<?php get_footer(); ?>