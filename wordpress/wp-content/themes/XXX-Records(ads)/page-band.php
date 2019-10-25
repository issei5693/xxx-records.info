<?php
/*
Template Name: band
*/
get_header(); ?>

<div id="single" class="band_search">

<h2>バンド検索</h2>

	<div class="band_search_box">
		<h3>JANREで探す</h3>
			<ul>
				<?php wp_list_categories('title_li=&orderby=order'); ?>
			</ul>
	</div><!-- /.band_search_box -->

	<div class="band_search_box">
		<h3>TAGで探す</h3>
			<ul>
				<?php $tags = get_tags();
					foreach ( $tags as $tag ) {
					echo '<li><a href="' . get_tag_link( $tag->term_id ) . '">' . $tag->name . '</a></li>';
				}?>
			</ul>
	</div><!-- /.band_search_box -->

	<div class="band_search_box">
		<h3>AREAで探す</h3>
			<ul>
				<?php $terms = get_terms( 'area','orderby=order' );
					foreach ( $terms as $term ) {
					echo '<li><a href="' . get_term_link( $term ) . '">' . $term->name . '</a></li>';
					}?>
			</ul>
	</div><!-- /.band_search_box -->
	
	<div class="band_search_box">
		<h3>複数条件検索</h3>
		<ul class="searchform_c_outer">
		<form method="get" id="searchform_c" action="<?php bloginfo('url'); ?>">
			<input type="text" name="s" placeholder="Band name" />
			
			<select name="genre" class="design-select-box"><!-- ジャンル絞込み -->
				<option value="">Select Genre</option>
				<?php $categories = get_categories('orderby=order');
					foreach ( $categories as $category ) { ?>
				<option value="<?php echo $category->slug; ?>"> <?php echo $category->name; ?></option>
				<?php }?>
			</select><!-- /ジャンル絞込み -->
			
			<select name="tag" class="design-select-box"><!-- タグ絞込み -->
				<option value="">Select Tag</option>
				<?php $tags = get_tags();
					foreach ( $tags as $tag ) {
					echo '<option name="'. $tag->slug .'">' . $tag->name . '</option>';
				}?>
			</select><!-- /タグ絞込み -->
			
			<select name="area" class="design-select-box"><!-- エリア絞込み -->
				<option value="">Select Area</option>
				<?php $terms = get_terms( 'area','orderby=order' );
					foreach ( $terms as $term ) {
					echo '<option name="'. $term->name .'">' . $term->name . '</option>';
				}?>
			</select><!-- /エリア絞込み -->

			<!-- <input type="checkbox" name="riyu" value="1" checked="checked">1 -->
			<!-- <input type="checkbox" name="alpha" value="a" checked="checked">a -->
			<!-- <input type="checkbox" name="riyu" value="2">2 -->
			<!-- <input type="checkbox" name="alpha" value="b">b -->
			<!-- <input type="checkbox" name="riyu" value="3">3 -->
			<!-- <input type="checkbox" name="alpha" value="c">c -->

			<input type="submit" value="Go" class="select_go">
		</form>
		</ul>
		
	</div><!-- /.band_search_box -->
	
	</div><!-- /#single -->

<?php get_footer(); ?>