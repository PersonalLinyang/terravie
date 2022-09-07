<?php
get_header();

$query_param = $wp_query->query;
$base_url = get_site_url() . '/search/';

$category = '';
$keyword = '';
$page = 0;

if(array_key_exists('category', $_GET)) {
  $category = $_GET['category'];
}

if(array_key_exists('keyword', $_GET)) {
  $keyword = $_GET['keyword'];
}

$page = 0;
if(array_key_exists('paged', $query_param)) {
  $page = intval($query_param['paged']) - 1;
}

global $wpdb;
$sql_select_search = 'SELECT wp.ID, wp.post_name, wp.post_title, wp.post_date, wp.post_author ';
$sql_select_count = 'SELECT count(wp.ID) post_count ';
$sql_from = 'FROM wp_posts wp ';
$sql_where = 'WHERE wp.post_type="post" AND wp.post_status="publish" ';

if($category) {
  $sql_from .= 'LEFT JOIN wp_term_relationships wtr ON wp.ID = wtr.object_id ';
  $sql_from .= 'LEFT JOIN (SELECT * FROM wp_term_taxonomy WHERE taxonomy="category") wtt ON wtr.term_taxonomy_id = wtt.term_taxonomy_id ';
  $sql_from .= 'LEFT JOIN wp_terms wt ON wtt.term_id = wt.term_id ';
  $sql_where .= 'AND wt.slug = "' . $category . '" ';
}

if($keyword) {
  $kw_tmp_list = explode(' ', $keyword);
  $kw_list = array();
  foreach($kw_tmp_list as $kw_tmp) {
    $kw_list = array_merge($kw_list, explode('　', $kw_tmp));
  }
  $title_like_list = array();
  foreach($kw_list as $kw) {
    array_push($title_like_list, 'wp.post_title LIKE "%' . $kw . '%"');
  }
  $sql_where .= 'AND (' . implode(' OR ', $title_like_list) . ')';
}

$sql_search = $sql_select_search . $sql_from . $sql_where . 'ORDER BY post_date DESC LIMIT ' . POSTS_PER_PAGE . ' OFFSET ' . (POSTS_PER_PAGE * $page);
$result_list = $wpdb->get_results( $wpdb->prepare($sql_search));

if(count($result_list) == 0) {
  include(TEMPLATEPATH.'/404.php');
  exit;
}

$sql_count = $sql_select_count . $sql_from . $sql_where;
$result_count = current($wpdb->get_results( $wpdb->prepare($sql_count)))->post_count;

$total_message = '';
if($keyword) {
  $total_message .= '「' . $keyword . '」の';
}
$total_message .= '検索結果';

set_query_var('base_url', $base_url);
set_query_var('post_list', $result_list);
set_query_var('post_count', $result_count);
set_query_var('total_message', $total_message);
set_query_var('page', $page);

?>

<div class="search-top">
  <form class="search-top-form">
    <div class="search-top-inner">
      <p class="search-top-select">
        <select name="category" class="search-top-category <?php if(!$category) { echo 'grey'; } ?>">
          <option value="">すべてのカテゴリ</option>
          <option value="column" <?php if($category == 'column') { echo 'selected'; } ?>>お読みもの</option>
          <option value="shopping" <?php if($category == 'shopping') { echo 'selected'; } ?>>お買いもの</option>
          <option value="event" <?php if($category == 'event') { echo 'selected'; } ?>>イベント・チケット</option>
        </select>
      </p>
      <p class="search-top-text"><input class="search-top-keyword" name="keyword" type="text" placeholder="キーワード" value="<?php echo $keyword; ?>" /></p>
      <p class="search-top-button"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/search.svg" /></p>
    </div>
  </form>
</div>

<?php get_template_part( 'template-parts/post-list' ); ?>

<?php
get_footer();
