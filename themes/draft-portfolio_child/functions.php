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
