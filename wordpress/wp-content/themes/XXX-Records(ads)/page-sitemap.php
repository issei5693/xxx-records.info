<?php
/*
Template Name: sitemap
*/
get_header(); ?>

		<div id="primary">

		<h2><?php the_title(); ?></h2>
		<?php foreach(get_categories() as $key => $value){ ?>
			<section>
				<h3><a href="<?php echo get_category_link($value->cat_ID); ?>"><?php echo $value->name;?></a></h3>
				<?php
				$args =array('posts_per_page' => -1,
							 'post_type' => 'post',
							 'orderby' => 'date',
							 'cat' => $value->cat_ID,
							 'order' => 'DESC',
				);
				$new_posts = new WP_Query($args);
				?>
				
				<?php if($new_posts->have_posts()){ ?>
					<ul class="map_list">
					<?php while($new_posts->have_posts()) : $new_posts->the_post(); ?>
						<li><a href="<?php the_permalink(); ?>"><?php the_title();?></a></li>
					<?php endwhile; wp_reset_postdata(); ?>
					</ul>
				<?php } ?>
			</section>
		<?php } ?>
		<section>
			<h3>ページ</h3>
			<ul class="map_list">
				<?php wp_list_pages('title_li=&exclude='.get_the_ID()); ?>
			</ul>
		</section>


		</div>

<?php get_sidebar(shop); ?>

<?php get_footer(); ?>
