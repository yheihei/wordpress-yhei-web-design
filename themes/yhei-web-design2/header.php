<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?php wp_title( '|', true, 'right' ); //ページタイトルを出力 ?><?php bloginfo('name'); ?></title>
    <?php if(is_single()) : ?>
    <?php
      $postid = get_the_ID(); //表示中のページのIDをとる
      $description = get_post_meta($postid,'description',true);
    ?>
      <meta name="description" content="<?php echo $description; ?>">
    <?php else: ?>
      <meta name="description" content="<?php bloginfo('description'); ?>">
    <?php endif; ?>
    <meta name="author" content="Yohei Kokubo">
    <meta name="keywords" content="札幌 Webデザイン Wordpress 小久保洋平 Web制作">
    
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-52HF2KX');</script>
    <!-- End Google Tag Manager -->
    
    <!-- for SNS top page -->
    <?php if (is_front_page()) : ?>
    <meta property="fb:app_id" content="212653562584844" />
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php wp_title( '|', true, 'right' ); //ページタイトルを出力 ?><?php bloginfo('name'); ?>">
    <meta property="og:url" content="<?php echo home_url(); ?>"> 
    <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/card.png"> 
    <meta property="og:description" content="<?php bloginfo('description'); ?>">
    <meta property="og:site_name" content="<?php wp_title( '|', true, 'right' ); ?><?php bloginfo('name'); ?>">
    
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@yhei_hei">
    <meta name="twitter:creator" content="@yhei_hei">
    <meta name="twitter:title" content="<?php wp_title( '|', true, 'right' ); ?><?php bloginfo('name'); ?>">
    <meta name="twitter:description" content="<?php bloginfo('description'); ?>">
    <meta name="twitter:image:src" content="<?php echo get_template_directory_uri(); ?>/card.png">
    <?php endif; ?>
    
    <!--  blog一覧ページの場合のSNS設定 -->
    <?php if(is_post_type_archive('post')) : ?>
    <meta property="fb:app_id" content="212653562584844" />
    <meta property="og:type" content="website">
    <meta property="og:title" content="ブログ | <?php bloginfo('name'); ?>">
    <meta property="og:url" content="<?php echo (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>"> 
    <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/card.png"> 
    <meta property="og:description" content="Webを使って何かやろうとする経営者、フリーランス必見? Webマーケティング的な記事をほぼ毎日更新します。お仕事依頼はお気軽にContactフォームからご連絡ください。見積もりは無料です。">
    <meta property="og:site_name" content="<?php bloginfo('name'); ?>">
    
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@yhei_hei">
    <meta name="twitter:creator" content="@yhei_hei">
    <meta name="twitter:title" content="ブログ | <?php bloginfo('name'); ?>">
    <meta name="twitter:description" content="Webを使って何かやろうとする経営者、フリーランス必見? Webマーケティング的な記事をほぼ毎日更新します。お仕事依頼はお気軽にContactフォームからご連絡ください。見積もりは無料です。">
    <meta name="twitter:image:src" content="<?php echo get_template_directory_uri(); ?>/card.png">
    <?php endif; ?>
    
    <!--  work一覧ページの場合のSNS設定 -->
    <?php if(is_post_type_archive('work')) : ?>
    <meta property="fb:app_id" content="212653562584844" />
    <meta property="og:type" content="website">
    <meta property="og:title" content="Web制作一覧 | <?php bloginfo('name'); ?>">
    <meta property="og:url" content="<?php echo (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>"> 
    <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/card.png"> 
    <meta property="og:description" content="Webコンサルからデザイン/プログラミングまで経験&有名メディアでWebライティングもやってます。ほぼ一人で戦略もコードもテキストも解析も含めて、ひとつのWebサイトを作れちゃうのが強み。お仕事依頼はお気軽にContactフォームからご連絡ください。見積もりは無料です。">
    <meta property="og:site_name" content="<?php bloginfo('name'); ?>">
    
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@yhei_hei">
    <meta name="twitter:creator" content="@yhei_hei">
    <meta name="twitter:title" content="Web制作一覧 | <?php bloginfo('name'); ?>">
    <meta name="twitter:description" content="Webコンサルからデザイン/プログラミングまで経験&有名メディアでWebライティングもやってます。ほぼ一人で戦略もコードもテキストも解析も含めて、ひとつのWebサイトを作れちゃうのが強み。お仕事依頼はお気軽にContactフォームからご連絡ください。見積もりは無料です。">
    <meta name="twitter:image:src" content="<?php echo get_template_directory_uri(); ?>/card.png">
    <?php endif; ?>
    
    <!--  新着一覧ページの場合のSNS設定 -->
    <?php if(is_page( 'articles' ) ) : ?>
    <meta property="fb:app_id" content="212653562584844" />
    <meta property="og:type" content="website">
    <meta property="og:title" content="新着 お仕事実績&ブログ | <?php bloginfo('name'); ?>">
    <meta property="og:url" content="<?php echo (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>"> 
    <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/card.png"> 
    <meta property="og:description" content="Webを使って何かやろうとする経営者、フリーランス必見? Webマーケティング的な記事をほぼ毎日更新します。お仕事依頼はお気軽にContactフォームからご連絡ください。見積もりは無料です。">
    <meta property="og:site_name" content="<?php bloginfo('name'); ?>">
    
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@yhei_hei">
    <meta name="twitter:creator" content="@yhei_hei">
    <meta name="twitter:title" content="新着 お仕事実績&ブログ | <?php bloginfo('name'); ?>">
    <meta name="twitter:description" content="Webを使って何かやろうとする経営者、フリーランス必見? Webマーケティング的な記事をほぼ毎日更新します。お仕事依頼はお気軽にContactフォームからご連絡ください。見積もりは無料です。">
    <meta name="twitter:image:src" content="<?php echo get_template_directory_uri(); ?>/card.png">
    <?php endif; ?>
    
    <!-- ブログ記事ページの場合のSNS設定 -->
    <?php if(is_single()) : ?>
      <meta property="fb:app_id" content="212653562584844" />
      <meta property="og:type" content="article">
      <meta property="og:title" content="<?php wp_title( '|', true, 'right' ); //ページタイトルを出力 ?><?php bloginfo('name'); ?>">
      <meta property="og:url" content="<?php echo (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>">
      <?php
      $postid = get_the_ID(); //表示中のページのIDをとる
      $description = get_post_meta($postid,'description',true);
      $thumbnail_id = get_post_thumbnail_id( $postid );
      // mediumサイズの画像内容を取得（引数にmediumをセット）
      $eye_img = wp_get_attachment_image_src( $thumbnail_id , 'medium' );
      ?>
      <meta property="og:description" content="<?php echo $description; ?>">
      <meta property="og:image" content="<?php echo $eye_img[0]; ?>"> 
      <meta property="og:site_name" content="<?php bloginfo('name'); ?>">
      
      <meta name="twitter:card" content="summary_large_image">
      <meta name="twitter:site" content="@yhei_hei">
      <meta name="twitter:creator" content="@yhei_hei">
      <meta name="twitter:title" content="<?php wp_title( '|', true, 'right' ); ?><?php bloginfo('name'); ?>">
      <meta name="twitter:description" content="<?php echo $description; ?>">
      <meta name="twitter:image:src" content="<?php echo $eye_img[0]; ?>">
    <?php endif; ?>
    
    <!-- 固定記事ページの場合のSNS設定 -->
    <?php if(is_page() && !is_front_page() && !is_page( 'articles' )) : ?>
      <meta property="fb:app_id" content="212653562584844" />
      <meta property="og:type" content="article">
      <meta property="og:title" content="<?php wp_title( '|', true, 'right' ); //ページタイトルを出力 ?><?php bloginfo('name'); ?>">
      <meta property="og:url" content="<?php echo (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>">
      <?php
      $postid = get_the_ID(); //表示中のページのIDをとる
      $description = get_post_meta($postid,'description',true);
      $thumbnail_id = get_post_thumbnail_id( $postid );
      // mediumサイズの画像内容を取得（引数にmediumをセット）
      $eye_img = wp_get_attachment_image_src( $thumbnail_id , 'medium' );
      ?>
      <meta property="og:description" content="<?php echo $description; ?>">
      <meta property="og:image" content="<?php echo $eye_img[0]; ?>">
      <meta property="og:image:width" content="300">
      <meta property="og:image:height" content="300"> 
      <meta property="og:site_name" content="<?php bloginfo('name'); ?>">
      
      <meta name="twitter:card" content="summary_large_image">
      <meta name="twitter:site" content="@yhei_hei">
      <meta name="twitter:creator" content="@yhei_hei">
      <meta name="twitter:title" content="<?php wp_title( '|', true, 'right' ); ?><?php bloginfo('name'); ?>">
      <meta name="twitter:description" content="<?php echo $description; ?>">
      <meta name="twitter:image:src" content="<?php echo $eye_img[0]; ?>">
    <?php endif; ?>
    
    <!--  タクソノミー一覧ページの場合のSNS設定 -->
    <?php if( is_tax() ) : ?>
    <meta property="fb:app_id" content="212653562584844" />
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php wp_title( '|', true, 'right' ); //ページタイトルを出力 ?><?php bloginfo('name'); ?>">
    <meta property="og:url" content="<?php echo (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>"> 
    <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/card.png">
    <meta property="og:description" content="<?php single_term_title('');  ?>でのお仕事実績一覧です。お仕事依頼はお気軽にContactフォームからご連絡ください。見積もりは無料です。">
    <meta property="og:site_name" content="<?php bloginfo('name'); ?>">
    
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@yhei_hei">
    <meta name="twitter:creator" content="@yhei_hei">
    <meta name="twitter:title" content="<?php wp_title( '|', true, 'right' ); ?><?php bloginfo('name'); ?>">
    <meta name="twitter:description" content="<?php single_term_title('');  ?>でのお仕事実績一覧です。お仕事依頼はお気軽にContactフォームからご連絡ください。見積もりは無料です。">
    <meta name="twitter:image:src" content="<?php echo get_template_directory_uri(); ?>/card.png">
    <?php endif; ?>
    
    <!--  カテゴリー一覧ページの場合のSNS設定 -->
    <?php if( is_category() ) : ?>
    <meta property="fb:app_id" content="212653562584844" />
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php wp_title( '|', true, 'right' ); //ページタイトルを出力 ?><?php bloginfo('name'); ?>">
    <meta property="og:url" content="<?php echo (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>"> 
    <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/card.png">
    <meta property="og:description" content="<?php single_cat_title(''); ?>についてのブログ記事一覧。読み込めばその道の第一人者になれるかも? なれないかも?">
    <meta property="og:site_name" content="<?php bloginfo('name'); ?>">
    
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@yhei_hei">
    <meta name="twitter:creator" content="@yhei_hei">
    <meta name="twitter:title" content="<?php wp_title( '|', true, 'right' ); ?><?php bloginfo('name'); ?>">
    <meta name="twitter:description" content="<?php single_cat_title(''); ?>についてのブログ記事一覧。読み込めばその道の第一人者になれるかも? なれないかも?">
    <meta name="twitter:image:src" content="<?php echo get_template_directory_uri(); ?>/card.png">
    <?php endif; ?>
    
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css?ver=1.3">
    <meta name="copyright" content="Copyright (C) Yhei Web Design All Rights Reserved.">
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png?v=1.0" type="image/ico">
    <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png?v=1.0">
    <!-- jQuery -->
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <!-- 固定menuを動作させるために追加 -->
    <script src="<?php echo get_template_directory_uri(); ?>/js/fixed-menu.js"></script>
    <!-- Font awesome -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/font-awesome/css/font-awesome.min.css">
    <!-- logo font -->
    <link href="//fonts.googleapis.com/css?family=Josefin+Sans:400,400i" rel="stylesheet">
    <!-- animation -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/animate.css">
    <script src="<?php echo get_template_directory_uri(); ?>/js/wow.min.js"></script>
    <script>
      new WOW().init();
    </script>
    <?php wp_head(); //wp_headはテーマの</head>タグ直前に必ず挿入します ?>
  </head>
  <body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-52HF2KX"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <script>
      // deviderの描画処理
      $(function(){
        $(document).ready(function(){
    
          var windowWidth = $(window).width();
          //console.log(windowWidth);
          //width = String(windowWidth/2);
          //console.log(width + 'px!');
          //$('.sep').css({'border-right-width' : width+'px', 'border-left-width' : width+'px'});
          $('.sep').css({'border-right-width' : windowWidth+'px'});
          
          $(window).resize(function() {
            var windowWidth = $(window).width();
            //console.log(windowWidth);
            //width = String(windowWidth/2);
            //console.log(width + 'px!');
            //$('.sep').css({'border-right-width' : width+'px', 'border-left-width' : width+'px'});
            $('.sep').css({'border-right-width' : windowWidth+'px'});
          });
          
        });
      });
    </script>
    
    <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script type="text/javascript">
