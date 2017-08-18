<?php
/*
Template Name: News Page
*/
?>
<?php  get_header(); ?>
<div id="primary" class="content-area">
   <div class="content_inc">
   
   
      <div class="wauto content_container news_template">
                    
                    <div class="entry_content">
                    <header class="entry-header"><h1 class="entry-title"><?php the_title(); ?></h1></header>
      
                    <div class="row index_news_loop clear">
    
    <?php
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$loop = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => 9, 'paged'=>$paged ) ); ?>  
  

	<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
<div class="news_loop_block col-lg-4 col-md-4 col-sm-4 col-xs-12">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
		<div class="loop_news_thumbnail">
            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('loop_thumb'); ?></a>
            
		</div>
		
        <h4 class="loop_news_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
        <p class="date"><?php echo get_the_date('d/m/Y'); ?></p>
        <div class="loop_news_excerpt"><?php the_excerpt(); ?></div>
        <p class="wp-posts-carousel-categories"><?php the_category(' '); ?></p>
        <p class="loop_news_more"><a href="<?php the_permalink(); ?>"><?php _e("<!--:vi-->chi tiết<!--:--><!--:en-->read more<!--:-->"); ?></a></p>
        
	</article>
    </div>


<?php endwhile; ?>
    
     </div>
     
     <div class="pagenavi_content clear">
	                   <?php 
							if(!wp_pagenavi(array( 'query' => $loop ))):
								echo "";
								
								else:
					  			 wp_pagenavi(array( 'query' => $loop )); 
							endif;
						?>
						</div><!--pagenavi_content-->
                         <?php 
						 	wp_reset_postdata();
							
						?>
                    </div><!--entry_content-->
                
            
      </div><!--news_template-->
        
        
        
   </div><!--.content_inc-->
</div><!--#primary-->
<?php get_footer(); ?>