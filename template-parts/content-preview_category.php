<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package draft_portfolio
 */

?>

<?php
// 現在表示されているカテゴリーを取得
$current_term = get_current_term();
?>
<?php if( $current_term->description ) : ?>
<article id="post-<?= $current_term->term_id ?>" <?php post_class(); ?> >
  <div class="entry-content entry-content--category">
    <?php echo $current_term->description; ?>
  </div><!-- .entry-content -->
</article>
<?php endif; ?>
<div class="yhei-grid">
  <?php
  // 表示されているカテゴリーの直近1つの子カテゴリーの情報を取得
  $child_categorys = get_child_categorys($current_term->term_id);
  foreach( $child_categorys as $child_category ) :
    $child_theme_uri  = get_stylesheet_directory_uri();
    $category_id   = $child_category->term_id;
    $category_name = $child_category->name;
    $category_slug = $child_category->slug;
    $category_url = get_category_link($category_id);
    $category_eyecatch_url = get_category_eyecatch( $category_id );
  ?>
    <article id="post-<?= $category_id ?>" <?php post_class( 'yhei-grid__item yhei-grid__item--primary yhei-post'); ?>>
      <div class='post-thumb yhei-post__thumbnail'>
          <a href="<?php echo $category_url;?>" >
            <?php if($category_eyecatch_url) :  ?>
              <img src="<?php echo $category_eyecatch_url; ?>" class="yhei-post__eyecatch" alt="<?= $category_name ?>" />
            <?php else: ?>
              <img width="800" height="640" src="<?php echo $child_theme_uri; ?>/img/yhei_web_design_catch-800x640.jpg" class="yhei-post__eyecatch" alt="<?= $category_name ?>" />
            <?php endif; ?>
          </a>
      </div>
      <div class='post-title'>
      <h2 class="entry-title">
        <a href="<?php echo $category_url; ?>" rel="bookmark">
        <?php echo $category_name; ?>
        </a>
      </h2>
      </div>
    </article><!-- #post-## -->
  <?php endforeach; ?>
</div>