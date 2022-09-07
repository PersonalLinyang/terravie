<?php
get_header();

// タグ取得
$post_zoo = get_the_terms($post->ID, 'post_zoo');
$post_author = get_userdata($post->post_author); 
$post_kind = get_the_terms($post->ID, 'post_kind');
$post_tags = get_the_tags($post->ID);

// ショットメッセージ取得
$short_message = get_field('short_message', $post->ID);

// STAFF PROFILE取得
$staff_profile_image_pc_id = get_post_meta($post->ID, 'profile_image_pc', true);
$staff_profile_image_pc_url = wp_get_attachment_url($staff_profile_image_pc_id);
$staff_profile_image_sp_id = get_post_meta($post->ID, 'profile_image_sp', true);
$staff_profile_image_sp_url = wp_get_attachment_url($staff_profile_image_sp_id);
$staff_profile_name = get_field('profile_name', $post->ID);
$staff_profile_kana = get_field('profile_kana', $post->ID);
$staff_profile_task = get_field('profile_task', $post->ID);
$staff_profile_history = get_field('profile_history', $post->ID);
$staff_profile_hobby = get_field('profile_hobby', $post->ID);

// WRITER PROFILE取得
$writer_profile_image_pc_id = get_user_meta($post_author->ID, 'photo_pc', true);
$writer_profile_image_pc_url = wp_get_attachment_url($writer_profile_image_pc_id);
$writer_profile_image_sp_id = get_user_meta($post_author->ID, 'photo_sp', true);
$writer_profile_image_sp_url = wp_get_attachment_url($writer_profile_image_sp_id);
$writer_profile_last_kana = get_user_meta($post_author->ID, 'last_kana', true);
$writer_profile_first_kana = get_user_meta($post_author->ID, 'first_kana', true);
$writer_profile_info = get_user_meta($post_author->ID, 'profile_info', true);

// アーカイブ取得
global $wpdb;
$sql_archive = 'SELECT DATE_FORMAT(post_date, "%Y") as year, DATE_FORMAT(post_date, "%m") as month, count(*) count FROM `wp_posts` '
           . 'WHERE post_type="post" AND post_status="publish" GROUP BY DATE_FORMAT(post_date, "%Y%m");';
$result_archive = $wpdb->get_results($wpdb->prepare($sql_archive));

$archive_list = array();
foreach ($result_archive as $archive) {
  if(!array_key_exists($archive->year, $archive_list)) {
    $archive_list[$archive->year] = array(
      'total' => 0,
      'detail' => array(),
    );
  }
  $archive_list[$archive->year]['detail'][$archive->month] = $archive->count;
  $archive_list[$archive->year]['total'] += intval($archive->count);
}

// ITEM取得
$items = get_field('items', $post->ID);

// EVENT取得
$events = get_field('event', $post->ID);

?>

