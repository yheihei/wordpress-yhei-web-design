<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package draft_portfolio
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting" >
		<meta itemprop='author' content="<?php the_author(); ?>">
		<meta itemprop='description' content="<?php the_excerpt(); ?>">
		<meta itemprop='datePublished' content="<?php echo get_date_from_gmt(get_post_time('c', true), 'c');?>">
		<meta itemprop='dateModified' content="<?php echo get_date_from_gmt(get_post_modified_time('c', true), 'c');?>">
		<div class='post-thumb' itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
				
				<?php the_post_thumbnail('full'); ?>
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
	<header class="entry-header">
		<?php
		if ( is_single() ) :
			the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title" itemprop="headline"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark" itemprop="mainEntityOfPage">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php draft_portfolio_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'draft-portfolio' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'draft-portfolio' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php draft_portfolio_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
