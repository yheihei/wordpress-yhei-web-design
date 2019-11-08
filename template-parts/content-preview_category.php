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
// 表示されているカテゴリーの直近1つの子カテゴリーの情報を取得
$child_categorys = get_child_categorys($current_term->term_id);
foreach( $child_categorys as $child_category ) :
  $child_theme_uri  = get_stylesheet_directory_uri();
  $category_id   = $child_category->term_id;
  $category_name = $child_category->name;
  $category_slug = $child_category->slug;
  $category_url = get_category_link($category_id);
?>
  <article id="post-<?= $category_id ?>" <?php post_class( 'grid-item yhei-grid-item col-6-12-custom mobile-col-6-12 small-col-1'); ?>>
    <div class='post-thumb'>
        <a href="<?php echo $category_url;?>" >
          <img width="800" height="640" src="<?php echo $child_theme_uri; ?>/img/yhei_web_design_catch-800x640.jpg" class="attachment-draft-portfolio-thumbnail size-draft-portfolio-thumbnail wp-post-image" alt="<?= $category_name ?>" /> 
        </a>
    </div>
    <div class='post-title'>
    <h2 class="entry-title"><a href="<?php echo $category_url; ?>" rel="bookmark">
      <?php echo $category_name; ?>
    </h2>
    </div>
  </article><!-- #post-## -->
<?php endforeach; ?>