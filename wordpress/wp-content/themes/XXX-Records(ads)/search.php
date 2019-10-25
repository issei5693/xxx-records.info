<?php
/**
 * The template for displaying search results pages.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>

<?php 
	$category_name = $_GET['genre'];
	$tag = $_GET['tag'];
	$area = $_GET['area'];
	//$riyu = $_GET['riyu'];
	//$alpha = $_GET['alpha'];
	//$url_query = $_SERVER['REQUEST_URI']
 	?>
<?php
//echo $riyu;
//echo $alpha;
//echo $url_query;

//$query_array = explode("&", $url_query); //&で分割
//print "<pre>";
//print_r($query_array);
//print "</pre>";


 ?>
		<div id="primary">

			<?php if($area){ //tax_queryはなぜか一度変数に格納しないと上手く機能しなかったため一度変数に格納
					//⇒2016/08/30原因が判明。tax_query内のtermsは空白じゃダメ！だから外に描くことでif分岐を書けるのでこのやり方で成功している。
				 $tax_query = array( array( 'relation' => 'OR',
					'taxonomy' => 'area',
					'terms' =>  $area ,
					'field'=>'slug',
					'include_children' => false,
					'operator' => 'IN'
								)
							);
							} ?>

			<?php $paged = get_query_var('paged') ? get_query_var('paged') : 1 ;?>
			
			<?php
			$args = array (
						'posts_per_page' => 10,
						'post_type' => array('post'),
						'nopaging' => false,
						'paged' => $paged,
						's' => $s, //文言
						'category_name' => $category_name, //カテゴリーの名前
						'tag' => $tag, //タグ
						'tax_query' => $tax_query 
							);
						$the_query = new WP_Query( $args );
			?>

			<h2>検索結果 : <?php echo $the_query->found_posts; ?>件</h2>
			
			<div class="result">
				<table>
				<caption><span>Condition</span></caption>
					<tbody>
						<tr><th>Band name</th><td class="sep">:</td><td><?php echo $s; ?></td></tr>
						<tr><th>GENRE</th><td class="sep">:</td><td><?php echo $category_name; ?></td></tr>
						<tr><th>AREA</th><td class="sep">:</td><td><?php echo $area; ?></td></tr>
						<tr><th>TAG</th><td class="sep">:</td><td><?php echo $tag; ?></td></tr>
					</tbody>
				</table>
			</div>
				
			<?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
 
				<!--<ul class="serch">
					<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				</ul>-->

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

			<?php endwhile; else : ?>
			
				<div class="txt">
					<p>申し訳ございません。<br />
					<!--『<?php the_search_query(); ?>』に -->該当する記事がございません。<br />
					お手数ですが、他のキーワードで検索してください。
					</p>
				</div>
			
			<?php endif; ?>
			
			 <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(array('query'=>$the_query)); }  ?>
			 
			<?php wp_reset_postdata(); ?>
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			<!-- 投稿情報 loop
			<?php if(have_posts()) : ?>
			
				<ul class="serch">
					<?php while(have_posts()):the_post() ?> 
					<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
					<?php endwhile; ?>
				</ul>
			<?php else: ?>
				<div class="txt">
					<p>申し訳ございません。<br />
					『<?php the_search_query(); ?>』に該当する記事がございません。<br />
					お手数ですが、他のキーワードで検索してください。
					</p>
				</div>
			<?php endif; ?> -->
			
			
		</div>

<?php get_footer(); ?>
