$(document).ready(function(){

  // 「メルマガ登録する」ボタンクリック
  $('.magazine-register-submit').click( function(event){
    // クリックイベントをこれ以上伝播させない
    event.preventDefault();

    // POSTデータ作成
    var fd = new FormData();
    $('.magazine-register-input').each(function() {
      fd.append($(this)[0].name, $(this).val());
    });

    // functions.phpのmagazine_registerアクションに送信
    fd.append('action', 'magazine_register');

    // エラー出力を全部消す
    $('.magazine-register-error').html('');
    $('.magazine-register-error-all').removeClass('success');

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
          $('.magazine-register-error-all').addClass('success');
          $('.magazine-register-error-all').html('登録成功しました');
        } else {
          $.each(res['errors'], function(key, value) {
            $('.magazine-register-error-' + key).html(value);
          });
        }
      },
      error: function( response ){
        $('.magazine-register-error-all').html('システムエラーが発生しました、しばらく待って再送信してお願い致します');
      }
    });
    return false;
  });
  
  // 生年月日選択クリック
  $('.magazine-register-select').click(function(){
    $(this).css('color', '#000');
  });
  
  // 「解除する」ボタンクリック
  $('.magazine-unregister-submit').click( function(event){
    // クリックイベントをこれ以上伝播させない
    event.preventDefault();

    // POSTデータ作成
    var fd = new FormData();
    $('.magazine-unregister-input').each(function() {
      fd.append($(this)[0].name, $(this).val());
    });

    // functions.phpのmagazine_unregisterアクションに送信
    fd.append('action', 'magazine_unregister');

    // エラー出力を全部消す
    $('.magazine-unregister-error').html('');
    $('.magazine-unregister-error-all').removeClass('success');

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
          $('.magazine-unregister-error-all').addClass('success');
          $('.magazine-unregister-error-all').html('解除成功しました');
        } else {
          $.each(res['errors'], function(key, value) {
            $('.magazine-unregister-error-' + key).html(value);
          });
        }
      },
      error: function( response ){
        $('.magazine-unregister-error-all').html('システムエラーが発生しました、しばらく待って再送信してお願い致します');
      }
    });
    return false;
  });

});