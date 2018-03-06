<?php get_header(); //header.phpを取得 ?>
    <section id="cover" class="post_c" style="background-image:url('<?php echo get_template_directory_uri(); ?>/img/cover.png');background-size: cover;">
      <div class="wrap">
        
      </div>
      <!-- <div class="sep toorange"></div> -->
    </section>
    <main class="container">
      <section id="post" class="clearfix">
        <div class="wrap">
          <?php if ( have_posts() ) : //条件分岐：投稿があるなら ?>
            <?php while ( have_posts() ) : the_post();//繰り返し処理開始 ?>
              <time><?php the_date(); ?></time>
              <h2><?php the_title(); ?></h2>
              <div class="c_btn">
                
                <?php //カテゴリーの表示
                $cat = get_the_category();
                $cat = $cat[0];
                ?>
                <a href="<?php echo esc_url(get_category_link($cat->cat_ID)) ?>"></a><p><?php echo $cat->cat_name ?></p>
              </div>
              <div class="eyecatch wow fadeInLeft">
                <?php the_post_thumbnail( 'full' ); ?>
              </div>
              <div class="description">
                <p>
                  <?php echo get_post_meta($post->ID , 'description' , true); ?>
                </p>
              </div>
              <div class="button-area">
               <div class="button-whole">
                  <a class="button-link opensub" id="twitter"
                     href="http://twitter.com/intent/tweet?text=<?php echo urlencode(the_title("","",0)); ?>%7c<?php bloginfo('name'); ?>&amp;<?php echo urlencode(get_permalink()); ?>&amp;url=<?php echo urlencode(get_permalink()); ?>"
                     target="_blank" title="Twitterで共有">
                     <i class="fa fa-twitter"></i>
                  </a>
               </div>
               <div class="button-whole">
                  <a class="button-link opensub" id="facebook"
                     href="http://www.facebook.com/sharer.php?u=<?php echo urlencode(get_permalink()); ?>&amp;t=<?php echo urlencode(the_title("","",0)); ?>|<?php bloginfo('name'); ?>"
                     target="_blank" title="Facebookで共有">
                     <i class="fa fa-facebook"></i>
                  </a>
               </div>
               <div class="button-whole">
                  <a class="button-link opensub" id="hatena"
                     href="http://b.hatena.ne.jp/add?mode=confirm&amp;url=<?php echo urlencode(get_permalink()); ?>&amp;title=<?php echo urlencode(the_title("","",0)).'|'. get_bloginfo('name'); ?>"
                     target="_blank"
                     data-hatena-bookmark-title="<?php the_permalink(); ?>"
                     title="このエントリーをはてなブックマークに追加">
                     <strong>B!</strong>
                  </a>
               </div>
              </div>
              
              <div class="contents">
                <?php the_content(); //投稿（固定ページ）の本文を表示 ?>
              </div>
              
              <div class="button-area">
                <p>このページをシェアする</p>
               <div class="button-whole">
                  <a class="button-link opensub" id="twitter"
                     href="http://twitter.com/intent/tweet?text=<?php echo urlencode(the_title("","",0)); ?>%7c<?php bloginfo('name'); ?>&amp;<?php echo urlencode(get_permalink()); ?>&amp;url=<?php echo urlencode(get_permalink()); ?>"
                     target="_blank" title="Twitterで共有">
                     <i class="fa fa-twitter"></i>
                  </a>
               </div>
               <div class="button-whole">
                  <a class="button-link opensub" id="facebook"
                     href="http://www.facebook.com/sharer.php?u=<?php echo urlencode(get_permalink()); ?>&amp;t=<?php echo urlencode(the_title("","",0)); ?>|<?php bloginfo('name'); ?>"
                     target="_blank" title="Facebookで共有">
                     <i class="fa fa-facebook"></i>
                  </a>
               </div>
               <div class="button-whole">
                  <a class="button-link opensub" id="hatena"
                     href="http://b.hatena.ne.jp/add?mode=confirm&amp;url=<?php echo urlencode(get_permalink()); ?>&amp;title=<?php echo urlencode(the_title("","",0)).'|'. get_bloginfo('name'); ?>"
                     target="_blank"
                     data-hatena-bookmark-title="<?php the_permalink(); ?>"
                     title="このエントリーをはてなブックマークに追加">
                     <strong>B!</strong>
                  </a>
               </div>
              </div>
              
              <div class="prev">
                <?php if (get_previous_post()):?>
                  <?php previous_post_link(); ?>
                <?php endif; ?>
              </div>
              <div class="next">
                <?php if (get_next_post()):?>
                  <?php next_post_link(); ?>
                <?php endif; ?>
              </div>
            <?php endwhile; // 繰り返し終了 ?>
            <div class="clearfix"></div>
            <div id="related_post_area">
              <?php wp_related_posts()?>
            </div><!-- #related_post_area -->
            
            <?php comments_template(); ?>
          <?php else : //条件分岐：投稿が無い場合は ?>

            <h2>投稿がみつかりません。</h2>
            <p><a href="<?php echo home_url(); ?>">トップページに戻る</a></p>
      
          <?php endif; //条件分岐終了 ?>
        </div>
      </section>

<?php get_footer(); //footer.phpを取得 ?>