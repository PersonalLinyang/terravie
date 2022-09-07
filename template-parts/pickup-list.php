<?php 

$base_url = get_query_var('base_url');
$pick_up_animal_list = get_query_var('pick_up_animal_list');
$pick_up_animal_count = get_query_var('pick_up_animal_count');
$pages = ceil($pick_up_animal_count / PICKUPANIMAL_PER_PAGE);
$page = get_query_var('page');

?>

<div class="common-postlist pickup-postlist">
  <div class="common-postlist-inner pickup-postlist-inner">
    <div class="common-postlist-list">
      <div class="common-postlist-block">
        <div class="common-postlist-block-inner">
          <?php foreach($pick_up_animal_list as $pick_up_animal): ?>
          <div class="common-postlist-item pickup-item">
            <div class="pickup-header">
              <p class="pickup-number">No.<?php echo sprintf('%03d', $pick_up_animal->post_name); ?></p>
              <p class="pickup-date"><?php echo date('Y年m月d日', strtotime($pick_up_animal->post_date)); ?></p>
            </div>
            <p class="pickup-image"><img src="<?php echo get_the_post_thumbnail_url($pick_up_animal->ID); ?>" /></p>
            <p class="pickup-title"><?php echo $pick_up_animal->post_title; ?></p>
            <p class="pickup-text"><?php echo nl2br($pick_up_animal->post_content); ?></p>
            <div class="pickup-taglist">
              <?php 
              $pick_up_zoo = get_the_terms($pick_up_animal->ID, 'pickup_zoo');
              if($pick_up_zoo): 
              ?>
              <p class="common-tag zoo">
                <a href="<?php echo get_site_url(); ?>/pickupanimal/zoo/<?php echo current($pick_up_zoo)->slug; ?>/"><?php echo current($pick_up_zoo)->name; ?></a>
              </p>
              <?php 
              endif; 
              $pick_up_author = get_userdata($pick_up_animal->post_author);
              ?>
              <p class="common-tag author">
                <a href="<?php echo get_site_url(); ?>/pickupanimal/author/<?php echo $pick_up_author->nickname; ?>/"><?php echo $pick_up_author->last_name . $pick_up_author->first_name; ?></a>
              </p>
              <?php 
              $pick_up_kind = get_the_terms($pick_up_animal->ID, 'pickup_kind');
              if($pick_up_kind): 
              ?>
              <p class="common-tag kind">
                <a href="<?php echo get_site_url(); ?>/pickupanimal/kind/<?php echo current($pick_up_kind)->slug; ?>/"><?php echo current($pick_up_kind)->name; ?></a>
              </p>
              <?php endif; ?>
            </div>
            <div class="pickup-button">
              <div class="common-twitter"><a target='_blank' class="full-link" href="https://twitter.com/share?url=<?php echo urlencode((empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']) . '&text=' . urlencode($pick_up_animal->post_title); ?>">ツイート</a></div>
              <div class="wpulike-customize-area"><?php get_the_ulike_btn($pick_up_animal->ID); ?></div>
              <div class="common-share"><a target='_blank' class="full-link" href="http://www.facebook.com/share.php?u=<?php echo urlencode((empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>">シェア</a></div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="common-pager pickup-pager">
  <div class="common-pager-inner  pickup-pager-inner">
    <?php if($pages > 1 && $page > 0): ?>
    <p class="common-pager-item common-pager-handle common-pager-prev">
      <?php if($page == 1): ?>
      <a class="full-link" href="<?php echo $base_url; ?>"></a>
      <?php else: ?>
      <a class="full-link" href="<?php echo $base_url; ?>page/<?php echo $page; ?>/"></a>
      <?php endif; ?>
    </p>
    <?php endif; ?>
    <?php for($p = 1; $p <= $pages; $p++): ?>
    <p class="common-pager-item <?php if($p < ($page - 1) || $p > ($page + 3)) { echo 'pc-only'; } ?> <?php if($p == ($page + 1)) { echo 'active'; } ?>">
      <?php 
      if($p != ($page + 1)): 
        if($p == 1):
      ?>
      <a class="full-link" href="<?php echo $base_url; ?>">
      <?php else: ?>
      <a class="full-link" href="<?php echo $base_url; ?>page/<?php echo $p; ?>/">
      <?php 
        endif;
      endif; 
      ?>
        <?php echo $p; ?>
      <?php if($p != ($page + 1)): ?></a><?php endif; ?>
    </p>
    <?php endfor; ?>
    <?php if($pages > 1 && $page < ($pages - 1)): ?>
    <p class="common-pager-item common-pager-handle common-pager-next">
      <a class="full-link" href="<?php echo $base_url; ?>page/<?php echo ($page + 2); ?>/"></a>
    </p>
    <?php endif; ?>
  </div>
</div>