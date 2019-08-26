<?php
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_parent_theme_file_uri() . '/style.css' );
    // Theme stylesheet.
	wp_enqueue_style( 'draft-portfolio-style', get_stylesheet_uri(), null, filemtime( get_stylesheet_directory() . '/style.css'), null );
}

// 親カテゴリーのアーカイブを子カテゴリーも使う
add_filter( 'category_template', 'my_category_template' );
function my_category_template( $template ) {
$category = get_queried_object();
if ( $category->parent == 14 ) { // 親カテゴリーのIDを指定
$templates = array();
while ( $category->parent ) {
$category = get_category( $category->parent );
if ( !isset( $category->slug ) ) break;
$templates[] = "category-{$category->slug}.php";
$templates[] = "category-{$category->term_id}.php";
}
$templates[] = "category.php";
$template = locate_template( $templates );
}
return $template;
}

/**
 * Home画面でPortfolioカテゴリーの記事とその子カテゴリーの記事のみ取得する
 */
function yhei_home_change_sort_order( $query ) {
  if ( is_admin() || ! $query->is_main_query() ) {
    return;
  }

  if ( $query->is_home() ) {
    $idObj = get_category_by_slug( 'portfolio' );
    $category_id = $idObj->term_id;
    if($category_id) {
      $query->set( 'cat', $category_id );
    }
  }
}
add_action( 'pre_get_posts', 'yhei_home_change_sort_order' );

function createDiaryPostsQuery() {
  $args = array( 
    'category_name' => 'blogs',
    'posts_per_page' => 3, 
  );
  return new WP_Query( $args );
}

function the_blog_post() {
  ?>
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
<?php  
}