<?php
/**
 * カテゴリーページで記事ではなく子カテゴリー一覧を表示する設定を追加する
 *
 * @test
 * @group task_13
 */

class カテゴリーページで記事ではなく子カテゴリー一覧を表示する設定を追加する extends WP_UnitTestCase {

  public $_category_id;
  public $_category_id_child;
  public $_category_id_child2;
  public $_category_id_other;

  public function setUp() {
    $this->_category_id = wp_create_category( 'コラム' );
    $this->_category_id_child = wp_create_category( '副業のやり方', $this->_category_id );
    $this->_category_id_child2 = wp_create_category( 'bitbucket活用方法', $this->_category_id );
    $this->_category_id_other = wp_create_category( '関係ないカテゴリー', $this->_category_id );
    update_option('yhei_show_list_category_ids', $this->_category_id);
  }

  public function tearDown() {
    update_option('yhei_show_list_category_ids', null);
    wp_delete_category($this->_category_id);
    wp_delete_category($this->_category_id_child);
    wp_delete_category($this->_category_id_child2);
    wp_delete_category($this->_category_id_other);
    update_term_meta( $this->_category_id, 'yhei_category_metas', null );
  }

  /**
   * @test
   */
  public function 対象のカテゴリーを管理画面から指定できること() {
    $this->assertEquals( $this->_category_id, get_show_list_category_ids()[0] );
  }

  /**
   * @test
   */
  public function 対象のカテゴリーを管理画面から複数指定できること() {
    update_option('yhei_show_list_category_ids', $this->_category_id . ',' . $this->_category_id_child);
    $category_ids = get_show_list_category_ids();
    $this->assertEquals( $this->_category_id, get_show_list_category_ids()[0] );
  }

  /**
   * @test
   */
  public function 設定したカテゴリーの直近の子カテゴリーが取得できること() {
    update_option('yhei_show_list_category_ids', $this->_category_id);
    $this->assertEquals( '副業のやり方', get_child_categorys($this->_category_id)[0]->name );
  }

  /**
   * @test
   */
  public function 設定したカテゴリーの直近の子カテゴリーが複数取得できること() {
    update_option('yhei_show_list_category_ids', $this->_category_id);
    $this->assertEquals( 'bitbucket活用方法', get_child_categorys($this->_category_id)[1]->name );
  }

  /**
   * @test
   */
  public function 現在のページが設定したカテゴリーページであるか判定できる() {
    update_option('yhei_show_list_category_ids', $this->_category_id);
    $this->go_to( get_category_link( $this->_category_id ) );
    $this->assertTrue( is_category_list_page() );
  }

  /**
   * @test
   * @group task_3
   */
  public function 設定したカテゴリーページのアイキャッチが取得できる() {
    $category_metas['yhei_category_image'] = 'http://tasaka.local/yhei-web-design.com/wp-content/uploads/2019/07/hage-1024x768.jpeg';
    $category_metas['yhei_category_image_pickup'] = 'http://tasaka.local/yhei-web-design.com/wp-content/uploads/2019/07/hage-300x225.jpeg';
    update_term_meta( $this->_category_id, 'yhei_category_metas', $category_metas );
    $this->assertEquals(
      'http://tasaka.local/yhei-web-design.com/wp-content/uploads/2019/07/hage-1024x768.jpeg',
      get_category_eyecatch( $this->_category_id )
    );
  }

  /**
   * @test
   * @group task_3
   */
  public function 設定したカテゴリーページのピックアップ画像が取得できる() {
    $category_metas['yhei_category_image'] = 'http://tasaka.local/yhei-web-design.com/wp-content/uploads/2019/07/hage-1024x768.jpeg';
    $category_metas['yhei_category_image_pickup'] = 'http://tasaka.local/yhei-web-design.com/wp-content/uploads/2019/07/hage-300x225.jpeg';
    update_term_meta( $this->_category_id, 'yhei_category_metas', $category_metas );
    $this->assertEquals(
      'http://tasaka.local/yhei-web-design.com/wp-content/uploads/2019/07/hage-300x225.jpeg',
      get_category_pickup_image( $this->_category_id )
    );
  }
}