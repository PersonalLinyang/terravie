<?php
/*
 * ヘッダ部分
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11" />
    <script>
      (function(d) {
        var config = {
          kitId: 'jfr8jyk',
          scriptTimeout: 3000,
          async: true
        },
        h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src='https://use.typekit.net/'+config.kitId+'.js';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)
      })(document);
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/style.css" />
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/common.js"></script>
    <?php if(is_front_page()): ?>
      <script src="<?php echo get_template_directory_uri(); ?>/assets/js/front.js"></script>
    <?php elseif(is_page('mailmagazine')): ?>
      <script src="<?php echo get_template_directory_uri(); ?>/assets/js/magazine.js"></script>
    <?php elseif(is_page('search')): ?>
      <script src="<?php echo get_template_directory_uri(); ?>/assets/js/search.js"></script>
    <?php elseif(is_singular('post')): ?>
      <script src="<?php echo get_template_directory_uri(); ?>/assets/js/single.js"></script>
    <?php endif; ?>
    <?php wp_head(); ?>
  </head>

  <body>

    <header>
      <div class="header-area">
        <div class="header-inner">
          <div class="header-logo" >
            <a href="<?php echo get_site_url(); ?>/"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/logo.png" /></a>
          </div>
          <div class="header-menu">
            <img class="header-menu-handler pc-only" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/menu-pc.svg" />
            <img class="header-menu-handler sp-only" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/menu-sp.svg" />
          </div>
          <div class="header-search">
            <img class="sp-only header-search-handler" src="<?php echo get_template_directory_uri(); ?>/assets/img/common/search.svg" />
            <input class="pc-only header-search-input" name="search" type="text" placeholder="キーワード検索" />
          </div>
        </div>
      </div>
      <div class="header-slidemenu">
        <div class="header-slidemenu-inner">
          <div class="header-slidemenu-map1">
            <div class="header-slidemenu-map1-item">
              <a class="full-link" href="<?php echo get_site_url(); ?>/column/">
                <p class="header-slidemenu-map1-image header-slidemenu-map1-image1"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/site-map-column.svg"/></p>
                <p class="header-slidemenu-map1-text">読みもの</p>
                <p class="header-slidemenu-map1-arrow"></p>
              </a>
            </div>
            <div class="header-slidemenu-map1-item">
              <a class="full-link" href="<?php echo get_site_url(); ?>/shopping/">
                <p class="header-slidemenu-map1-image header-slidemenu-map1-image2"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/site-map-shopping.svg"/></p>
                <p class="header-slidemenu-map1-text">お買いもの</p>
                <p class="header-slidemenu-map1-arrow"></p>
              </a>
            </div>
            <div class="header-slidemenu-map1-item">
              <a class="full-link" href="<?php echo get_site_url(); ?>/event/">
                <p class="header-slidemenu-map1-image header-slidemenu-map1-image3"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/site-map-event.svg"/></p>
                <p class="header-slidemenu-map1-text">イベント・チケット</p>
                <p class="header-slidemenu-map1-arrow"></p>
              </a>
            </div>
          </div>
          <div class="header-slidemenu-map2">
            <div class="header-slidemenu-map2-line">
              <p class="header-slidemenu-map2-item large"><a class="full-link" href="<?php echo get_site_url(); ?>/mailmagazine/">メルマガ登録</a></p>
            </div>
            <div class="header-slidemenu-map2-line">
              <p class="header-slidemenu-map2-item"><a class="full-link" href="<?php echo get_site_url(); ?>/about/">Terravieとは</a></p>
              <p class="header-slidemenu-map2-item"><a class="full-link" href="<?php echo get_site_url(); ?>/company/">運営会社</a></p>
            </div>
            <div class="header-slidemenu-map2-line">
              <p class="header-slidemenu-map2-item"><a class="full-link" href="<?php echo get_site_url(); ?>/contact/">お問い合わせ</a></p>
              <p class="header-slidemenu-map2-item"><a class="full-link" href="<?php echo get_site_url(); ?>/terms/">利用規約</a></p>
            </div>
            <div class="header-slidemenu-sns">
              <div class="header-slidemenu-sns-inner">
                <p class="header-slidemenu-sns-item"><a href="url-facebook"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/sns-icon-facebook.svg"/></a></p>
                <p class="header-slidemenu-sns-item"><a href="url-twitter"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/sns-icon-twitter.svg"/></a></p>
                <p class="header-slidemenu-sns-item"><a href="url-youtube"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/sns-icon-youtube.svg"/></a></p>
                <p class="header-slidemenu-sns-item"><a href="url-insgram"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/sns-icon-insgram.svg"/></a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="header-line"></div>
    </header>

    <main>