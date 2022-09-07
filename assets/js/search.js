$(document).ready(function(){

  // 検索ボタンクリック
  $('.search-top-button').click( function(){
    var url = siteurl + '/search/';
    var param_list = [];
    
    if($('.search-top-category').val()) {
      param_list.push('category=' + $('.search-top-category').val());
    }
    
    if($('.search-top-keyword').val()) {
      param_list.push('keyword=' + $('.search-top-keyword').val());
    }
    
    var param = param_list.join('&');
    if(param) {
      url += '?' + param;
    }
    
    window.location.href = url;
    return;
  });

  // カテゴリ選択
  $('.search-top-category').click(function(){
    $(this).removeClass('grey');
  });

});