<?php get_header(); //header.phpを取得 ?>
    <section id="cover" class="archive" style="background-image:url('<?php echo get_template_directory_uri(); ?>/img/cover.png');background-size: cover;">
      <div class="wrap">
      </div>
      <!-- <div class="sep toorange"></div> -->
    </section>
    <main class="container">
      <section id="archieve" class="clearfix">
        <div class="wrap">
          <h2>Blog</h2>
          <div class="filter wow fadeInLeft">
            <div class="c_btn">
              <a href="<?php echo home_url()."/blog/"; ?>"></a><p>すべて</p>
            </div>
            <?php //カテゴリーを全取得してリンクを作成
              $cat_all = get_categories();
              foreach($cat_all as $value): ?>
                <?php //開いているページのカテゴリー名であればカテゴリー表示をうすくする
                if($value->name === single_cat_title('', false)) : ?>
                <div class="c_btn" style="opacity:0.3;">
                <?php else : ?>
                <div class="c_btn">
                <?php endif; ?>
                  <a href="<?php echo get_category_link($value); ?>"></a><p><?php echo esc_html($value->name); /* カテゴリ名 */ ?></p>
                </div>
            <?php endforeach; ?>
          </div>
          
          <div class="list clearfix">
            <?php 
              if ( have_posts() ) :
              // ここから表示する内容を記入
              ?>
              <div class="post-list">
              <ul class="wpp-list wow fadeInRight">
              <?php while ( have_posts() ) : the_post();
              // -------- ここから繰り返し---------- ?>
                <li>
                  <div class="kiji">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_self">
                      <?php the_post_thumbnail('archive-thumb',
                        array('class' => 'wpp-thumbnail') ); ?>
                    </a>
                    <div class="time">
                      <h3><?php the_time('Y年m月d日(D)') ; ?></h3>
                    </div>
                    <h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="wpp-post-title" target="_self"><?php the_title(); ?></a></h3>
                    <!-- <p class="category"><?php the_category(', '); ?></p> -->
                    <p class="category"><?php the_category(' '); ?></p>
                    <div class="excerpt">
                      <?php $description = get_post_meta($post->ID , 'description' , true);
                        if($description !== '') : ?>
                        <p><?php echo $description; ?></p>
                      <?php else : ?>
                        <p><?php the_excerpt(); ?></p>
                      <?php endif; ?>
                    </div>
                  </div>
                </li>
              <?php // -------- 繰り返しここまで-----------
              endwhile; ?>
              </ul>
              </div>
          </div>
          
          <?php if (!is_null(get_previous_posts_link())):?>
          <div class="prev">
            <div class="c_btn">
              <?php previous_posts_link('') ?><p>< Prev</p>
            </div>
          </div>
          <?php endif; ?>
          <?php if (!is_null(get_next_posts_link())):?>
          <div class="next">
            <div class="c_btn">
              <?php next_posts_link('') ?><p>More ></p>
            </div>
          </div>
          <?php endif ?>
          <?php
              // -------- 投稿のWP_query終了-----------
              wp_reset_postdata();
              ?>
              <?php else : //条件分岐：投稿が無い場合は ?>
              <h2>投稿を作成してください。</h2>
              <?php endif; ?>
        </div>
      </section>
      
      <?php get_footer(); //footer.phpを取得 ?>