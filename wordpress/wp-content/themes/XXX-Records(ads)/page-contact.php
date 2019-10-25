<?php
/*
Template Name: contact
*/
get_header(); ?>

		<div id="primary">
			<div id="single" class="contact">
			<h2>CONTACT</h2>
			
			<?php if(have_posts()): while(have_posts()): the_post(); ?>
			<p>お問い合わせ・掲載依頼・削除依頼はこちらからお願いいたします。<br>
			掲載依頼の場合はYoutubeの楽曲URL、簡単なバンドプロフィールや楽曲紹介もご記載して頂けると幸いです。
			内容確認後、返信させて頂きます。</p>
				<?php the_content(); ?>
			<?php endwhile; endif; ?>
			
		</div>


<?php get_footer(); ?>
