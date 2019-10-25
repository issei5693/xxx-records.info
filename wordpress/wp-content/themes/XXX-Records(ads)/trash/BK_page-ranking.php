<?php
/*
Template Name: ranking
*/
get_header(); ?>
		<div id="primary_1col">
			<h2>Ranking</h2>
			<nav>
				<ul class="tab">
					<li class="select"><span>総合</span></li>
					<?php $categories = get_categories('orderby=order');
							$c_list = array(); //カテゴリーのスラッグの配列を生成するための配列
								$l = 0 ; //配列を順番に格納するための変数
									foreach ( $categories as $category ) {
									echo '<li><span>' . $category->name . '</span></li>';
								$c_list[$l] = $category->slug;
								$l++ ;
								}?>
				</ul>
			</nav>

			<div id="shop_list">

			<!-- 総合 -->

			<ul class="content">

				<li><!-- タブコンテンツ -->
					<div id="all_con">
					<?php $i = 1 ;?><!-- CSS切り替えで使用 -->

					<?php
						$args = array(
							'posts_per_page' => 10,
							'orderby' => 'meta_value_num',
							'meta_key' =>'views',
							'order' => 'DESC',
							);
								$my_query = new WP_Query( $args );
								if($my_query->have_posts()) : while($my_query->have_posts()) : $my_query->the_post(); ?>
	
								<div class="box">
									<h4 class="<?php //echo 'rank_'.$i; ?>"><span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span><?php the_tags('<span class="tag">','</span><span class="tag">','</span>'); ?></h4>
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
					<?php $i++; ?><!-- CSS切り替えで使用 -->
		
								<?php endwhile; endif; ?>
								<?php //endwhile; wp_reset_postdata(); ?>

					<div id="all">
						<p><a href="<?php bloginfo('url'); ?>/shop">総合の一覧を見る</a></p>
					</div>

					</div><!-- /all_con -->
				</li><!-- タブコンテンツ -->

			<!-- /総合 -->

			<!-- その他カテゴリーコンテンツの繰り返し処理 -->

			<?php foreach ( $c_list as $key => $value ) : ?>
			
				<li class="hide"><!-- その他カテゴリーコンテンツここから -->
					<div id="<?php echo $value ;?>">
					<?php $i = 1 ; //CSS切り替えで使用 ?>

					<?php
						$args = array(
							'posts_per_page' => 10,
							'category_name' => $value, 
							'orderby' => 'meta_value_num',//meta_valueではないので注意
							'meta_key' =>'views',
							'order' => 'DESC',
							);
								$my_query = new WP_Query( $args );
								if($my_query->have_posts()) : while($my_query->have_posts()) : $my_query->the_post(); ?>
								
									<div class="box">
										<h4 class="<?php //echo 'rank_'.$i; ?>"><span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span><?php the_tags('<span class="tag">','</span><span class="tag">','</span>'); ?></h4>
										<figure class="box_img">
											<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
										</figure>
										<div class="box_data">
											<table>
												<tr><th>ＴＥＬ</th><td><?php echo get_post_meta($post->ID , '電話番号' ,true); ?></td></tr>
												<tr><th>営業時間</th><td><?php echo get_post_meta($post->ID , '営業時間' ,true); ?></td></tr>
												<tr><th>定休日</th><td><?php echo get_post_meta($post->ID , '定休日' ,true); ?></td></tr>
												<tr><th>最安値料金</th><td><?php echo get_post_meta($post->ID , '最安値料金' ,true); ?></td></tr>
											</table>
										</div>
										<div class="box_desc">
											<a href="<?php the_permalink(); ?>">店舗の詳細を見る</a>
										</div>
									</div>
									
									
					<?php $i++; //CSS切り替えで使用 ?>
				<?php endwhile; endif; wp_reset_postdata();  ?>
				
									<div id="all">
										<p><a href="<?php bloginfo('url'); ?>/category/<?php echo $value ;?>"><?php $cat = get_categories('orderby=order'); 
											echo $cat[$key]->name ; ?>の一覧を見る</a></p>
									</div>
									
					</div><!-- echo $value -->
				</li><!-- その他カテゴリーコンテンツここまで -->
			<?php endforeach; ?>
			
			</div><!-- /shop_list -->
			
		</div><!-- /primary_1col -->

<?php get_footer(); ?>