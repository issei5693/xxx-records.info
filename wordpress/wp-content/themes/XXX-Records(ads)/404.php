<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>

		<div id="primary">
			<h2>404 NOT FOUND</h2>
			
			<div class="txt">
				<p>
					誠に申し訳ございません。ページが見つかりませんでした。<br>
					<br>
					アクセスしようとしたページは現在一時的にアクセスが出来ないか、<br>
					削除、もしくはURLが変更された可能性があります。<br>
					<br>
					<a href="<?php bloginfo('url'); ?>">トップページに戻る</a>
				</p>
			</div>

		</div>

<?php get_footer(); ?>
