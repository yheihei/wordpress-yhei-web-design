<?php
/**
 * Template part for displaying posts on blogs category
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package draft_portfolio
 */

?>

<?php
$the_query = createDiaryPostsQuery();
?>

<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'col-4-12 grid-item mobile-col-6-12 small-col-1'); ?> itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
	<?php the_blog_post(); ?>
	<?php $child_theme_uri  = get_stylesheet_directory_uri(); ?>
		<div class='post-thumb'>
				<a href="<?php the_permalink();?>" >
				<?php 	if ( has_post_thumbnail() ) : ?>
				<?php the_post_thumbnail('draft-portfolio-thumbnail'); ?>
				<?php else: ?>
				<img width="800" height="640" src="<?php echo $child_theme_uri; ?>/img/yhei_web_design_catch-800x640.jpg" class="attachment-draft-portfolio-thumbnail size-draft-portfolio-thumbnail wp-post-image" alt="" />
				<?php endif; ?>
				</a>
		</div>
		<div class='post-title'>
			<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
			
			<p class="date">
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
<?php endwhile; 
// 投稿データのリセット
wp_reset_postdata();
?>