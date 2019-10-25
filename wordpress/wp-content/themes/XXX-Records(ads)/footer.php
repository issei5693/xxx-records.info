<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>

<!-- ↓↓ここからfooter.php↓↓ -->

	</div><!-- /content -->
	
	</div><!-- /content_bg -->

	<footer>
		<div id="footer_wrap">
			<div id="logo_area">
				<figure>
					<!-- <a href="index.html"><img src="https://dummyimage.com/250x110/000/fff" /></a> -->
					<a href="#"><img src="<?php bloginfo('template_url'); ?>/images/logo_1.png" /></a>
				</figure>
				<p>XXX-Recordsは洋楽・邦楽問わず様々なジャンルのインディーズバンドを紹介するメディアです。XXX-Records登録の音楽好きキュレーターがオススメのバンドを毎日配信します。気に入ったバンドが見つかったら是非シェアしてください。
掲載依頼も随時募集しています。キュレーターとしてご協力いただける方からのご連絡も是非お待ちしております。<a href="<?php bloginfo('url'); ?>/contact">コンタクトページ</a>よりご連絡ください。</p>
			</div>
			<div id="nuv_area">
				<nav>
					<ul>
						<li><a href="<?php bloginfo('url'); ?>/contact">CONTACT</a></li>
						<li><a href="<?php bloginfo('url'); ?>/agreement">AGREEMENT</a></li>
						<li>
							<ul class="sns_ft">
								<li><a href="https://twitter.com/xxx_records" target="_blank" ><figure><img src="<?php bloginfo('template_url'); ?>/images/twitter.png" /></figure></a></li>
								<li><a href="#"><figure><img src="<?php bloginfo('template_url'); ?>/images/facebook.png" /></figure></a></li>
							</ul>	
						</li>
						<!-- <li>
							<h5><a href="<?php bloginfo('url'); ?>/shop">Serch</a></h5>
							<ul>
								<?php $categories = get_categories();
								foreach ( $categories as $category ) {
								echo '<li><a href="' . get_category_link( $category->term_id ) . '">' . $category->name . '</a></li>';
								}?>
							</ul>
						</li> -->
						<!-- <li>
							<h5><a href="<?php bloginfo('url'); ?>/ranking">Ranking</a></h5>
						</li>
						<li>
							<h5><a href="<?php bloginfo('url'); ?>/author">Author</a></h5>
						</li>
						<li><a href="<?php bloginfo('url'); ?>/agreement">Areement</a></li>
						<li><a href="<?php bloginfo('url'); ?>/sitemap">Sitemap</a></li> -->
					</ul>
				</nav>
			</div>
		<!-- admax -->
<script src="https://adm.shinobi.jp/s/a8c36125e5ed3f8c70daff288b2314a7"></script>
<!-- admax -->
		</div>
		<div id="copyright">
				<small>Copyright (c) 2007-<?php echo date("Y") ?><a href="#">XXX-records</a> All Rights Reserved.</small>
		</div>
	</footer>
</div>

<div id="page-top">
	<p><a id="move-page-top">▲</a></p>
</div>

<script>
//Face book関連
(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.4";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>

<script>
//Tweter関連
	!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');
</script>

<?php wp_footer(); ?>

</body>
</html>
