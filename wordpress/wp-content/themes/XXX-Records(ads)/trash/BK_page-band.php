<?php
/*
Template Name: band
*/
get_header(); ?>
		<div id="primary">
			<h2>店舗一覧</h2>
			
		<?php
			$paged = get_query_var('paged') ? get_query_var('paged') : 1 ;
		?>
			
		<?php $args = array(
			'posts_per_page' => 3,
			'nopaging' => false,
			'paged' => $paged
			);
			$the_query = new WP_Query( $args ); 
			if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) :  $the_query->the_post(); ?>
				<div class="box">
					<h4><span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span><?php the_tags('<span class="tag">','</span><span class="tag">','</span>'); ?></h4>
					<figure class="box_img">
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
					</figure>
					<div class="box_data">
						<table>
							<tr><th>ＴＥＬ</th><td><?php echo get_post_meta($post->ID , 'tel' ,true); ?></td></tr>
							<tr><th>営業時間</th><td><?php echo get_post_meta($post->ID , 'time' ,true); ?></td></tr>
							<tr><th>出張エリア</th><td><?php echo get_post_meta($post->ID , 'area' ,true); ?></td></tr>
							<tr><th>最安値料金</th><td><?php echo get_post_meta($post->ID , '最安値料金' ,true); ?></td></tr>
						</table>
					</div>
					<div class="box_desc">
						<a href="<?php the_permalink(); ?>">店舗の詳細を見る</a>
					</div>
				</div>
				
			<?php endwhile; endif; ?>
			
			<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(array('query'=>$the_query)); }  ?>
			
		<?php wp_reset_postdata(); ?>

		</div>
		
<?php get_sidebar(shop); ?>

<?php get_footer(); ?>