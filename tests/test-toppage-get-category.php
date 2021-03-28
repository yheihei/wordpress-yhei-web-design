<?php
/**
 * Class 特定のカテゴリーの記事を取得できること
 *
 * @package Draft_Portfolio_child
 */

class Test特定のカテゴリーの記事を取得できること extends WP_UnitTestCase {

	/**
	 * テスト用に作成した投稿のIDリスト
	 *
	 * @var array $post_id
	 */
	private $post_ids = array();
	/**
	 * テスト用に作成したカテゴリーID
	 *
	 * @var array $routine_category_id
	 */
	private $routine_category_id;
	/**
	 * テスト用に作成した子カテゴリーのID
	 *
	 * @var array $child_category_id
	 */
	private $child_category_id;

	/**
	 * セットアップ Blogカテゴリーの記事とBlogカテゴリー以外の記事を作る
	 */
	public function setUp() {
		// カテゴリーを定義.
		$cat_option                = array(
			'cat_name'             => 'ルーティン',
			'category_description' => 'ルーティンカテゴリー',
			'category_nicename'    => 'routine',
			'category_parent'      => '',
		);
		$this->routine_category_id = wp_insert_category( $cat_option );

		// ルーティンの子カテゴリーを作成.
		$cat_option              = array(
			'cat_name'             => '筋トレ',
			'category_description' => 'ルーティンの子カテゴリー',
			'category_nicename'    => 'muscle',
			'category_parent'      => $this->routine_category_id,
		);
		$this->child_category_id = wp_insert_category( $cat_option );

		// 投稿オブジェクトを作成.
		$my_post = array(
			'post_title'    => 'My post',
			'post_content'  => 'This is my post.',
			'post_status'   => 'publish',
			'post_author'   => 1,
			'post_category' => array( $this->routine_category_id, $this->child_category_id ),
		);
		// ルーティンの投稿を7記事データベースへ追加.
		for ( $i = 0; $i < 7; $i++ ) {
			$this->post_ids[] = wp_insert_post( $my_post );
		}
		// 1件、ルーティン以外の投稿を用意.
		$this->post_ids[] = wp_insert_post(
			array(
				'post_title'   => 'ルーティン記事以外',
				'post_content' => 'この投稿はルーティンカテゴリではありません。',
			)
		);
	}

	/**
	 * 後処理 使用したカテゴリーや記事の削除
	 */
	public function tearDown() {
		// 使用したカテゴリーの削除.
		wp_delete_category( $this->routine_category_id );
		wp_delete_category( $this->child_category_id );

		// 使用した記事の削除.
		foreach ( $this->post_ids as $post_id ) {
			wp_delete_post( $post_id );
		}
	}

	/**
	 * スラグがroutineのカテゴリーを持つ投稿を取得できること
	 *
	 * @test
	 */
	public function スラグがroutineのカテゴリーを持つ投稿を6件取得できること() {
		$wp_query = create_posts_query_by_category( 'routine', 6 );
		$this->assertEquals( 6, $wp_query->post_count );
	}

	/**
	 * 取得した投稿のカテゴリーがroutineカテゴリーであること
	 *
	 * @test
	 */
	public function 取得した投稿のカテゴリーがroutineカテゴリーであること() {
		$wp_query = create_posts_query_by_category( 'routine', 6 );
		while ( $wp_query->have_posts() ) :
			$wp_query->the_post();
			$categories     = get_the_category( get_the_ID() );
			$category_slugs = array_column( $categories, 'slug' );
			$this->assertTrue( in_array( 'routine', $category_slugs, true ) );
		endwhile;
	}

	/**
	 * 取得した投稿のカテゴリーがroutineの子カテゴリーであること
	 *
	 * @test
	 */
	public function 取得した投稿のカテゴリーがBlogの子カテゴリーであること() {
		$wp_query = create_posts_query_by_category( 'routine', 6 );
		while ( $wp_query->have_posts() ) :
			$wp_query->the_post();
			$categories     = get_the_category( get_the_ID() );
			$category_slugs = array_column( $categories, 'slug' );
			$this->assertTrue( in_array( 'muscle', $category_slugs, true ) );
		endwhile;
	}

	/**
	 * スラグがroutineのカテゴリー一覧のリンクが取得できること
	 *
	 * @test
	 */
	public function スラグがroutineのカテゴリー一覧のリンクが取得できること() {
		$this->assertEquals( home_url() . "/?cat={$this->routine_category_id}", get_category_link_by_slug( 'routine' ) );
	}

	/**
	 * 存在しないスラグのカテゴリー一覧のリンクを取得しようとしたらホームへのリンクとなること
	 *
	 * @test
	 */
	public function 存在しないスラグのカテゴリー一覧のリンクを取得しようとしたらホームへのリンクとなること() {
		$this->assertEquals( home_url(), get_category_link_by_slug( 'hage' ) );
	}
}
