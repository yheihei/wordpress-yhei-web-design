<?php
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_parent_theme_file_uri() . '/style.css' );
    // Theme stylesheet.
  wp_enqueue_style( 'draft-portfolio-style', get_stylesheet_uri(), null, filemtime( get_stylesheet_directory() . '/style.css'), null );
}

/**
 * 管理画面
 */
/**
 * トップに表示するカテゴリーやタグの設定
 */
add_action('admin_menu', 'top_category_menu');
function top_category_menu() {
  add_menu_page('子テーマカスタマイズ', '子テーマカスタマイズ', 'administrator', __FILE__, 'child_setting_page','',61);
  add_action( 'admin_init', 'register_draft_portfolio_child_settings' );
}
function register_draft_portfolio_child_settings() {
  // カテゴリーページ設定
  register_setting( 'category-settings-group', 'yhei_show_list_category_ids' );
}
function child_setting_page() {
?>
  <div class="wrap">
    <h2>カテゴリーページ表示設定</h2>
    <form method="post" action="options.php">
      <?php 
        settings_fields( 'category-settings-group' );
        do_settings_sections( 'category-settings-group' );
      ?>
      <table class="form-table">
        <tbody>
          <tr>
            <th scope="row">
              <label for="yhei_show_list_category_ids">直近の子カテゴリーの一覧を表示するカテゴリーID(ex. 催事別カテゴリーページ)</label>
            </th>
              <td>
                <input type="text" 
                  id="yhei_show_list_category_ids" 
                  class="regular-text" 
                  name="yhei_show_list_category_ids" 
                  value="<?php echo get_option('yhei_show_list_category_ids'); ?>"
                  placeholder="2,8,10,12 (カテゴリーIDをカンマ区切りで入力)"
                >
              </td>
          </tr>
        </tbody>
      </table>
      <?php submit_button(); ?>
    </form>
  </div>
<?php
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

/**
 * WordPressループ内で使用すると、記事の情報をもとにblogPostingのスニペットを出力する
 */
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

// 続きを読むボタンのカスタマイズ
function modify_read_more_link() {
  return '<div class="more-link"><a class="more-link--link more-link__default" href="' . get_permalink() . '">......More</a></div>';
}
add_filter( 'the_content_more_link', 'modify_read_more_link' );

/**
 * Prints HTML with meta information for the current post-date/time and author.
 * 投稿情報表示関数(親テーマの関数を上書き)
 * 投稿者名は非表示にした
 */
function draft_portfolio_posted_on() {
  $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
  if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
    $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
  }

  $time_string = sprintf( $time_string,
    esc_attr( get_the_date( 'c' ) ),
    esc_html( get_the_date() ),
    esc_attr( get_the_modified_date( 'c' ) ),
    esc_html( get_the_modified_date() )
  );

  $posted_on = sprintf(
    esc_html_x( 'Posted on %s', 'post date', 'draft-portfolio' ),
    '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
  );

  echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

}

/**
 * 子カテゴリー一覧を表示するカテゴリーIDリストを取得
 */
function get_show_list_category_ids() {
  $category_ids = get_option('yhei_show_list_category_ids');
  if( !$category_ids ) {
    return [];
  }
  // 空白除去
  $category_ids  = preg_replace("/( |　)/", "", $category_ids );
  $category_ids = explode(",", $category_ids);
  return $category_ids;
}

/**
 * 設定したカテゴリーの直近の子カテゴリーが取得できること
 */
function get_child_categorys($category_id){
  $child_categorys = get_terms( 'category', array(
    'parent' => $category_id,
    'hide_empty' => false,
    'orderby' => 'term_order',
  ));
  return $child_categorys;
}

/**
 * アーカイブページで 現在のカテゴリーを取得する
 */
