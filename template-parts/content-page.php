<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package draft_portfolio
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>  itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
	<meta itemprop='author' content="<?php the_author(); ?>">
	<meta itemprop='description' content="<?php echo get_the_excerpt(); ?>">
	<meta itemprop='datePublished' content="<?php echo get_date_from_gmt(get_post_time('c', true), 'c');?>">
	<meta itemprop='dateModified' content="<?php echo get_date_from_gmt(get_post_modified_time('c', true), 'c');?>">
	<div itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
		<?php if( has_post_thumbnail() ) : ?>
		<meta itemprop="url" content="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'full' ); ?>">
		<?php else: ?>
		<meta itemprop="url" content="<?php echo get_stylesheet_directory_uri(); ?>/img/yhei_web_design_catch-800x640.jpg">
		<?php endif; ?>		
	</div>
	<meta itemscope itemprop="mainEntityOfPage"  itemType="https://schema.org/WebPage" itemid="<?php the_permalink(); ?>"/>
	<div itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
		<div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
			<meta itemprop="url" content="<?php echo get_stylesheet_directory_uri(); ?>/img/yhei_web_design_catch-800x640.jpg">
			<meta itemprop="width" content="800">
			<meta itemprop="height" content="640">
		</div>
		<meta itemprop="name" content="<?php bloginfo( 'name' ) ?>">
	</div>
	<meta itemprop="headline" content="<?php the_title(); ?>">
	<div class='post-thumb'>
		<?php the_post_thumbnail('full'); ?>
	</div>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'draft-portfolio' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						esc_html__( 'Edit %s', 'draft-portfolio' ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-## -->
