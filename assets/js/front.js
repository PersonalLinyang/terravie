$(document).ready(function(){

  // もっと見るボタンクリック
  $('.front-button-more').click( function(){
    var offset = parseInt($('.front-postlist').data('offset'));

    // functions.phpのget_front_moreアクションに送信
    var fd = new FormData();
    fd.append('action', 'get_front_more');
    fd.append('offset', offset);

    // ajaxの通信
    $.ajax({
      type: 'POST',
      url: ajaxurl,
      data: fd,
      processData: false,
      contentType: false,
      success: function( response ){
        var res = JSON.parse(response);
        if(res['result'] == true) {
          $('.front-postlist').data('offset', (offset + 1));
          $('.front-postlist').append(res['html']);
          $('.common-postlist-block').slideDown();
          if(res['end_flag'] == true) {
            $('.front-button-more').hide();
          }
        }
      },
      error: function( response ){
      }
    });
    return false;
  });

});