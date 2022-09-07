<?php

get_header();

$query_param = $wp_query->query;
$pick_up_zoo = get_queried_object();
$base_url = get_site_url() . '/pickupanimal/zoo/' . $pick_up_zoo->slug . '/';

$args_base = array(
  'post_type'        => 'pickupanimal',
  'post_status'      => 'publish',
  'tax_query'        => array(
    array(
      'taxonomy'     => 'pickup_zoo',
      'field'        => 'slug',
      'terms'        => $pick_up_zoo->slug,
    )
  ),
);

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

<p class="pickup-top"><?php echo $pick_up_zoo->name; ?>の<br class="sp-only" />PICK UP ANIMAL</p>

<?php get_template_part( 'template-parts/pickup-list' ); ?>

<?php
get_footer();
