<!DOCTYPE html>
<html lang="ja" dir="ltr">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="initial-scale=1.0">
<title><?php wp_title(); ?></title>
<meta name="keywords" content="インディーズバンド,ポータルサイト,お勧め,紹介">

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<!-- <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/contact_form_7_styles.css" type="text/css" /> -->
<!-- <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/contact_form_7_styles-rtl.css" type="text/css" /> -->
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/js/wideslider/wideslider.css">
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/js/sticky/sticky.css">
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/js/easyselectbox/easyselectbox.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/wideslider/wideslider.js"></script>
<!-- <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/tabchange.js"></script> -->
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/sticky/jquery.sticky.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/easyselectbox/easyselectbox.min.js"></script>

<?php wp_head(); ?>

<script type="text/javascript">

	$(function(){
	
		 //serchページのトグル設定
		$(".band_search_box h3").hover(function(){
		$(this).css("cursor","pointer"); 
		},function(){
		$(this).css("cursor","default"); });
		
		$('.band_search_box h3').on('click', function() {
		$(this).toggleClass('active');});
		
		$(".band_search_box ul").css("display","none");
		$(".band_search_box h3").on("click", function() {
		$(this).next().slideToggle();
		});

		//レスポンシブ時のメニューのトグル設定
		$("#sp_menu").hover(function(){  
		$(this).css("cursor","pointer"); 
		},function(){
		$(this).css("cursor","default"); });
		
		$('#sp_menu').on('click', function() {
		$(this).toggleClass('active');});
		
		$("").css("display","none");
		$("#sp_menu").on("click", function() {
		$(this).next().slideToggle();
		});
		
		//stickyの設定
		//$(window).load(function(){
		//$("#g_nav_bg").sticky({ topSpacing: 0, center:true, className:"go" });
		//});

		//rankingページジャンルセレクトの装飾設定
		$('.design-select-box').easySelectBox({speed:200});

		$(window).scroll(function(){
		//最上部から現在位置までの距離を取得して、変数[now]に格納
		var now = $(window).scrollTop();

		//最下部から現在位置までの距離を計算して、変数[under]に格納
		var under = $('body').height() - (now + $(window).height());
 
		//最上部から現在位置までの距離(now)が400以上かつ
		//最下部から現在位置までの距離(under)が0px以上だったら
		if(now > 300 ){
			//[#page-top]をゆっくりフェードインする
			$('#page-top').fadeIn('slow');
		//それ以外だったらフェードアウトする
		}else{
			$('#page-top').fadeOut('slow');
		}
		});
 
		//ボタン(id:move-page-top)のクリックイベント
		$('#move-page-top').click(function(){
		//ページトップへ移動する
		$('html,body').animate({scrollTop:0},'slow');
		});

    });

</script>

<!--[if lt IE 9]>
<script type="text/javascript" src="https://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-77531363-1', 'auto');
  ga('send', 'pageview');

</script>

</head>
<body>

<div id="wrapper">
	<header>
		<h1><span><?php page_title(); ?></span></h1>
		<div id="header_wrap_bg">
			<div id="header_wrap">
				<div id="logo_area">
					<figure>
						<a href="<?php bloginfo('url'); ?>"><img src="<?php bloginfo('template_url'); ?>/images/logo_1.png" alt="XXX-Records"/></a>
					</figure>
				</div>
<!-- admax -->
<script src="https://adm.shinobi.jp/s/f13fd47c6dc76d5da54e0025d3cb70f5"></script>
<!-- admax -->

				<div id="nuv_area">
					<div id="pub">
						<p>現在 <span><?php echo wp_count_posts() -> publish ;?></span> バンド掲載中</p>
					</div>
					
					<?php get_search_form(); ?>
					
				</div>
			</div>
		</div>
		<div id="g_nav_bg">
			<nav id="g_nav">
			<div id="sp_menu"><img src="<?php bloginfo('template_url'); ?>/images/menu_bar.png" /></div>
				<ul>
					<li><a href="<?php bloginfo('url'); ?>" class="<?php if(is_home()||is_front_page()){ echo 'g_nav_select';} ?>" ><!-- img src="<?php bloginfo('template_url'); ?>/images/top.png" / --><!-- TOP -->トップ</a></li>
					<li><a href="<?php bloginfo('url'); ?>/band" class="<?php if(is_page(2) || is_category() || is_tag() || is_tax(area) || is_search() ){ echo 'g_nav_select';} ?>" ><!-- img src="<?php bloginfo('template_url'); ?>/images/serch.png" / --><!-- SEARCH -->バンド検索</a></li>
					<li><a href="<?php bloginfo('url'); ?>/ranking" class="<?php if(is_page(5)){ echo 'g_nav_select';} ?>" ><!-- img src="<?php bloginfo('template_url'); ?>/images/ranking.png" / --><!-- RANKING -->ジャンル別ランキング</a></li>
					<li><a href="<?php bloginfo('url'); ?>/author" class="<?php if(is_page(7) || is_archive()&&is_author() ){ echo 'g_nav_select';} ?>" ><!-- img src="<?php bloginfo('template_url'); ?>/images/author.png" / --><!-- AUTHOR -->キュレータ一覧</a></li>
				</ul>
			</nav>
		</div>

	</header>

	<?php if(is_front_page() || is_home()): ?>
		<div id="slider_bg">
			<div class="wideslider">
				<ul>
					<li><a href="<?php echo get_permalink( 150 ); ?>"><img src="<?php bloginfo('template_url'); ?>/images/sl_1_oz.jpg"  alt="<?php echo get_the_title( 150 ); ?>" /></a></li>
					<li><a href="<?php echo get_permalink( 165 ); ?>"><img src="<?php bloginfo('template_url'); ?>/images/sl_2_beautiful.jpg"  alt="<?php echo get_the_title( 165 ); ?>" /></a></li>
					<li><a href="<?php echo get_permalink( 366 ); ?>"><img src="<?php bloginfo('template_url'); ?>/images/sl_3_reptile.jpg"  alt="<?php echo get_the_title( 366 ); ?>" /></a></li>
					<li><a href="<?php echo get_permalink( 369 ); ?>"><img src="<?php bloginfo('template_url'); ?>/images/sl_4_keep.jpg"  alt="<?php echo get_the_title( 369 ); ?>" /></a></li>
				</ul>
			</div>
	</div>
	<?php endif; ?>
	
	<div id="content_bg">

	<div id="content">
	
	<?php if(!is_front_page() || !is_home()){ ?>
		<nav id="bc_list">
			<ul>
				<?php breadcrumbs(); ?>
			</ul>
		</nav>
	<?php } ?>
	
<!-- ↑↑ここまでheader.php↑↑ -->