function googleMap() {
var latlng = new google.maps.LatLng(35.169091, 136.912643);/* 座標 */
var myOptions = {
zoom: 16, /*拡大比率*/
center: latlng,
mapTypeControlOptions: { mapTypeIds: ['style', google.maps.MapTypeId.ROADMAP] }
};
var map = new google.maps.Map(document.getElementById('map1'), myOptions);
/*アイコン設定*/
var icon = new google.maps.MarkerImage('/icon.png',/*画像url*/
new google.maps.Size(70,84),/*アイコンサイズ*/
new google.maps.Point(0,0)/*アイコン位置*/
);
var markerOptions = {
position: latlng,
map: map,
icon: icon,
title: '宗次ホール',/*タイトル*/
animation: google.maps.Animation.DROP/*アニメーション*/
};
var marker = new google.maps.Marker(markerOptions);
/*取得スタイルの貼り付け*/
var styleOptions = [
{
"stylers": [
{ "hue": '#fae053' }
]
}
];
var styledMapOptions = { name: '宗次ホール' }/*地図右上のタイトル*/
var sampleType = new google.maps.StyledMapType(styleOptions, styledMapOptions);
map.mapTypes.set('style', sampleType);
map.setMapTypeId('style');
};
google.maps.event.addDomListener(window, 'load', function() {
googleMap();
});
</script>
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
    
      ga('create', 'UA-99703120-1', 'auto');
      ga('send', 'pageview');
    
    </script>
    <script>
      document.addEventListener( 'wpcf7mailsent', function( event ) {
          ga('send', 'event', 'Contact Form', 'submit');
      }, false );
    </script>
    <header>
      <section id="menu">
        <div class="wrap">
          <h1><a href="<?php echo home_url(); ?>"><img class="u-max-full-width block-center" src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="Yhei Web Design" /></a></h1>
      
          <ul class="pc_navi_ul">
            <li><a href="<?php echo get_permalink( get_page_by_path( 'about' )->ID ); ?>">About</a></li>
            <li><a href="<?php echo get_permalink( get_page_by_path( 'whaticando' )->ID ); ?>">Skill</a></li>
            <li><a href="<?php echo get_post_type_archive_link( 'work' ); ?>">Work</a></li>
            <li><a href="#contact">Contact</a></li>
            <li><a href="<?php echo home_url()."/blog/"; ?>">Blog</a></li>
          </ul>
          <a class="menu-trigger">
          	<span></span>
          	<span></span>
          	<span></span>
          </a>
          <ul class="sp_navi_ul">
            <li><a href="<?php echo get_permalink( get_page_by_path( 'about' )->ID ); ?>">About</a></li>
            <li><a href="<?php echo get_permalink( get_page_by_path( 'whaticando' )->ID ); ?>">Skill</a></li>
            <li><a href="<?php echo get_post_type_archive_link( 'work' ); ?>">Work</a></li>
            <li><a href="#contact">Contact</a></li>
            <li><a href="<?php echo home_url()."/blog/"; ?>">Blog</a></li>
          </ul>
        </div>
      </section>
    </header>