<div class="single-main">
  <div class="single-main-inner">
    <div class="single-main-left">
      <p class="single-main-thumbnail sp-only"><img src="<?php echo get_the_post_thumbnail_url($post->ID); ?>" /></p>
      <p class="single-main-date"><?php echo date('Y年m月d日', strtotime($post->post_date)); ?></p>
      <p class="single-main-title"><?php echo $post->post_title; ?></p>
      <div class="common-postlist-taglist single-main-taglist">
        <?php if($post_zoo): ?>
        <p class="common-tag zoo">
          <a href="<?php echo get_site_url(); ?>/zoo/<?php echo current($post_zoo)->slug; ?>"><?php echo current($post_zoo)->name; ?></a>
        </p>
        <?php endif; ?>
        <p class="common-tag author">
          <a href="<?php echo get_site_url(); ?>/author/<?php echo $post_author->nickname; ?>"><?php echo $post_author->last_name . $post_author->first_name; ?></a>
        </p>
        <?php if($post_kind): ?>
        <p class="common-tag kind">
          <a href="<?php echo get_site_url(); ?>/kind/<?php echo current($post_kind)->slug; ?>"><?php echo current($post_kind)->name; ?></a>
        </p>
        <?php 
        endif;
        if($post_tags):
          foreach($post_tags as $post_tag) :
        ?>
        <p class="common-tag">#<a href="<?php echo get_site_url(); ?>/tag/<?php echo $post_tag->slug; ?>/"><?php echo $post_tag->name; ?></a></p>
        <?php 
          endforeach;
        endif;
        ?>
      </div>
      <p class="single-main-thumbnail pc-only"><img src="<?php echo get_the_post_thumbnail_url($post->ID); ?>" /></p>
      <div class="single-main-contentarea">
        <p class="single-main-shortmessage"><?php echo nl2br($short_message); ?></p>
        <?php if($staff_profile_name): ?>
        <div class="single-main-profile">
          <p class="single-main-profile-topic sp-only">STAFF PROFILE</p>
          <div class="single-main-profile-inner">
            <?php if($staff_profile_image_pc_url): ?>
            <div class="single-main-profile-left">
              <?php if($staff_profile_image_sp_url): ?>
              <img class="pc-only" src="<?php echo $staff_profile_image_pc_url; ?>" />
              <img class="sp-only" src="<?php echo $staff_profile_image_sp_url; ?>" />
              <?php else: ?>
              <img src="<?php echo $staff_profile_image_pc_url; ?>" />
              <?php endif; ?>
            </div>
            <?php endif; ?>
            <div class="single-main-profile-right">
              <p class="single-main-profile-title">プロフィール</p>
              <p class="single-main-profile-name sp-only"><?php echo $staff_profile_name; ?>　<span class="small"><?php echo $staff_profile_kana; ?></span></p>
              <div class="single-main-profile-info">
                <p class="single-main-profile-name pc-only">
                  <?php echo $staff_profile_name; ?> 
                  <?php if($staff_profile_kana): ?>
                    <span class="small">(<?php echo $staff_profile_kana; ?>)</span>
                  <?php endif; ?>
                </p>
                <?php if($staff_profile_task): ?>
                <p>担当　　：<?php echo $staff_profile_task; ?></p>
                <?php 
                endif;
                if($staff_profile_history):
                ?>
                <p>動物園歴：<?php echo $staff_profile_history; ?>年目</p>
                <?php 
                endif;
                if($staff_profile_hobby):
                ?>
                <p>趣味　　：<?php echo $staff_profile_hobby; ?></p>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
        <?php endif; ?>
        <div class="single-main-content">
          <?php the_content(); ?>
        </div>
        <div class="single-main-button">
          <div class="common-twitter"><a target='_blank' class="full-link" href="https://twitter.com/share?url=<?php echo urlencode((empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']) . '&text=' . urlencode($post->post_title); ?>">ツイート</a></div>
          <div class="wpulike-customize-area"><?php get_the_ulike_btn($post->ID); ?></div>
          <div class="common-share"><a target='_blank' class="full-link" href="http://www.facebook.com/share.php?u=<?php echo urlencode((empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>">シェア</a></div>
        </div>
        <div class="single-main-profile">
          <p class="single-main-profile-topic">WRITER PROFILE</p>
          <div class="single-main-profile-inner">
            <?php if($writer_profile_image_pc_url): ?>
            <div class="single-main-profile-left writer">
              <?php if($writer_profile_image_sp_url): ?>
              <img class="pc-only" src="<?php echo $writer_profile_image_pc_url; ?>" />
              <img class="sp-only" src="<?php echo $writer_profile_image_sp_url; ?>" />
              <?php else: ?>
              <img src="<?php echo $writer_profile_image_pc_url; ?>" />
              <?php endif; ?>
            </div>
            <?php endif; ?>
            <div class="single-main-profile-right">
              <p class="single-main-profile-name"><?php echo $post_author->last_name . ' ' . $post_author->first_name; ?>　<span class="small"><?php echo $writer_profile_last_kana . ' ' . $writer_profile_first_kana; ?></span></p>
              <?php if($writer_profile_info): ?>
              <div class="single-main-profile-info">
                <p><?php echo nl2br($writer_profile_info); ?></p>
              </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="single-main-right">
      <div class="single-main-right-block">
        <a href="url-banner1"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/footer-banner-1.jpg" /></a>
      </div>
      <div class="single-main-right-block">
        <a href="url-banner2"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/footer-banner-2.jpg" /></a>
      </div>
      <div class="single-main-right-block single-main-archive">
        <p class="single-main-archive-title">★　アーカイブ</p>
        <div>
          <?php foreach($archive_list as $year => $info): ?>
          <div class="single-main-archive-item">
            <div class="single-main-archive-handle">
              <p class="single-main-archive-button"></p>
              <p class="single-main-archive-year">
                <a href="<?php echo get_site_url(); ?>/<?php echo $year; ?>/">
                  <?php echo $year . ' (' . $info['total'] . ')'; ?>
                </a>
              </p>
            </div>
            <div class="single-main-archive-list">
              <?php foreach($info['detail'] as $month => $count): ?>
              <p class="single-main-archive-month">
                <a href="<?php echo get_site_url(); ?>/<?php echo $year; ?>/<?php echo $month; ?>/">
                  <?php echo $year . ' / ' . $month . ' (' . $count . ')'; ?>
                </a>
              </p>
              <?php endforeach; ?>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php if($items): ?>
<div class="single-item">
  <div class="single-item-inner">
    <div class="single-item-area">
      <p class="single-item-topic">ITEMS</p>
      <div class="single-item-list">
        <?php foreach($items as $item):  ?>
        <div class="single-item-item">
          <p class="single-item-image">
            <a class="full-link" href="<?php echo get_field('url', $item->ID); ?>">
              <img src="<?php echo get_the_post_thumbnail_url($item->ID); ?>" />
            </a>
          </p>
          <p class="single-item-title"><a href="<?php echo get_field('url', $item->ID); ?>"><?php echo $item->post_title; ?></a></p>
          <p class="single-item-price">&yen;<?php echo number_format(intval(get_field('price', $item->ID))); ?></p>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>

<?php if($events): ?>
<div class="single-event">
  <div class="single-event-inner">
    <div class="single-event-area">
      <p class="single-event-topic">EVENT</p>
      <div class="single-event-list">
        <?php foreach($events as $event):  ?>
        <div class="single-event-item">
          <div class="single-event-image">
            <p class="single-event-image-inner">
              <a href="<?php echo get_site_url(); ?>/event/<?php echo $event->post_name; ?>/">
                <img src="<?php echo get_the_post_thumbnail_url($event->ID); ?>" />
              </a>
            </p>
          </div>
          <p class="single-event-title"><a href="<?php echo get_site_url(); ?>/event/<?php echo $event->post_name; ?>/"><?php echo $event->post_title; ?></a></p>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>

<?php
get_footer();
