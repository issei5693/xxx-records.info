<?php
/*
Template Name: ranking
*/
get_header(); ?>

<div id="single" class="ranking">

<h2>Ranking</h2>

<form action="" method="get">
<select name="genre" class="design-select-box">
<option value="">Select Genre</option>
<option value="all">All</option>
<?php $categories = get_categories('orderby=order');
	foreach ( $categories as $category ) { ?>
		<option value="<?php echo $category->slug; ?>"> <?php echo $category->name; ?></option>
	<?php }?>
</select>
<input type="submit" value="Go" class="select_go">
</form> 

<?php $url = $_SERVER["REQUEST_URI"]; 
		if( $url == "/ranking/" || $url == "/ranking/?genre=all" ){ //ランキングページを選択した直後と『Select Genre』と『All』を選択した場合;
			$genre = "";
			}  else {  //ジャンルを選択した場合;
			$genre = str_replace("/ranking/?genre=", "", $url);
			} ?>

<div id="now_select">
	<p><?php if(empty($genre)){ echo "All";} else { echo ucfirst($genre); } ?></p>
</div>


				<div class="band_list">
			
			<?php $args = array(
						'posts_per_page' => 10,
						'category_name' => $genre,
						'orderby' => 'meta_value_num',
						'meta_key' =>'views',
						'order' => 'DESC',
				);
			$the_query = new WP_Query( $args ); 
			if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) :  $the_query->the_post(); ?>
				<div class="band_outer">
					<div class="band">
					<h3 class="rank"><?php the_title(); ?></h3>
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
			<?php wp_reset_postdata(); ?>
			
				</div><!-- /band_list -->










</div><!-- /#single -->


<?php get_footer(); ?>