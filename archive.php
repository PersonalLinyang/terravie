<?php
get_header();

$query_param = $wp_query->query;
$total_message = '';

$args_base = array(
  'post_type'        => 'post',
  'post_status'      => 'publish',
  'category'         => $category->term_id,
);

if(array_key_exists('year', $query_param)) {
  if(array_key_exists('monthnum', $query_param)) {
    $month = $query_param['year'] . '-' . $query_param['monthnum'];
    $args_base['data_query'] = array(
      'after' => date('Y-m-d', strtotime('first day of ' . $month)),
      'before' => date('Y-m-d', strtotime('last day of ' . $month)),
      'inclusive' => true,
    );
    $total_message = date('Y年n月の投稿', strtotime($query_param['year'] . '-' . $query_param['monthnum'] . '-01'));
  } else {
    $args_base['data_query'] = array(
      'after' => $query_param['year'] . '-1-1',
      'before' => $query_param['year'] . '-12-31',
      'inclusive' => true,
    );
    $total_message = date('Y年の投稿', strtotime($query_param['year'] . '-01-01'));
  }
}

$page = 0;

$args_get = array(
  'posts_per_page'   => POSTS_PER_PAGE,
  'offset'           => POSTS_PER_PAGE * $page,
  'orderby'          => 'date',
  'order'            => 'DESC',
);

$args_count = array(
  'posts_per_page'   => -1,
);

$post_list = get_posts(array_merge($args_base, $args_get));
$post_count = count(get_posts(array_merge($args_base, $args_count)));

set_query_var('post_list', $post_list);
set_query_var('post_count', $post_count);
set_query_var('total_message', $total_message);
set_query_var('page', $page);

?>

<?php get_template_part( 'template-parts/post-list' ); ?>

<?php
get_footer();
