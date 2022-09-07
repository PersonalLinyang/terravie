<?php

// 曜日切り替え配列
$array_week = array('日', '月', '火', '水', '木', '金', '土');

// PICK UP ANIMAL 取得
$pick_up_animal = get_field('pick_up_animal', $post->ID);
$pick_up_date = strtotime($pick_up_animal->post_date);
$pick_up_zoo = get_the_terms($pick_up_animal->ID, 'pickup_zoo');
$pick_up_author = get_userdata($pick_up_animal->post_author);
$pick_up_kind = get_the_terms($pick_up_animal->ID, 'pickup_kind');

// TOPIC 取得
$topic_list = get_posts(
  array(
    'posts_per_page'   => FRONT_TOPICS_PER_BLOCK,
    'offset'           => 0,
    'orderby'          => 'date',
    'order'            => 'DESC',
    'post_type'        => 'post',
    'post_status'      => 'publish',
  )
);
$topic_count = count(get_posts(array('post_type' => 'post', 'post_status' => 'publish')));

get_header();
?>

<?php if($pick_up_animal): ?>
<div class="front-pickup">
  <p class="front-pickup-date"><span class="large"><?php echo date('Y', $pick_up_date); ?></span>年<span class="large"><?php echo date('m', $pick_up_date); ?></span>月<span class="large"><?php echo date('d', $pick_up_date); ?></span>日<span class="large red"><?php echo $array_week[date('w', $pick_up_date)]; ?></span>曜日</p>
  <p class="front-pickup-number">No.<?php echo sprintf('%03d', $pick_up_animal->post_name); ?></p>
  <div class="front-pickup-left">
    <p class="front-pickup-left-title">PICK UP ANIMAL</p>
    <img src="<?php echo get_the_post_thumbnail_url($pick_up_animal->ID); ?>" />
  </div>
  <div class="front-pickup-right">
    <p class="front-pickup-right-title"><?php echo $pick_up_animal->post_title; ?></p>
    <p class="front-pickup-right-content"><?php echo nl2br($pick_up_animal->post_content); ?></p>
    <div class="front-pickup-right-taglist">
      <?php if($pick_up_zoo): ?>
      <p class="common-tag zoo">
        <a href="<?php echo get_site_url(); ?>/pickupanimal/zoo/<?php echo current($pick_up_zoo)->slug; ?>/"><?php echo current($pick_up_zoo)->name; ?></a>
      </p>
      <?php endif; ?>
      <p class="common-tag author">
        <a href="<?php echo get_site_url(); ?>/pickupanimal/author/<?php echo $pick_up_author->nickname; ?>/"><?php echo $pick_up_author->last_name . $pick_up_author->first_name; ?></a>
      </p>
      <?php if($pick_up_kind): ?>
      <p class="common-tag kind">
        <a href="<?php echo get_site_url(); ?>/pickupanimal/kind/<?php echo current($pick_up_kind)->slug; ?>/"><?php echo current($pick_up_kind)->name; ?></a>
      </p>
      <?php endif; ?>
    </div>
    <div class="front-pickup-right-button">
      <div class="common-twitter"><a target='_blank' class="full-link" href="https://twitter.com/share?url=<?php echo urlencode(get_site_url() . '/pickupanimal/&text=' . $pick_up_animal->post_title); ?>">ツイート</a></div>
      <div class="wpulike-customize-area"><?php get_the_ulike_btn($pick_up_animal->ID); ?></div>
      <div class="common-share"><a target='_blank' class="full-link" href="http://www.facebook.com/share.php?u=<?php echo urlencode(get_site_url() . '/pickupanimal/'); ?>">シェア</a></div>
    </div>
    <p class="front-pickup-right-link"><a class="full-link" href="<?php echo get_site_url(); ?>/pickupanimal/">バックナンバーはこちら</a></p>
  </div>
</div>
<?php endif; ?>

<div class="front-map">
  <div class="front-map-inner">
    <div class="front-map-item">
      <a class="full-link" href="<?php echo get_site_url(); ?>/column/">
        <p class="front-map-image front-map-image1"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/site-map-column.svg"/></p>
        <p class="front-map-text front-map-text1">読みもの</p>
      </a>
    </div>
    <div class="front-map-item">
      <a class="full-link" href="<?php echo get_site_url(); ?>/shopping/">
        <p class="front-map-image front-map-image2"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/site-map-shopping.svg"/></p>
        <p class="front-map-text front-map-text2">お買いもの</p>
      </a>
    </div>
    <div class="front-map-item">
      <a class="full-link" href="<?php echo get_site_url(); ?>/event/">
        <p class="front-map-image front-map-image3"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/site-map-event.svg"/></p>
        <p class="front-map-text front-map-text3">イベント・<br class="sp-only" />チケット</p>
      </a>
    </div>
  </div>
</div>

<div class="front-topic">
  <div class="front-topic-inner">
    <p class="front-topic-topic">TOPIC</p>
    <div class="common-postlist front-postlist" data-offset="1">
      <?php echo get_html_post_list($topic_list); ?>
    </div>
  </div>
  <?php if($topic_count > FRONT_TOPICS_PER_BLOCK): ?>
  <div class="common-button sp-only front-button-more">もっと見る<p class="common-button-arrow"></p></div>
  <?php endif; ?>
</div>

<?php

get_footer();
