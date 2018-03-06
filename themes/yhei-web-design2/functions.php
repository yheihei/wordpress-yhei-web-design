<?php
/**
 * アイキャッチ画像の機能を有効化
 */

add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 300, 300, true ); // 初期設定の投稿サムネイル値

/**
 * サムネイル画像の定義
 */
 
if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'writing-thumb', 520, 320, true ); //(切り抜かれた大きさ)
	add_image_size( 'archive-thumb', 300, 300, true ); //(切り抜かれた大きさ)
}

add_filter( 'post_thumbnail_html', 'custom_attribute' );
function custom_attribute( $html ){
    // サムネイルのimgタグのheight を削除する
    //$html = preg_replace('/(height)="\d*"\s/', '', $html);
    return $html;
}

/*
 * 投稿にアーカイブ(投稿一覧)を持たせるようにします。
 * ※ 記載後にパーマリンク設定で「変更を保存」してください。
 */
function post_has_archive( $args, $post_type ) {
	if ( 'post' == $post_type ) {
		$args['rewrite'] = true;
		$args['has_archive'] = 'blog'; // ページ名
	}
	return $args;
}
add_filter( 'register_post_type_args', 'post_has_archive', 3, 2 );