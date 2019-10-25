<?php
/**
 * The template for displaying tag pages
 */

get_header(); ?>
		<div id="primary">
			<h2>TAG : <?php echo single_cat_title(); ?></h2>
			
			<?php while(have_posts()) : the_post(); ?>

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
				
			<?php endwhile;?>
			
			<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
			
		</div>

<?php get_footer(); ?>