<?php
/**
 * Class Blogカテゴリーの記事を取得できること
 *
 * @package Draft_Portfolio_child
 */

/**
 * Sample test case.
 */
class Blogカテゴリーの記事を取得できること extends WP_UnitTestCase {

	private $post_ids = array();
	private $blogs_category_id;
	private $diary_category_id;

	/**
	 * セットアップ Blogカテゴリーの記事とBlogカテゴリー以外の記事を作る
	 */
	public function setUp() {
		// カテゴリーを定義.
		$cat_option = array(
			'cat_name'             => 'Blog',
			'category_description' => 'ブログカテゴリー',
			'category_nicename'    => 'blogs',
			'category_parent'      => '',
		);
		// カテゴリーを作成.
		$this->blogs_category_id = wp_insert_category( $cat_option );
		// 子カテゴリーを定義.
		$cat_option = array(
			'cat_name'             => '日記',
			'category_description' => '日記カテゴリー',
			'category_nicename'    => 'diary',
			'category_parent'      => $this->blogs_category_id,
		);
		// カテゴリーを作成.
		$this->diary_category_id = wp_insert_category( $cat_option );

		// 投稿オブジェクトを作成.
		$my_post = array(
			'post_title'    => 'My post',
			'post_content'  => 'This is my post.',
			'post_status'   => 'publish',
			'post_author'   => 1,
			'post_category' => array( $this->blogs_category_id, $this->diary_category_id ),
		);
		// ブログの投稿を7記事データベースへ追加.
		for ( $i = 0; $i < 7; $i++ ) {
			$this->post_ids[] = wp_insert_post( $my_post );
		}
		// 1件、ブログ以外の投稿を用意.
		$this->post_ids[] = wp_insert_post(
			array(
				'post_title'   => 'ブログ記事以外',
				'post_content' => 'この投稿はブログではありません。',
			)
		);
	}

	/**
	 * 後処理 使用したカテゴリーや記事の削除
	 */
	public function tearDown() {
		// 使用したカテゴリーの削除.
		wp_delete_category( $this->blogs_category_id );
		wp_delete_category( $this->diary_category_id );

		// 使用した記事の削除.
		foreach ( $this->post_ids as $post_id ) {
			wp_delete_post( $post_id );
		}
	}

	/**
	 * スラグがblogsのカテゴリーを持つ投稿を3件取得できること
	 *
	 * @test
	 */
	public function スラグがblogsのカテゴリーを持つ投稿を3件取得できること() {
		$wp_query = createDiaryPostsQuery();
		$this->assertEquals( 3, $wp_query->post_count );
	}

	/**
	 * 取得した投稿のカテゴリーがBlogカテゴリーであること
	 *
	 * @test
	 */
	public function 取得した投稿のカテゴリーがBlogカテゴリーであること() {
		$wp_query = createDiaryPostsQuery();
		while ( $wp_query->have_posts() ) :
			$wp_query->the_post();
			$categories     = get_the_category( get_the_ID() );
			$category_slugs = array_column( $categories, 'slug' );
			$this->assertTrue( in_array( 'blogs', $category_slugs, true ) );
		endwhile;
	}

	/**
	 * 取得した投稿のカテゴリーがBlogの子カテゴリーであること
	 *
	 * @test
	 */
	public function 取得した投稿のカテゴリーがBlogの子カテゴリーであること() {
		$wp_query = createDiaryPostsQuery();
		while ( $wp_query->have_posts() ) :
			$wp_query->the_post();
			$categories     = get_the_category( get_the_ID() );
			$category_slugs = array_column( $categories, 'slug' );
			$this->assertTrue( in_array( 'diary', $category_slugs, true ) );
		endwhile;
	}
}
