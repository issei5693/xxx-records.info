<?php //『価格帯』のタクソノミーを作成し、通常の投稿に追加
function people_init() {
	// 新規分類を作成
	register_taxonomy(
		'area',
		'post',
		array(
			'label' => __( '活動エリア' ),
			'hierarchical' => true,
			)
	);
}
add_action( 'init', 'people_init' );

//パンくずリスト

function the_breadcrumbs($strtitle){
	return '<li itemscope itemtype="https://data-vocabulary.org/Breadcrumb"><span itemprop="title">'.$strtitle.'</span></li>';
}
function link_breadcrumbs($strtitle,$strurl){
	return '<li itemscope itemtype="https://data-vocabulary.org/Breadcrumb"><a title="'.$strtitle.'" href="'.$strurl.'" itemprop="url"><span itemprop="title">'.$strtitle.'</span></a></li>';
}
function breadcrumbs() {
	if(!is_home()) {
		global $wp_query;
		global $bp;
		
		$category_name = $_GET['genre'];
		$tag = $_GET['tag'];
		$area = $_GET['area'];
		$serch_page = get_the_permalink(2); //SERCH固定ページのURLを取得
		//print_r ($wp_query);
		
		$home_name = get_bloginfo('name');
		$not_found = '404 NOT FOUND';
		$search_name = '『'.get_search_query().'』の検索結果';
		echo link_breadcrumbs($home_name,home_url('/'));
		if(is_category()) {
			echo link_breadcrumbs('SERCH', $serch_page );
			$cat = get_category($wp_query->query_vars['cat']);
			$cat_pankz[] = the_breadcrumbs(get_cat_name($cat->cat_ID));
			foreach (array_reverse($cat_pankz) as $key => $value){
				echo $value;
			}
		} elseif(is_single()) {
			$cat = get_the_category(); $cat = $cat[0];
			$cat_pankz[] = the_breadcrumbs(get_the_title());
			$cat_pankz[] = link_breadcrumbs(get_cat_name($cat->cat_ID),get_category_link($cat->cat_ID));
			while($cat->category_parent != 0){
				$cat = get_category($cat->category_parent);
				$cat_pankz[] = link_breadcrumbs(get_cat_name($cat->cat_ID),get_category_link($cat->cat_ID));
			}
			foreach (array_reverse($cat_pankz) as $key => $value){
				echo $value;
			}
		} elseif(is_tag()){ 
			echo link_breadcrumbs('SERCH', $serch_page );
			if(!empty($tag)){
				echo the_breadcrumbs('検索結果');
				} else {
			$tag_id = $wp_query->query_vars['tag_id'];
			$tag = get_tag($tag_id);
			echo '<li itemscope itemtype="https://data-vocabulary.org/Breadcrumb"><span itemprop="title">'.esc_html($tag->name).'</span></li>' ;}
		} elseif(is_tax()){ 
			echo link_breadcrumbs('SERCH', $serch_page );
			if(!empty($area)){
				echo the_breadcrumbs('検索結果');
				} else {
			echo '<li itemscope itemtype="https://data-vocabulary.org/Breadcrumb"><span itemprop="title">'.esc_html($wp_query->get_queried_object()->name).'</span></li>' ;}
		} elseif(is_search()) {
			echo the_breadcrumbs('検索結果');
		//} elseif(!empty($category_name)||!empty($tag)||!empty($area)){
		//	echo '<li itemtype="https://data-vocabulary.org/Breadcrumb" itemscope=""><span itemprop="title">検索結果</span></li>';
		} elseif(is_404()) {
			echo the_breadcrumbs($not_found);
		} elseif(is_author()){
			$author = get_queried_object();
			echo  '<li itemscope itemtype="https://data-vocabulary.org/Breadcrumb"><a title="'.get_the_title( 7 ).'" href="'.get_the_permalink(7).'" itemprop="url"><span itemprop="title">'.get_the_title( 7 ).'</span></a></li>' ;
			echo the_breadcrumbs($author->display_name);
		} else {
			echo the_breadcrumbs(the_title('','',false));
		}
	}
}

//タイトル関連

function page_title() {
	global $cat_list;
	if(is_home()) {
		echo get_bloginfo('description');
	} elseif(is_category()) {
		echo single_term_title('',false).'の一覧';
	} elseif(is_page()) {
		echo get_the_title();
	} elseif(is_single()) {
		echo get_the_title();
	} elseif(is_search()) {
		//echo get_search_query();
		echo '検索結果';
	} elseif(is_404()){
		echo "ページが見つかりません";
	} elseif(is_tag()) {
		echo single_tag_title('',false).'の一覧';
	} elseif(is_tax()) {
		echo single_term_title('',false).'の一覧';
	} 
}

//投稿サムネイル設定
add_theme_support('post-thumbnails');

//シングルページで投稿者名取得
function single_author() {
	$queried_object = get_queried_object();
	$queried_object = $queried_object -> post_author;
	the_author_meta( 'nickname', $queried_object );
}

