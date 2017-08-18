<?php
/**
 * Template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>

	<div id="primary" class="content_body">
		<div class="container clear">
 <div class="row">
 <div class="main_content col-sm-9 col-sm-push-3">
			<article id="post-0" class="post error404 not-found">
				<header class="entry-header">
					<h1 class="entry-title blue_bg cat_block_title">Không tìm thấy trang</h1>
				</header>

				<div class="entry-content">
					<p>Rất tiếc! không tồn tại trang này. Vui lòng sử dụng công cụ tìm kiếm dưới đây!</p>

					<div class="search_box"><?php get_search_form(); ?></div>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->
 </div>
<?php get_sidebar(); ?>
</div>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>