$(document).ready(function(){
  
  // メニューボタンクリック
  $('.header-menu-handler').click(function(){
    if($(this).hasClass('active')) {
      $('.header-slidemenu').slideUp('slow');
      $(this).removeClass('active');
    } else {
      $('.header-slidemenu').slideDown('slow');
      $(this).addClass('active');
    }
  });
  
  // PCヘッダ検索入力でエンター
  $('.header-search-input').keypress(function(e) {
    if (e.keyCode == 13) {
      var url = siteurl + '/search/';
      if($(this).val()) {
        url += '?keyword=' + $(this).val();
      }
      window.location.href = url;
      return;
    }
  });
  
  //SPヘッダ検索ボタンクリック
  $('.header-search-handler').click(function(){
    var scrTop = $('.footer-search').offset().top;
    $('html, body').animate({scrollTop: scrTop});
  });
  
  // SPフッタ検索入力でエンター
  $('.footer-search-input').keypress(function(e) {
    if (e.which == 13) {
      var url = siteurl + '/search/';
      if($(this).val()) {
        url += '?keyword=' + $(this).val();
      }
      window.location.href = url;
      return;
    }
  });
  
});