/***
 * カスタムフィールドPHP
 */
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_%e3%83%90%e3%83%b3%e3%83%89',
		'title' => 'バンド',
		'fields' => array (
			array (
				'key' => 'field_55d427f78fd81',
				'label' => 'タイトルコメント',
				'name' => 'title_comment',
				'type' => 'text',
				'instructions' => '一覧表示のときに表示されるテキスト。全角100文字前後。',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_55c9bdd8c5bb0',
				'label' => 'トップムービー',
				'name' => 'top_movie',
				'type' => 'text',
				'instructions' => 'youtubeの○○以降を貼り付けてください。youtubeの動画が無いときは480×270でサムネイルを設定してください。',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_55c9b78ba92cc',
				'label' => 'プロフィール',
				'name' => 'profile',
				'type' => 'textarea',
				'instructions' => 'シングルページ表示時のProfileに繁栄されます。改行はbrタグでお願いします。',
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'formatting' => 'br',
			),
			array (
				'key' => 'field_55c9b752a92ca',
				'label' => 'バンドメンバー',
				'name' => 'menber',
				'type' => 'textarea',
				'instructions' => 'シングルページ表示時のMenberに繁栄されます。規定のtableタグを使用してください。',
				'required' => 1,
				'default_value' => '<tbody>
		<tr><th>パート</th><td class="sep">:</td><td>メンバー</td></tr>
		<tr><th>パート</th><td class="sep">:</td><td>メンバー</td></tr>
		<tr><th>パート</th><td class="sep">:</td><td>メンバー</td></tr>
		<tr><th>パート</th><td class="sep">:</td><td>メンバー</td></tr>
	</tbody>',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'formatting' => 'br',
			),
			array (
				'key' => 'field_55c9b777a92cb',
				'label' => 'レビュー',
				'name' => 'review',
				'type' => 'textarea',
				'instructions' => 'シングルページ表示時のReviewに繁栄されます。改行はbrタグでお願いします。',
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'formatting' => 'br',
			),
			array (
				'key' => 'field_55c9bfa350247',
				'label' => '公式HP',
				'name' => 'hp',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_55cb0c0c4c724',
				'label' => 'その他ムービー1',
				'name' => 'other_movies_1',
				'type' => 'text',
				'instructions' => 'youtubeの○○以降を貼り付けてください。',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_55cb0c264c725',
				'label' => 'その他ムービー2',
				'name' => 'other_movies_2',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_55cb0c2b4c726',
				'label' => 'その他ムービー3',
				'name' => 'other_movies_3',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_55cb0c584c727',
				'label' => 'その他ムービー4',
				'name' => 'other_movies_4',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_55cb0c604c728',
				'label' => 'その他ムービー5',
				'name' => 'other_movies_5',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_55cb0c694c729',
				'label' => 'その他ムービー6',
				'name' => 'other_movies_6',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_55cb0c724c72a',
				'label' => 'その他ムービー7',
				'name' => 'other_movies_7',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_55cb0cc7f86bd',
				'label' => 'その他ムービー8',
				'name' => 'other_movies_8',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_55cb0c794c72b',
				'label' => 'その他ムービー9',
				'name' => 'other_movies_9',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_55cb0c864c72c',
				'label' => 'その他ムービー10',
				'name' => 'other_movies_10',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_55dad103f52c3',
				'label' => 'サウンドクラウド1',
				'name' => 'sound_cloud_1',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_56401cffdb310',
				'label' => 'サウンドクラウド2',
				'name' => 'sound_cloud_2',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_564ac421bdcc8',
				'label' => 'サウンドクラウド3',
				'name' => 'sound_cloud_3',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_564ac437bdcc9',
				'label' => 'サウンドクラウド4',
				'name' => 'sound_cloud_4',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_564ac43fbdcca',
				'label' => 'サウンドクラウド5',
				'name' => 'sound_cloud_5',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_564ac44bbdccb',
				'label' => 'サウンドクラウド6',
				'name' => 'sound_cloud_6',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_564ac454bdccc',
				'label' => 'サウンドクラウド7',
				'name' => 'sound_cloud_7',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_564ac461bdccd',
				'label' => 'サウンドクラウド8',
				'name' => 'sound_cloud_8',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_564ac46bbdcce',
				'label' => 'サウンドクラウド9',
				'name' => 'sound_cloud_9',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_564ac474bdccf',
				'label' => 'サウンドクラウド10',
				'name' => 'sound_cloud_10',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_%e3%83%a6%e3%83%bc%e3%82%b6%e3%83%bc%e3%83%9a%e3%83%bc%e3%82%b8',
		'title' => 'ユーザーページ',
		'fields' => array (
			array (
				'key' => 'field_55cd82157b5d1',
				'label' => '好きな音楽ジャンル',
				'name' => 'favorite_genre',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_55cd82a17b5d2',
				'label' => '好きなバンド',
				'name' => 'favorite_band',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_55da79ed28baa',
				'label' => '自己紹介画像',
				'name' => 'my_image',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'ef_user',
					'operator' => '==',
					'value' => 'all',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}


//Gutenbergを使用停止 WordPress Ver 5.0.0から導入されたテキストエディタだが細かい仕様がまだ不明(2018/12/13)なので一旦使用をストップ
add_filter( 'use_block_editor_for_post', '__return_false' );

	
 ?>
