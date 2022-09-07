<?php
/*
 * フッタ部分
 */
?>

    </main>
    
    <footer>
      <div class="footer-banner <?php if(is_singular('post')) { echo 'sp-only'; } ?>">
        <div class="footer-banner-inner">
          <div class="footer-banner-item"><a href="url-banner1"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/footer-banner-1.jpg" /></a></div>
          <div class="footer-banner-item"><a href="url-banner2"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/footer-banner-2.jpg" /></a></div>
        </div>
      </div>
      <div class="footer-search">
        <input class="footer-search-input" name="search" type="text" placeholder="キーワード検索" />
      </div>
      <div class="footer-map1">
        <div class="footer-map1-inner">
          <div class="footer-map1-item">
            <div class="footer-map1-item-inner">
              <a class="full-link" href="<?php echo get_site_url(); ?>/column/">
                <p class="footer-map1-image footer-map1-image1"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/site-map-column.svg"/></p>
                <p class="footer-map1-text">読みもの</p>
              </a>
            </div>
          </div>
          <div class="footer-map1-item">
            <div class="footer-map1-item-inner">
              <a class="full-link" href="<?php echo get_site_url(); ?>/shopping/">
                <p class="footer-map1-image footer-map1-image2"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/site-map-shopping.svg"/></p>
                <p class="footer-map1-text">お買いもの</p>
              </a>
            </div>
          </div>
          <div class="footer-map1-item">
            <div class="footer-map1-item-inner">
              <a class="full-link" href="<?php echo get_site_url(); ?>/event/">
                <p class="footer-map1-image footer-map1-image3"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/site-map-event.svg"/></p>
                <p class="footer-map1-text">イベント・チケット</p>
              </a>
            </div>
          </div>
          <div class="footer-map1-item">
            <div class="footer-map1-item-inner">
              <a class="full-link" href="<?php echo get_site_url(); ?>/mailmagazine/">
                <p class="footer-map1-image footer-map1-image4"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/site-map-mail.svg"/></p>
                <p class="footer-map1-text">メルマガ登録</p>
              </a>
            </div>
          </div>
          <div class="footer-map1-item">
            <div class="footer-map1-item-inner">
              <a class="full-link" href="<?php echo get_site_url(); ?>/contact/">
                <p class="footer-map1-image footer-map1-image5"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/site-map-contact.svg"/></p>
                <p class="footer-map1-text">お問い合わせ</p>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="footer-controller">
        <div class="footer-map2">
          <p class="footer-map2-item"><a class="full-link" href="<?php echo get_site_url(); ?>/terms/">利用規約</a></p>
          <p class="footer-map2-item"><a class="full-link" href="<?php echo get_site_url(); ?>/about/">Terravieとは</a></p>
          <p class="footer-map2-item"><a class="full-link" href="<?php echo get_site_url(); ?>/company/">運営会社</a></p>
        </div>
        <div class="footer-sns">
          <div class="footer-sns-inner">
            <p class="footer-sns-item"><a href="url-facebook"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/sns-icon-facebook.svg"/></a></p>
            <p class="footer-sns-item"><a href="url-twitter"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/sns-icon-twitter.svg"/></a></p>
            <p class="footer-sns-item"><a href="url-youtube"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/sns-icon-youtube.svg"/></a></p>
            <p class="footer-sns-item"><a href="url-insgram"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/sns-icon-insgram.svg"/></a></p>
          </div>
        </div>
      </div>
      <div class="footer-company">@terravie 記事メディア</div>
    </footer>

   <?php wp_footer(); ?>
 </body>
</html>
