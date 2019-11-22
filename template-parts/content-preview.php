<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package draft_portfolio
 */

?>
<article id="post-<?php the_ID(); ?>" <?php 
global $template; // テンプレートファイルのパスを取得
$template_name = basename($template);
if( is_archive() && $template_name === 'archive.php' ) {
	// アーカイブページの場合はサイドバーありのgrid表示クラスにする
	post_class( 'yhei-grid__item yhei-grid__item--primary yhei-post');
} else {
	post_class( 'col-4-12 grid-item mobile-col-6-12 small-col-1');
}
?> itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
	<?php the_blog_post(); ?>
	<div class='post-thumb yhei-post__thumbnail'>
		<a href="<?php the_permalink();?>" >
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail('draft-portfolio-thumbnail', [ 'class' => 'yhei-post__eyecatch' ] ); ?>
		<?php else: ?>
			<img class="yhei-post__eyecatch" width="800" height="640" src="<?php echo get_stylesheet_directory_uri(); ?>/img/yhei_web_design_catch-800x640.jpg" class="attachment-draft-portfolio-thumbnail size-draft-portfolio-thumbnail wp-post-image" alt="<?= $category_name ?>" />
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