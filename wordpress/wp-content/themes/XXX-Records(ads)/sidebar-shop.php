
<!-- ↓↓ここからsidebar.php↓↓ -->

		<div id="secondary">
			<h2>MENU</h2>

			<section class="secondary_box">
				<h3 class="glass">ジャンルで探す</h3>
				<?php wp_list_categories('title_li= &orderby=order'); ?>
			</section>

			<section class="secondary_box">
			<h3 class="hart">コンセプトで探す</h3>
					<ul>
					<?php $tags = get_tags();
						foreach ( $tags as $tag ) {
						echo '<li><a href="' . get_tag_link( $tag->term_id ) . '">' . $tag->name . '</a></li>';
						}?>
					</ul>
			</section>

			<section class="secondary_box">
			<h3 class="yen">価格で探す</h3>
					<ul>
					
					<?php $terms = get_terms( 'price','orderby=order' );
					//print_r($terms); //出力確認
					
					foreach ( $terms as $term ) {
					echo '<li><a href="' . get_term_link( $term ) . '">' . $term->name . '</a></li>';
					}?>

					</ul>
			</section>

