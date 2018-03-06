      <section id="popular_posts">
        <div class="wrap">
        <?php
        //ob_start();
        $args = array(
          'header' => 'Popular Posts',
          'stats_comments' => 0,
          'stats_date' => 1,
          'stats_category' => 1,
          'limit' => 5,
          'range' => 'all',
          'excerpt_format' => 0,
          'excerpt_length' => 80,
          'post_type' => 'post,work,page',
          'thumbnail_width' => 300,
          'thumbnail_height' => 300,
          'post_html' => '
            <li class="wow fadeInLeft">
              <div class="rankbox">
              {thumb}
              <h3>{title}</h3>
              <p class="view_count">{views} view</p>
              <p class="category">{category}</p>
              <div class="excerpt">
                <p>{summary}</p>
              </div>
              </div>
            </li>
          '
          //'post_html' => '{url}::{text_title},'
        );
        wpp_get_mostpopular($args);
        echo '<div class="clearfix"></div>';
        /*
        $popular = ob_get_clean(); //ランキング上位からURLを取得
        $pops = split(',', $popular);//URLとタイトルを抜き出して配列に入れる
        //var_dump($pops);
        foreach($pops as $pop) {
          //var_dump($pop);
          list($url, $title) = split('::', $pop); //URLとタイトルを抜き出す
          $url_post_name = str_replace(home_url(). "/", "", $url); //スラグの部分を抜き出す
          var_dump($url_post_name);
          //var_dump($title);
          $results = $wpdb->get_results( "SELECT id FROM wp_posts WHERE post_name = '". $url_post_name. "'");
	        $url_post_id = $results[0]->id;
	        $imgUrls = wp_get_attachment_image_src( get_post_thumbnail_id($url_post_id), 'medium');
	        //var_dump($imgUrls[0]);
        }
        */
        ?>
        </div>
      </section>
      
      <section id="contact" class="clearfix">
        <div class="wrap">
          <h2>Contact</h2>
          <div class="mail_area">
            <p class="note">Webサイトの制作/コンサル/ライティングのご依頼は下記フォームからご依頼ください。ご連絡お待ちしております。</p>
            <?php echo do_shortcode('[contact-form-7 id="49" title="お問い合わせフォーム"]'); ?>
            
          </div>
          <div id="google_map_area" style=""></div>
          <div id="follow_me">
            <h3>Follow Me</h3>
            <div class="share_btn"><a href="https://twitter.com/yhei_hei"><i class="fa fa-twitter-square"></i></a></div>
            <div class="share_btn"><a href="https://www.facebook.com/youhei.kokubo.33"><i class="fa fa-facebook-square"></i></a></div>
            <div class="share_btn"><a href="https://github.com/yheihei"><i class="fa fa-github-square"></i></a></div>
          </div>
        </div>
      </section>
          </main>
    
    <footer class="container">
      <div class="wrap">
        <div id="f_link" class="clearfix">
          <div class="f_box">
            <h3>エントリー</h3>
            <ul>
              <li><a href="<?php echo get_permalink( get_page_by_path( 'articles' )->ID ); ?>">新着</a></li>
              <li><a href="#popular_posts">人気エントリー</a></li>
            </ul>
          </div>
          <div class="f_box">
            <h3>Yheiを知る</h3>
            <ul>
              <li><a href="<?php echo get_permalink( get_page_by_path( 'about' )->ID ); ?>">経歴</a></li>
              <li><a href="<?php echo get_permalink( get_page_by_path( 'whaticando' )->ID ); ?>">Yheiができること</a></li>
              <li><a href="<?php echo get_post_type_archive_link( 'work' ); ?>">Yheiの仕事実績</a></li>
              <li><a href="<?php echo get_permalink( get_page_by_path( 'order' )->ID ); ?>">発注方法</a></li>
            </ul>
          </div>
          <div class="f_box">
            <a href="<?php echo home_url(); ?>"><img class="u-max-full-width logo" src="<?php echo get_template_directory_uri(); ?>/img/logo_f.png" alt="Yhei Web Design" /></a>
            <p>札幌市東区</p>
            <p><a href="tel:09023145824">090-2314-5824</a></p>
            <p><a href="mailto:yheihei0126@gmail.com">yheihei0126@gmail.com</a></p>
          </div>
        </div>
        <div id="copy">Copyright &copy; <span>Yhei Web Design</span>. 札幌Web制作</div>
      </div>
    </footer>
    <?php wp_footer(); ?>
  </body>
</html>
