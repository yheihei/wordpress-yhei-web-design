<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package draft_portfolio
 */

get_header(); ?>

  <div id="primary" class="content-area">
    <main id="main" class="site-main col-8-12-custom" role="main">
    <?php if ( is_category() ) : ?>
      <?php
      $cat_info = get_category( $cat );
      ?>
      <div class="welcome">
          <h1 class="heading heading--primary heading--dropcap"><?php echo wp_specialchars( $cat_info->name ); ?></h1>
      </div>
    <?php endif; ?>

    <?php
    if(is_category_list_page()) : 
      // 特定のカテゴリーページの場合、直近の子カテゴリーのみ一覧表示する
      get_template_part( 'template-parts/content', 'preview_category' );
    else :
      // 通常のカテゴリーページ
      if ( have_posts() ) : ?>

        <?php
        /* Start the Loop */
        ?>
        <div class="yhei-grid" >
        <?php
        while ( have_posts() ) : the_post();

          /*
          * Include the Post-Format-specific template for the content.
          * If you want to override this in a child theme, then include a file
          * called content-___.php (where ___ is the Post Format name) and that will be used instead.
          */
          // get_template_part( 'template-parts/content', get_post_format() );
          get_template_part( 'template-parts/content', 'preview' );

        endwhile;
        ?>
        </div>
        <?php
        get_template_part( 'pagination' ); 

      else :

        get_template_part( 'template-parts/content', 'none' );

      endif; ?>

    <?php endif ; ?>
    </main><!-- #main -->
  </div><!-- #primary -->

<?php
get_sidebar(); 
get_footer();
