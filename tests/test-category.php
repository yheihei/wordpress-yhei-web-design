<?php
/**
 * カテゴリー関連のテスト
 *
 * @test
 * @group issue_14
 */

class カテゴリー関連のテスト extends WP_UnitTestCase {

  public $_category_id;
  public $_category_id_child;
  public $_post_id;

  public function setUp() {
    $this->_category_id = wp_create_category( 'コラム' );
    $this->_category_id_child = wp_create_category( '副業のやり方', $this->_category_id );
    // 投稿オブジェクトを作成
    $my_post = array(
      'post_title'    => 'My post',
      'post_content'  => 'This is my post.',
      'post_status'   => 'publish',
      'post_author'   => 1,
      'post_category' => array( $this->_category_id, $this->_category_id_child )
    );
    // 投稿をデータベースへ追加
    $this->_post_id = wp_insert_post( $my_post );
  }

  public function tearDown() {
    wp_delete_category( $this->_category_id );
    wp_delete_category( $this->_category_id_child) ;
    wp_delete_post( $this->_post_id, true );
  }

  /**
   * @test
   */
  public function 対象のカテゴリーを管理画面から指定できること() {
    $this->go_to( get_the_permalink( $this->_post_id ) );
    $cat_link = get_the_category_list();
    var_dump($cat_link);
  }

  /**
   * @test
   */
  public function カテゴリーの名前に指定の文字列があること() {
    $category = get_category_name();
    $this->assertEquals('ほげ', $category);
  }
}