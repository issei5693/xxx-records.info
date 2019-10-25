<?php get_header(); ?>

		<div id="primary">
				
			<div id="new_band">
				<h2><?php the_author_meta( nickname, $author ); ?>の記事一覧</h2>
				
				<?php $this_author = get_the_author_meta( ID, $author ); ?>
				
				<div class="band_list">
				
				<?php $paged = get_query_var('paged') ? get_query_var('paged') : 1 ;?>
			
			<?php $args = array(
				'author' => $this_author, 
				'posts_per_page' => 10,
				'nopaging' => false,
				'paged' => $paged
				);
			$the_query = new WP_Query( $args ); 
			if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) :  $the_query->the_post(); ?>
				<div class="band_outer">
					<div class="band">
					<h3><?php the_title(); ?></h3>
						<a href="<?php the_permalink(); ?>">
							<figure>
							<?php $top_movie = get_post_meta($post->ID , 'top_movie' ,true); ?>
							<?php if( empty($top_movie) ){
								the_post_thumbnail( array( 480, 270 ) );
								} else { ?>
								<img src="https://i.ytimg.com/vi/<?php echo get_post_meta($post->ID , 'top_movie' ,true); ?>/mqdefault.jpg" />
								<?php }?>
							</figure>
						</a>
						<div class="desc">
							<p><?php echo get_post_meta($post->ID , 'title_comment' ,true); ?>
								<span>【 GENRE / <a href="#"><?php the_category(', '); ?></a> 】</span><span>【 AREA / <a href="#"><?php echo get_the_term_list($post->ID, 'area', '', ', '); ?></a> 】</span><span> 【 TAG / <?php the_tags('',',',''); ?> 】</span></p>
							<div class="to_single">
								<a href="<?php the_permalink(); ?>">VIEW</a>
							</div>
						</div><!-- /desc -->
					</div><!-- /band -->
				</div><!-- /band_outer -->
				
			<?php endwhile; endif; ?>
			
				</div><!-- /band_list -->
				
				<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(array('query'=>$the_query)); }  ?>
				
			<?php wp_reset_postdata(); ?>
				
			</div><!-- /new_band -->
			
		</div><!-- /primary -->
		
<?php get_footer(); ?>