function get_current_term(){
  $id = 0;
  $tax_slug = '';

  if(is_category()){
      $tax_slug = "category";
      $id = get_query_var('cat'); 
  }else if(is_tag()){
      $tax_slug = "post_tag";
      $id = get_query_var('tag_id');  
  }else if(is_tax()){
      $tax_slug = get_query_var('taxonomy');  
      $term_slug = get_query_var('term'); 
      $term = get_term_by("slug",$term_slug,$tax_slug);
      $id = $term->term_id;
  }
  return get_term($id,$tax_slug);
}

function is_category_list_page() {
  // 特定のカテゴリーページの場合、直近の子カテゴリーのみ一覧表示する
  $category_list_ids = get_show_list_category_ids();
  //現在表示されているカテゴリーを取得
  $current_term = get_current_term();
  return !empty($category_list_ids) && in_array((string)$current_term->term_id, $category_list_ids, true);
}

// カテゴリーページの編集画面
get_template_part( 'include/custom-category' );

/**
 * 人気記事一覧の出力カスタマイズ
 */
function custom_single_popular_post( $content, $post, $instance ){
  $image_url = get_the_post_thumbnail_url( $post->id, 'draft-portfolio-thumbnail' );
  if( !$image_url ) {
    $image_url = get_default_eyecatch_url();
  }
  $post_url = get_permalink( $post->id );
  $output = <<<EOM
<li class='yhei-post'>
  <div class='yhei-post__thumbnail'>
    <a href="$post_url" >
      <img width="800" height="640" src="$image_url" class="attachment-draft-portfolio-thumbnail size-draft-portfolio-thumbnail wp-post-image yhei-post__eyecatch" alt="$post->title" />
    </a>
  </div>
  <div class='yhei-post__description'>
    <h2 class="yhei-post__title yhei-post__title--h2"><a href="$post_url" rel="bookmark">$post->title</a></h2>
    <p class="yhei-post__view-counts yhei-post__view-counts--default">
      $post->pageviews views
    </p>
  </div>
</li>
EOM;
  return $output;
}
add_filter( 'wpp_post', 'custom_single_popular_post', 10, 3 );

function get_default_eyecatch_url() {
  $child_theme_uri  = get_stylesheet_directory_uri();
  return $child_theme_uri . "/img/yhei_web_design_catch-800x640.jpg";
}

/**
 * Contact Form7 完了ページの遷移処理
 */
add_action( 'wp_footer', 'add_thanks_page' );
function add_thanks_page() {
  $home_url = home_url();
  echo <<< EOD
<script>
document.addEventListener( 'wpcf7mailsent', function( event ) {
  location = '${home_url}/contact-complete/'; /* 遷移先のURL */
}, false );
</script>
EOD;
}

/**
 * 記事下CTAウィジェット追加
 */
add_action('widgets_init', 'add_cta_after_posts_widget');
function add_cta_after_posts_widget() {
  register_sidebar(array(
    'id' => 'yhei_cta_after_posts',
    'name' => '記事下CTA',
    'description' => '記事下に表示されるコンテンツ',
    'before_widget' => '<div>',
    'after_widget' => "</div>\n",
  ));
}

/**
 * 特定のカテゴリーの記事を取得する
 *
 * @param string $category_slug_name カテゴリーのスラグ名.
 * @param int    $posts_per_page     何件取得するか.
 * @return WP_Query
 */
function create_posts_query_by_category( $category_slug_name, $posts_per_page = 3 ) {
	$args = array(
		'category_name'  => $category_slug_name,
		'posts_per_page' => $posts_per_page,
	);
	return new WP_Query( $args );
}

/**
 * 特定のカテゴリーのカテゴリー一覧のリンクを取得する
 *
 * @param string $category_slug_name カテゴリーのスラグ名.
 * @return string
 * @throws InvalidArgumentException  Cカテゴリーが存在しなければException.
 */
function get_category_link_by_slug( $category_slug_name ) {
	// 指定したカテゴリーの ID を取得.
	$category    = get_category_by_slug( $category_slug_name );
	$category_id = $category->term_id ?? null;
	if ( null === $category_id ) {
		return home_url();
	}
	// このカテゴリーの URL を取得.
	return get_category_link( $category_id );
}
