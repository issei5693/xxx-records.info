<?php
/*
Template Name: author
*/
get_header(); ?>
<div id="single" class="author">

<h2>Author</h2>

<?php $users = get_users( array('orderby'=>ID,'order'=>ASC) );
	foreach($users as $user):
	$uid = $user->ID;
	$userData = get_userdata($uid); ?>
	
	<div class="author_box">
		<h3><?php echo $user->display_name; ?></h3>
		<div class="author_box_inner">
			<figure>
				<?php $my_image = get_user_meta( $uid , 'my_image' ,true); ?>
							<?php if( empty($my_image) ){ ?>
								<!-- <img src="<?php bloginfo('template_url'); ?>/images/no_image.jpg" /> -->
								<img src="https://dummyimage.com/500x500/000/fff" />
							<?php	} else { ?>
								<img src="<?php bloginfo('template_url'); ?>/images/<?php echo get_user_meta( $uid , 'my_image' ,true); ?>" />
								<?php }?>
			</figure>
			<p>
				<?php echo get_the_author_meta( 'description', $uid ); ?> 
			</p>
		</div><!-- /.author_box_inner -->
		<dl class="favorite_genre">
			<dt><span>Favorite Genre</span></dt>
			<dd><?php echo get_user_meta( $uid, 'favorite_genre',true ) ;?></dd>
		</dl>
		<dl class="favorite_band">
			<dt><span>Favorite Band</span></dt>
			<dd><?php echo get_user_meta( $uid, 'favorite_band',true ) ;?></dd>
		</dl>
		<div class="introduction">
			<a href="<?php echo get_author_posts_url($uid); ?>"><?php echo $user->display_name; ?>'s Introduction</a>
		</div>
	</div><!-- /.author_box -->
	
	<?php endforeach; ?>

	</div><!-- /#single -->

<?php get_footer(); ?>