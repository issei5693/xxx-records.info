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
	//$s = $_GET['s']; 別にこれはわざわざとらなくても既に取れている
	$category_name = $_GET['category_name'];
	$tag = $_GET['tag'];
	$meta_value = $_GET['meta_value'];
	$area = $_GET['area'];
 	?>

		<div id="primary">
			<h2>『<?php the_search_query(); ?>』 の検索結果 : <?php echo $wp_query->found_posts; ?>件</h2>
			
			<?php
			echo $s;
			if(empty($category_name)){
			$category_name = 'false';
			echo $category_name ; 
			} else {
			echo $category_name;
			}
			echo $tag;
			echo $meta_value;
			echo $area;

			 ?>
			
			
			
			
			<?php
				query_posts( //array  ('relation' => 'or',
				array(
				's' => $s, //文言
				'category_name' => $category_name,  //カテゴリーの名前
				'tag' => $tag, //タグ
				'meta_value' => $meta_value,//カスタムフィールドの値
				'tax_query' => array(
									array (
											'taxonomy' => 'area',  //タクソノミー
											'field'=>'slug',
											'terms' => array( $area ),
											'operator' => 'IN'
											) 
									)
									)
									//)
							); ?>
				
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
 
				<ul class="serch">
					<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				</ul>
 
			<?php endwhile; else : ?>
			
				<div class="txt">
					<p>申し訳ございません。<br />
					『<?php the_search_query(); ?>』に該当する記事がございません。<br />
					お手数ですが、他のキーワードで検索してください。
					</p>
				</div>
			
 
			<?php endif; wp_reset_query(); ?>
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
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
