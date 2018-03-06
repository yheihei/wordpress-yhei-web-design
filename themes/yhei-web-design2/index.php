<?php get_header(); //header.phpを取得 ?>

    <section id="cover" style="background-image:url('<?php echo get_template_directory_uri(); ?>/img/cover.png');background-size: cover;">
      <div class="wrap">
        
        <div id="catch_copy" class="wow fadeInUp" data-wow-delay="0.5s">
          <h2>
            <span>札幌のWebデザイナー&ライター</span><br><span>集客できるサイト構築の</span><br><span>お手伝い</span>
          </h2>
        </div>
      </div>
      <div class="sep togreen"></div>
    </section>
    <main class="container">
      <section id="about" class="clearfix">
        <div class="wrap">
          <h2>About Me</h2>
          <div id="face" class="wow fadeInLeft">
            <img src="<?php echo get_template_directory_uri(); ?>/img/yhei.png" alt="小久保 洋平" >
          </div>
          <div id="info" class="wow fadeInUp">
            <h3>Yohei Kokubo</h3>
            <p>ちょっとしたちょっとした略歴ちょっとしたちょっとした略歴ちょっとしたちょっとした略歴ちょっとしたちょっとした略歴ちょっとしたちょっとした略歴ちょっとしたちょっとした略歴ちょっとしたちょっとした略歴ちょっとしたちょっとした略歴</p>
            <div class="c_btn">
              <a href=""></a><p>More</p>
            </div>
            
          </div>
          <div id="skill" class="wow fadeInRight">
            <div class="item">
              <div class="catch">
                <i class="fa fa-photo"></i>
              </div>
              <div class="title">
                <p>Design</p>
              </div>
            </div>
            <div class="item">
              <div class="catch">
                <i class="fa fa-code"></i>
              </div>
              <div class="title">
                <p>Programming</p>
              </div>
            </div>
            <div class="item">
              <div class="catch">
                <i class="fa fa-pencil"></i>
              </div>
              <div class="title">
                <p>Writing</p>
              </div>
            </div>
            <div class="item">
              <div class="catch">
                <i class="fa fa-line-chart"></i>
              </div>
              <div class="title">
                <p>SEO Consulting</p>
              </div>
            </div>
            <div class="c_btn">
              <a href=""></a><p>More</p>
            </div>
          </div>
        </div>
      </section>
      <section id="career" class="clearfix">
        <div class="wrap">
          <h2>Education and Career</h2>
          <div class="box wow fadeInRight" style="background-image:url('<?php echo get_template_directory_uri(); ?>/img/nagoyau.jpg');background-size: cover;">
            <div class="content"></div>
          </div>
          <div class="box white sp wow fadeInLeft">
            <div class="content">
              <div class="time">
                <h3>2004 - 2009</h3>
              </div>
              <div class="place">
                <h3>名古屋大学工学部電気電子情報工学科</h3>
              </div>
              <p>
                説明が入ります説明が入ります説明が入ります説明が入ります説明が入ります説明が入ります説明が入ります説明が入ります説明が入ります説明が入ります説明が入ります説明が入ります説明が入ります説明が入ります説明が入ります説明が入ります説明が入ります説明が入ります。
              </p>
            </div>
          </div>
          <div class="box2 wow fadeInLeft" style="background-image:url('<?php echo get_template_directory_uri(); ?>/img/fujitsu.jpg');background-size: cover;">
            <div class="content"></div>
          </div>
          <div class="box2 white sp wow fadeInRight">
            <div class="content">
              <div class="time">
                <h3>2009 - 2016</h3>
              </div>
              <div class="place">
                <h3>富士通株式会社@さっぽろ</h3>
              </div>
              <p>
                説明が入ります説明が入ります説明が入ります説明が入ります説明が入ります説明が入ります説明が入ります説明が入ります説明が入ります説明が入ります説明が入ります説明が入ります説明が入ります説明が入ります説明が入ります説明が入ります説明が入ります説明が入ります。
              </p>
            </div>
          </div>
          <div class="box wow fadeInRight" style="background-image:url('<?php echo get_template_directory_uri(); ?>/img/free.jpeg');background-size: cover;">
            <div class="content"></div>
          </div>
          <div class="box white sp wow fadeInLeft">
            <div class="content">
              <div class="time">
                <h3>2017 - PRESENT</h3>
              </div>
              <div class="place">
                <h3>フリーランス@さっぽろ</h3>
              </div>
              <p>
                説明が入ります説明が入ります説明が入ります説明が入ります説明が入ります説明が入ります説明が入ります説明が入ります説明が入ります説明が入ります説明が入ります説明が入ります説明が入ります説明が入ります説明が入ります説明が入ります説明が入ります説明が入ります。
              </p>
            </div>
          </div>
        </div>
      </section>
      <section id="portfolio" class="clearfix">
        <div class="wrap">
          <h2>My Portfolio</h2>
          <div class="filter wow fadeInLeft">
            <div class="c_btn">
              <a href="<?php echo get_post_type_archive_link( 'work' ); ?>"></a><p>すべて</p>
            </div>
            <?php
            $taxonomy_name = 'wk_category';
            $taxonomys = get_terms($taxonomy_name);
            if(!is_wp_error($taxonomys) && count($taxonomys)):
              foreach($taxonomys as $taxonomy):
                $tax_posts = get_posts(array('post_type' => 'work', 'taxonomy' => $taxonomy_name, 'term' => $taxonomy->slug ) );
                if($tax_posts):
            ?>
                  <?php $link = get_term_link( $taxonomy->name, 'wk_category' ); ?>
                  <div class="c_btn">
                    <a href="<?php echo $link ?>"></a><p><?php echo $taxonomy->name; ?></p>
                  </div>
            <?php
                endif;
              endforeach;
            endif;
            ?>
          </div>
          
          <div class="list clearfix">
            <?php
              //　--------- Work情報を表示　---------
              $args = array(
                'post_type' => 'work', //カスタム投稿名
                'posts_per_page' => 6,        // 表示数
                'orderby' => 'date',
              	'order'   => 'DESC'
              );
              $the_query = new WP_Query( $args );// 新規WP query を作成　変数args で定義したパラメータを参照
              if ( $the_query->have_posts() ) :
              // ここから表示する内容を記入
              ?>
                <?php while ( $the_query->have_posts() ) : $the_query->the_post();
                  // -------- ここから繰り返し---------- 
                ?>
                  <div class="box wow fadeInRight" style="background-image:url('<?php echo wp_get_attachment_image_src( get_post_thumbnail_id() , 'medium' )[0]; ?>');background-size: cover;">
                    <a href="<?php the_permalink(); ?>"></a>
                    <div class="content"><h3><?php the_title(); ?></h3></div>
                  </div>
                <?php endwhile; ?>
              <?php
              // -------- writing投稿のWP_query終了-----------
              wp_reset_postdata();
              ?>
            <?php else : //条件分岐：投稿が無い場合は ?>
            <h2>投稿「Web制作実績」を作成してください。</h2>
            <?php endif; ?>
          
          </div>
          
          <div class="more">
            <div class="c_btn">
              <a href="<?php echo get_post_type_archive_link( 'work' ); ?>"></a><p>More>></p>
            </div>
          </div>
        </div>
      </section>
      
      <section id="blog" class="clearfix">
        <div class="wrap">
          <h2>Blog</h2>
          <div class="filter wow fadeInLeft" data-wow-delay="0.2s">
            <div class="c_btn">
              <a href="<?php echo home_url()."/blog/"; ?>"></a><p>すべて</p>
            </div>
            <?php //カテゴリーを全取得してリンクを作成
              $cat_all = get_categories();
              foreach($cat_all as $value): ?>
                <div class="c_btn">
                  <a href="<?php echo get_category_link($value); ?>"></a><p><?php echo esc_html($value->name); /* カテゴリ名 */ ?></p>
                </div>
            <?php endforeach; ?>
            <!--
            <div class="c_btn">
              <a href=""></a><p>Webデザイン</p>
            </div>
            <div class="c_btn">
              <a href=""></a><p>Webアプリ</p>
            </div>
            <div class="c_btn">
              <a href=""></a><p>Webコンサル</p>
            </div>
            <div class="c_btn">
              <a href=""></a><p>ライティング</p>
            </div>
            -->
          </div>
          
          <div class="list clearfix">
            <?php
              //　--------- 投稿情報を表示　---------
              $args = array(
                'post_type' => 'post', //カスタム投稿名
                'posts_per_page' => 6        // 表示数
              );
              $the_query = new WP_Query( $args );// 新規WP query を作成　変数args で定義したパラメータを参照
              if ( $the_query->have_posts() ) :
              // ここから表示する内容を記入
              ?>
                <?php while ( $the_query->have_posts() ) : $the_query->the_post();
                  // -------- ここから繰り返し---------- ?>
                  <div class="box wow fadeInRight" style="background-image:url('<?php echo wp_get_attachment_image_src( get_post_thumbnail_id() , 'medium' )[0]; ?>');background-size: cover;">
                    <a href="<?php the_permalink(); ?>"></a>
                    <div class="content"><time><?php the_date(); ?></time><h3><?php the_title(); ?></h3></div>
                  </div>
                <?php endwhile; ?>
              <?php
              // -------- 投稿のWP_query終了-----------
              wp_reset_postdata();
              ?>
              <?php else : //条件分岐：投稿が無い場合は ?>
              <h2>投稿を作成してください。</h2>
              <?php endif; ?>
          
          </div>
          
          <div class="more">
            <div class="c_btn">
              <a href="<?php echo home_url()."/blog/"; ?>"></a><p>More>></p>
            </div>
          </div>
        </div>
      </section>
      
<?php get_footer(); //footer.phpを取得 ?>