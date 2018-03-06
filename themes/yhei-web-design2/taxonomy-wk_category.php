<?php get_header(); //header.phpを取得 ?>
    <section id="cover" class="archive" style="background-image:url('<?php echo get_template_directory_uri(); ?>/img/cover.png');background-size: cover;">
      <div class="wrap">
      </div>
      <!-- <div class="sep toorange"></div> -->
    </section>
    <main class="container">
      <section id="archieve" class="clearfix">
        <div class="wrap">
          <h2>My Work</h2>
          <div class="filter wow fadeInLeft">
            <div class="c_btn">
              <a href="<?php echo get_post_type_archive_link( 'work' ); ?>"></a><p>すべて</p>
            </div>
            <?php //カテゴリーを全取得して表示
            $taxonomy_name = 'wk_category';
            $taxonomys = get_terms($taxonomy_name);
            if(!is_wp_error($taxonomys) && count($taxonomys)):
              foreach($taxonomys as $taxonomy):
                $tax_posts = get_posts(array('post_type' => 'work', 'taxonomy' => $taxonomy_name, 'term' => $taxonomy->slug ) );
                if($tax_posts):
            ?>
                  <?php $link = get_term_link( $taxonomy->name, 'wk_category' ); ?>
                  <?php
                  if($taxonomy->name === single_term_title("", false)): //開いているページのカテゴリー名であればカテゴリー表示をうすくする ?>
                  <div class="c_btn" style="opacity: 0.3;">
                  <?php else : ?>
                  <div class="c_btn">
                  <?php endif; ?>
                    <a href="<?php echo $link ?>"></a><p><?php echo $taxonomy->name; ?></p>
                  </div>
            <?php
                endif;
              endforeach;
            endif;
            ?>
          </div>
          
          <div class="post-list">
            <ul class="wpp-list wow fadeInRight">
            <?php 
              if ( have_posts() ) :
              // ここから表示する内容を記入
              ?>
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
                    <?php //カテゴリーの表示
                    $terms = get_the_terms($post->ID,'wk_category');
                    $term_link = get_term_link( $terms[0] );
                    ?>
                    <p class="category"><a href="<?php echo esc_url($term_link) ?>"><?php echo $terms[0]->name; ?></a></p>
                    <p class="client">
                      <?php 
                        $client_url = get_post_meta($post->ID , 'client_url' , true);
                        if ($client_url != '') :
                      ?>
                      クライアント: <a href="<?php echo get_post_meta($post->ID , 'client_url' , true); ?>"><?php echo get_post_meta($post->ID , 'client_name' , true); ?></a>
                      <?php else : ?>
                      クライアント: <?php echo get_post_meta($post->ID , 'client_name' , true); ?>
                      <?php endif; ?>
                    </p>
                    <p class="media">
                      <?php 
                        $media_url = get_post_meta($post->ID , 'media_url' , true);
                        if ($media_url != '') :
                      ?>
                      掲載先　　　: <a href="<?php echo get_post_meta($post->ID , 'media_url' , true); ?>"><?php echo get_post_meta($post->ID , 'media_name' , true); ?></a>
                      <?php else : ?>
                      掲載先　　　: <?php echo get_post_meta($post->ID , 'media_name' , true); ?>
                      <?php endif; ?>
                    </p>
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