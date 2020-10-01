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

	private $blogs_category_id;
	private $diary_category_id;

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
		// 投稿をデータベースへ追加.
		wp_insert_post( $my_post );
		// 投稿オブジェクトを作成.
		$my_post = array(
			'post_title'    => 'My post2',
			'post_content'  => 'This is my post2.',
			'post_status'   => 'publish',
			'post_author'   => 1,
			'post_category' => array( $this->blogs_category_id,$this->diary_category_id ),
		);
		// 投稿をデータベースへ追加.
		wp_insert_post( $my_post );
	}

	public function tearDown() {
		wp_delete_category( $this->blogs_category_id );
		wp_delete_category( $this->diary_category_id );
	}

	/**
	 * @test
	 */
	public function スラグがblogsのカテゴリーを持つ投稿を全て取得できること() {
		$wp_query = createDiaryPostsQuery();
		$this->assertTrue( $wp_query->have_posts() );
	}

	/**
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
