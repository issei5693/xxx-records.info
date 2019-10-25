<?php get_header(); ?>

<div id="single">

<h2><?php echo single_post_title(); ?></h2>
<ul class="sns">
	<li><div class="fb-like" data-width="100" data-layout="button_count" data-show-faces="false" data-send="false" data-share="true"></div></li>
	<li><a href="https://twitter.com/share" class="twitter-share-button" data-via="XXXRecords">Tweet</a></li>
</ul>
		<figure id="single_img">
			<?php $top_movie = get_post_meta($post->ID , 'top_movie' ,true); ?>
			<?php if( empty($top_movie) ){
				the_post_thumbnail();
				} else { ?>
				<iframe src="https://www.youtube.com/embed/<?php echo get_post_meta($post->ID , 'top_movie' ,true); ?>" frameborder="0" allowfullscreen></iframe>
				<?php }?>
				
		</figure>
		
		<div class="single_box">
			<h3>Profile</h3>
			<div class="single_box_inner">
				<p>
					<?php echo get_post_meta($post->ID , 'profile' ,true); ?>
				</p>
				<table>
				<caption><span>Detail</span></caption>
					<tbody>
						<tr><th>GENRE</th><td class="sep">:</td><td><?php the_category(', '); ?></td></tr>
						<tr><th>AREA</th><td class="sep">:</td><td><?php echo get_the_term_list($post->ID, 'area', '', ', '); ?></td></tr>
						<tr><th>TAG</th><td class="sep">:</td><td><?php the_tags('<span class="tag">','</span>, <span class="tag">','</span>'); ?></td></tr>
						<tr><th>OFFICIAL HP</th><td class="sep"> : </td><td><a href="<?php echo get_post_meta($post->ID , 'hp' ,true); ?>"><?php echo get_post_meta($post->ID , 'hp' ,true); ?></a></td></tr>
					</tbody>
				</table>
				<table>
					<caption><span>Menber</span></caption>
					<?php echo get_post_meta($post->ID , 'menber' ,true); ?>
				</table>
			</div><!-- /.single_box_inner -->
		</div><!-- /.single_box -->
		
		<div class="single_box">
			<h3>Review (Author/<?php single_author() ;?>)</h3>
			<div class="single_box_inner">
				<p><?php echo get_post_meta($post->ID , 'review' ,true); ?></p>
			</div><!-- /single_box_inner -->
		</div><!-- /single_box -->
		
		<?php //その他ムービー1が空のときは表示させない
			$other_movies = get_post_meta($post->ID , 'other_movies_1' ,true);
			if(empty($other_movies)){
			} else { ?>
		
		<div class="single_box">
		<h3>Other movies</h3>
		<ul>
			<?php for ($i = 1; $i <= 10; $i++){ ?>
				<?php if (post_custom('other_movies_'.$i)){ ?>
				<li>
					<figure>
						<iframe src="https://www.youtube.com/embed/<?php echo get_post_meta($post->ID , 'other_movies_'.$i ,true); ?>" frameborder="0" allowfullscreen></iframe>
					</figure>
				</li>
				<?php } ?>
			<?php } ?>
			
		</ul>
		</div><!-- /.single_box -->
		<?php } ?>
		
		<?php //サウンドクラウド1が空のときは表示させない
			$sound_cloud = get_post_meta($post->ID , 'sound_cloud_1' ,true);
			if(empty($sound_cloud)){
			} else { ?>
		
		<div class="single_box sound_cloud">
		<h3>Sound Cloud</h3>
		<ul>
			<?php for ($i = 1; $i <= 10; $i++){ ?>
				<?php if (post_custom('sound_cloud_'.$i)){ ?>
				<li>
					<?php echo get_post_meta($post->ID , 'sound_cloud_'.$i ,true); ?>
				</li>
				<?php } ?>
			<?php } ?>
			
		</ul>
		</div><!-- /.single_box -->
		<?php } ?>
		
		<div class="to_hp">
			<a href="<?php echo get_post_meta($post->ID , 'hp' ,true); ?>" target="_blank" >Official HP</a>
		</div><!-- /.to_hp -->
		
		<div class="single_box">
			<h3>Related band</h3>
			<div class="band_list">
				
			<?php $cat = get_the_category(); 
			$cat_id = $cat[0] -> cat_ID;
			?>
				
			<?php $args = array(
				'cat' => $cat_id,
				'posts_per_page' => 10,
				'nopaging' => false,
				'post__not_in' => array($post->ID)
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
								<img src="https://i.ytimg.com/vi/<?php echo get_post_meta($post->ID , 'top_movie' ,true); ?>/mqdefault.jpg" width="560" height="315" />
								<?php }?>
							</figure>
						</a>
						<div class="desc">
							<p><?php echo get_post_meta($post->ID , 'title_comment' ,true); ?>
								<span>【 GENRE / <?php the_category(', '); ?> 】</span><span>【 AREA / <?php echo get_the_term_list($post->ID, 'area', '', ', '); ?> 】</span><span> 【 TAG / <?php the_tags('',',',''); ?> 】</span></p>
							<div class="to_single">
								<a href="<?php the_permalink(); ?>">VIEW</a>
							</div>
						</div><!-- /desc -->
					</div><!-- /band -->
				</div><!-- /band_outer -->
				<?php if($post == 0 ){ echo 'This janre is only this band'; } ?>
			<?php endwhile; ?>
			<?php else: ?>
				<p>This janre is only this band</p>
			<?endif; ?>
			<?php wp_reset_postdata(); ?>
			
				</div><!-- /band_list -->
		</div><!-- /.single_box -->
		
		
		
	</div><!-- /#single -->

			
<?php get_footer(); ?>
