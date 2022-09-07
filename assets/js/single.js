$(document).ready(function(){

  // アーカイブ開きボタン
  $('.single-main-archive-button').click( function(){
    if($(this).hasClass('active')) {
      $(this).removeClass('active');
      $(this).closest('.single-main-archive-item').find('.single-main-archive-list').slideUp();
    } else {
      $(this).addClass('active');
      $(this).closest('.single-main-archive-item').find('.single-main-archive-list').slideDown();
    }
  });

});