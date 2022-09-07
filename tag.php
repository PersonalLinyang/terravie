<?php
get_header();

$query_param = $wp_query->query;
$tag = get_queried_object();
$base_url = get_site_url() . '/tag/' . $tag->slug . '/';

$args_base = array(
  'post_type'        => 'post',
  'post_status'      => 'publish',
  'tax_query'        => array(
    array(
      'taxonomy'     => 'post_tag',
      'field'        => 'slug',
      'terms'        => $tag->slug,
    )
  ),
);

$page = 0;
if(array_key_exists('paged', $query_param)) {
  $page = intval($query_param['paged']) - 1;
}

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

if(count($post_list) == 0) {
  include(TEMPLATEPATH.'/404.php');
  exit;
}

$post_count = count(get_posts(array_merge($args_base, $args_count)));

set_query_var('base_url', $base_url);
set_query_var('post_list', $post_list);
set_query_var('post_count', $post_count);
set_query_var('total_message', $tag->name . 'の投稿');
set_query_var('page', $page);

?>

<?php get_template_part( 'template-parts/post-list' ); ?>

<?php
get_footer();
