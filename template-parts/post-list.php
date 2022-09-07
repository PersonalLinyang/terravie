<?php 

$base_url = get_query_var('base_url');
$total_message = get_query_var('total_message');
$post_list = get_query_var('post_list');
$post_count = get_query_var('post_count');
$pages = ceil($post_count / POSTS_PER_PAGE);
$page = get_query_var('page');
$params = '';
if(is_page('search')) {
  $params = '?' . http_build_query($_GET);
}

$tags = get_tags();

?>


<div class="common-postlist search-postlist">
  <div class="common-postlist-inner">
    <p class="common-postlist-total"><?php echo $total_message; ?><span class="number"><?php echo $post_count; ?></span><span class="small">件</span></p>
    <?php if($post_count > 0): ?>
    <div class="common-postlist-list">
      <?php echo get_html_post_list($post_list); ?>
    </div>
    
    <div class="common-pager">
      <div class="common-pager-inner  pickup-pager-inner">
        <?php if($pages > 1 && $page > 0): ?>
        <p class="common-pager-item common-pager-handle common-pager-prev">
          <?php if($page == 1): ?>
          <a class="full-link" href="<?php echo $base_url . $params; ?>"></a>
          <?php else: ?>
          <a class="full-link" href="<?php echo $base_url; ?>page/<?php echo $page; ?>/<?php echo $params; ?>"></a>
          <?php endif; ?>
        </p>
        <?php endif; ?>
        <?php for($p = 1; $p <= $pages; $p++): ?>
        <p class="common-pager-item <?php if($p < ($page - 1) || $p > ($page + 3)) { echo 'pc-only'; } ?> <?php if($p == ($page + 1)) { echo 'active'; } ?>">
          <?php 
          if($p != ($page + 1)): 
            if($p == 1):
          ?>
          <a class="full-link" href="<?php echo $base_url . $params; ?>">
          <?php else: ?>
          <a class="full-link" href="<?php echo $base_url; ?>page/<?php echo $p; ?>/<?php echo $params; ?>">
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
          <a class="full-link" href="<?php echo $base_url; ?>page/<?php echo ($page + 2); ?>/<?php echo $params; ?>"></a>
        </p>
        <?php endif; ?>
      </div>
    </div>
    <?php endif; ?>
    
    <?php if(count($tags)): ?>
    <div class="common-taglist">
      <p class="common-taglist-title">タグ一覧</p>
      <div class="common-taglist-list">
        <?php foreach($tags as $tag): ?>
        <p class="common-taglist-item"><a class="full-link" href="<?php echo get_site_url(); ?>/tag/<?php echo $tag->slug; ?>/"><?php echo $tag->name; ?></a></p>
        <?php endforeach; ?>
      </div>
    </div>
    <?php endif; ?>
  </div>
</div>


