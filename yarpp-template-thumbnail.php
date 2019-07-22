<?php
/*
YARPP Template: Thumbnails
Description: Requires a theme which supports post thumbnails
Author: mitcho (Michael Yoshitaka Erlewine)
*/ ?>
<h3 class="heading heading--dropcap yarpp-related--custom">Related Posts<span class="heading__caption heading__caption--small">こちらも読まれています</span></h3>
<?php if (have_posts()):?>
	<?php while (have_posts()) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class( 'col-6-12-custom grid-item mobile-col-6-12 small-col-1'); ?>>
			<div class='post-thumb'>
					<a href="<?php the_permalink();?>" >
					<?php if (has_post_thumbnail()):?>
					<?php the_post_thumbnail('draft-portfolio-thumbnail'); ?>
					<?php else: ?>
					<img width="800" height="640" src="<?php echo get_stylesheet_directory_uri(); ?>/img/yhei_web_design_catch-800x640.jpg" class="attachment-draft-portfolio-thumbnail size-draft-portfolio-thumbnail wp-post-image" alt="" />
					<?php endif; ?>
					</a>
			</div>
			<div class='post-title'>
				<?php the_title( '<h4 class="entry-title entry--related"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' ); ?>
				
				<p class="date date--small">
					<?php the_time('Y.m.d'); ?>
				</p>
			</div>

			<div class="overbox">
				<div class="title overtext"> 
					<?php //the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
				</div>
				<div class="tagline overtext"> <?php draft_portfolio_category();?> </div>
			</div>
		</article><!-- #post-## -->
	<?php endwhile; ?>

<?php else: ?>
<p>関連記事がありません</p>
<?php endif; ?>
