<?php
get_header();

$query_param = $wp_query->query;
$base_url = get_site_url() . '/pickupanimal/';

$args_base = array(
  'post_type'        => 'pickupanimal',
  'post_status'      => 'publish',
);

if(array_key_exists('author', $query_param)) {
  $author = get_user_by('slug', $query_param['author'])->data;
  if($author) {
    $args_base['author'] = $author->ID;
    $base_url .= 'author/' . $query_param['author'] . '/';
    $author_data = get_userdata($author->ID);
  } else {
    include(TEMPLATEPATH.'/404.php');
    exit;
  }
}

$page = 0;
if(array_key_exists('paged', $query_param)) {
  $page = intval($query_param['paged']) - 1;
}

$args_get = array(
  'posts_per_page'   => PICKUPANIMAL_PER_PAGE,
  'offset'           => PICKUPANIMAL_PER_PAGE * $page,
  'orderby'          => 'date',
  'order'            => 'DESC',
);

$args_count = array(
  'posts_per_page'   => -1,
);

$pick_up_animal_list = get_posts(array_merge($args_base, $args_get));

if(count($pick_up_animal_list) == 0) {
  include(TEMPLATEPATH.'/404.php');
  exit;
}

$pick_up_animal_count = count(get_posts(array_merge($args_base, $args_count)));

set_query_var('base_url', $base_url);
set_query_var('pick_up_animal_list', $pick_up_animal_list);
set_query_var('pick_up_animal_count', $pick_up_animal_count);
set_query_var('page', $page);

?>

<p class="pickup-top"><?php if($author) { echo $author_data->last_name . $author_data->first_name . '投稿の<br class="sp-only" />'; } ?>PICK UP ANIMAL</p>

<?php get_template_part( 'template-parts/pickup-list' ); ?>

<?php
get_footer();
