jQuery(function($) {

  var offset = 120;

  $(window).on('scroll' , function(){
    if ($(window).scrollTop() > offset) {
      //下にスクロール時
      $('header').css( 'height', offset/2 + 'px');
      $('#menu img').css( 'padding-top', '6px');
      $('#menu ul.pc_navi_ul').css( 'padding-top', '18px');
      $('.menu-trigger').css( 'margin-top', '20px');
      $('header').css( 'background-color', 'rgba(86, 212, 230, 0.7)');
    } else {
      //トップ時
      $('header').css( 'height', offset + 'px');
      $('header').css( 'background-color', 'transparent');
      $('#menu img').css( 'padding-top', '36px');
      $('#menu ul.pc_navi_ul').css( 'padding-top', '51px');
      $('.menu-trigger').css( 'margin-top', '48px');
    }
  });
  
  $('.menu-trigger').click(function(){
     $(this).toggleClass('active');
     $('ul.sp_navi_ul').slideToggle();
  });
  
});