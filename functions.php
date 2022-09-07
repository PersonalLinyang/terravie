<?php

/*
 * サイト全体に使う定数設定
 */
// 記事一覧で一ページの記事数
define('POSTS_PER_PAGE', 10);
// PICK UP ANIMAL一覧で一ページの記事数
define('PICKUPANIMAL_PER_PAGE', 12);
// フロントページ一回「もっと見る」でロードする記事数
define('FRONT_TOPICS_PER_BLOCK', 15);

/**
 * リライトルールを追加してIDでのURLをカスタム投稿のURLとして利用可能にする
 * プラグイン「Rewrite Rules Inspector」を有効化して、管理画面の「ツール-Rewrite Rules」で「Flush Rules」でDB化する必要がある
 */
function custom_rewrite_urls() {
    add_rewrite_rule('search/page/([0-9]{1,})/?$', 'index.php?pagename=search&paged=$matches[1]', 'top');
    add_rewrite_rule('(column|shopping|event)/page/([0-9]{1,})/?$', 'index.php?category_name=$matches[1]&paged=$matches[2]', 'top');
    add_rewrite_rule('zoo/([^/]*)/?$', 'index.php?post_zoo=$matches[1]', 'top');
    add_rewrite_rule('zoo/([^/]*)/page/([0-9]{1,})/?$', 'index.php?post_zoo=$matches[1]&paged=$matches[2]', 'top');
    add_rewrite_rule('kind/([^/]*)/?$', 'index.php?post_kind=$matches[1]', 'top');
    add_rewrite_rule('kind/([^/]*)/page/([0-9]{1,})/?$', 'index.php?post_kind=$matches[1]&paged=$matches[2]', 'top');
    add_rewrite_rule('pickupanimal/zoo/([^/]*)/?$', 'index.php?pickup_zoo=$matches[1]', 'top');
    add_rewrite_rule('pickupanimal/zoo/([^/]*)/page/([0-9]{1,})/?$', 'index.php?pickup_zoo=$matches[1]&paged=$matches[2]', 'top');
    add_rewrite_rule('pickupanimal/kind/([^/]*)/?$', 'index.php?pickup_kind=$matches[1]', 'top');
    add_rewrite_rule('pickupanimal/kind/([^/]*)/page/([0-9]{1,})/?$', 'index.php?pickup_kind=$matches[1]&paged=$matches[2]', 'top');
    add_rewrite_rule('pickupanimal/author/([^/]*)/?$', 'index.php?post_type=pickupanimal&author=$matches[1]', 'top');
    add_rewrite_rule('pickupanimal/author/([^/]*)/page/([0-9]{1,})/?$', 'index.php?post_type=pickupanimal&author=$matches[1]&paged=$matches[2]', 'top');
}
add_action('init', 'custom_rewrite_urls');

/*
 * Warningを非表示にする
 */
function hide_warning() {
  error_reporting(0);
}
add_action('init', 'hide_warning');


/*
 * デフォルトカテゴリ追加
 */
function create_category() {
  // 必須タクソノミーデフォルト追加
  if(!term_exists( 'category', 'column' )) {
    wp_insert_term(
      '読み物',
      'category',
      array(
        'description'=> '',
        'slug' => 'column'
      )
    );
  }
  if(!term_exists( 'category', 'shopping' )) {
    wp_insert_term(
      'お買い物',
      'category',
      array(
        'description'=> '',
        'slug' => 'shopping'
      )
    );
  }
  if(!term_exists( 'category', 'event' )) {
    wp_insert_term(
      'イベント・チケット',
      'category',
      array(
        'description'=> '',
        'slug' => 'event'
      )
    );
  }
}
add_action('init', 'create_category');

/*
 * 「投稿」投稿タイプのカスタムタクソノミー追加
 */
function fix_post_type() {
  // タクソノミー「動物園」追加
  register_taxonomy( 
    'post_zoo',
    array('post'),
    array(
      'labels' => array(
        'name' => '動物園',
        'edit_item' => '編集',
        'update_item' => '更新',
        'add_new_item' => '新規動物園を追加'
      ),
      'meta_box_cb' => 'post_categories_meta_box',
      'show_in_rest' => true,
      'hierarchical' => true,
    ) 
  );
  
  // タクソノミー「動物の種類」追加
  register_taxonomy( 
    'post_kind',
    array('post'),
    array(
      'labels' => array(
        'name' => '動物の種類',
        'edit_item' => '編集',
        'update_item' => '更新',
        'add_new_item' => '新規動物の種類を追加'
      ),
      'meta_box_cb' => 'post_categories_meta_box',
      'show_in_rest' => true,
      'hierarchical' => true,
    ) 
  );
}
add_action('init', 'fix_post_type');

/*
 * 「PICK UP ANIMAL」投稿タイプと関連タクソノミー追加
 */
function create_pickupanimal_type() {
  // 記事タイプ「PICK UP ANIMAL」追加
  register_post_type('pickupanimal',
    array(
      'label' => 'PICK UP ANIMAL',
      'public' => true,
      'has_archive' => true,
      'menu_position' => 6, 
      'supports' => [
        'title',
        'editor',
        'thumbnail',
        'custom-fields',
      ]
    )
  );
  
  // タクソノミー「動物園」追加
  register_taxonomy( 
    'pickup_zoo',
    array('pickupanimal'),
    array(
      'labels' => array(
        'name' => '動物園',
        'edit_item' => '編集',
        'update_item' => '更新',
        'add_new_item' => '新規動物園を追加'
      ),
      'meta_box_cb' => 'post_categories_meta_box',
    ) 
  );
  
  // タクソノミー「動物の種類」追加
  register_taxonomy( 
    'pickup_kind',
    array('pickupanimal'),
    array(
      'labels' => array(
        'name' => '動物の種類',
        'edit_item' => '編集',
        'update_item' => '更新',
        'add_new_item' => '新規動物の種類を追加'
      ),
      'meta_box_cb' => 'post_categories_meta_box',
    ) 
  );
}
add_action('init', 'create_pickupanimal_type');

/*
 * 「ITEM」投稿タイプと関連タクソノミー追加
 */
function create_item_type() {
  // 記事タイプ「ITEM」追加
  register_post_type('item',
    array(
      'label' => 'ITEM',
      'public' => true,
      'has_archive' => true,
      'menu_position' => 7, 
      'supports' => [
        'title',
        'editor',
        'thumbnail',
        'custom-fields',
      ]
    )
  );
}
add_action('init', 'create_item_type');

/*
 * 管理画面にサムネイルの設定を入れる
 */
add_theme_support('post-thumbnails');

/*
 * Ajax送信先URL設定
 */
function add_my_ajaxurl() {
?>
  <script>
    var ajaxurl = '<?php echo admin_url( 'admin-ajax.php'); ?>';
  </script>
<?php
}
add_action( 'wp_head', 'add_my_ajaxurl', 1 );

/*
 * JS用サイトドメイン設定
 */
function add_my_domain() {
?>
  <script>
    var siteurl = '<?php echo get_site_url(); ?>';
  </script>
<?php
}
add_action( 'wp_head', 'add_my_domain', 1 );

/*
 * マガジン登録Ajax処理
 */
function func_magazine_register(){
  $result = true;
  $error_list = array();
  
  if($_POST['name'] == '') {
    $result = false;
    $error_list['name'] = 'お名前を入力してください';
  }
  
  if($_POST['kana'] == '') {
    $result = false;
    $error_list['kana'] = 'ふりがなを入力してください';
  } else if(!preg_match("/^[ァ-ヾ]+$/u", $_POST['kana'])){
    $result = false;
    $error_list['kana'] = 'ふりがなのみを入力できます';
  }
  
  if($_POST['mail'] == '') {
    $result = false;
    $error_list['mail'] = 'メールアドレスを入力してください';
  } else if(!preg_match("/^[a-zA-Z0-9_+-]+(.[a-zA-Z0-9_+-]+)*@([a-zA-Z0-9][a-zA-Z0-9-]*[a-zA-Z0-9]*\.)+[a-zA-Z]{2,}$/u", $_POST['mail'])){
    $result = false;
    $error_list['mail'] = 'メールアドレスのフォーマットが正しくありません';
  } else if(email_exists($_POST['mail'])) {
    $result = false;
    $error_list['mail'] = 'メールアドレスは既に登録されました';
  }
  
  if($_POST['year'] == '' || $_POST['month'] == '' || $_POST['date'] == '') {
    $result = false;
    $error_list['mail'] = '生年月日を選択してください';
  } else if(!checkdate($_POST['month'], $_POST['date'], $_POST['year'])) {
    $result = false;
    $error_list['birthday'] = 'ご選択の日付が存在しません';
  }
  
  if($result) {
    $user_id = wp_insert_user(array(
      'user_login' => 'subscriber_' . uniqid(bin2hex(random_bytes(1))),
      'user_pass' => uniqid(bin2hex(random_bytes(1))),
      'user_email' => $_POST['mail'],
      'first_name' => $_POST['name'],
      'last_name' => '',
      'nickname' => $_POST['name'],
      'display_name' => $_POST['name'],
      'show_admin_bar_front' => 'false',
      'role' => 'subscriber',
    ));
    if(!is_wp_error($user_id)) {
      add_user_meta($user_id, 'subscriber_kana', $_POST['kana']);
      add_user_meta($user_id, 'subscriber_birthday', mktime(0, 0, 0, $_POST['month'], $_POST['date'], $_POST['year']));
    } else {
      $result = false;
      $error_list['all'] = 'システムエラーが発生しました、しばらく待って再送信してお願い致します';
    }
  }
  
  $response = array(
    'result' => $result,
    'errors' => $error_list,
  );
  echo json_encode($response);

  die();
}
add_action('wp_ajax_magazine_register', 'func_magazine_register');
add_action('wp_ajax_nopriv_magazine_register', 'func_magazine_register');

/*
 * マガジン解除Ajax処理
 */
function func_magazine_unregister(){
  $result = true;
  $error_list = array();
  
  if($_POST['mail'] == '') {
    $result = false;
    $error_list['mail'] = 'メールアドレスを入力してください';
  } else if(!email_exists($_POST['mail'])) {
    $result = false;
    $error_list['mail'] = 'ご入力のメールアドレスは登録されていません';
  }
  
  if($result) {
    $user = get_user_by('email', $_POST['mail']);
    $result = wp_delete_user($user->ID);
    if(!$result) {
      $error_list['all'] = 'システムエラーが発生しました、しばらく待って再送信してお願い致します';
    }
  }
  
  $response = array(
    'result' => $result,
    'errors' => $error_list,
  );
  echo json_encode($response);

  die();
}
add_action('wp_ajax_magazine_unregister', 'func_magazine_unregister');
add_action('wp_ajax_nopriv_magazine_unregister', 'func_magazine_unregister');

/*
 * 記事一覧HTML構築
 */
if( !function_exists('get_html_post_list') ){
  function get_html_post_list($post_list, $more_flag = false) {
    if($more_flag) {
      $html = '<div class="common-postlist-block more" style="display: none;">';
    } else {
      $html = '<div class="common-postlist-block">';
    }
    $html .= '<div class="common-postlist-block-inner">';
    foreach($post_list as $post) {
      $post_category = get_the_category($post->ID);
      
      $html .= '<div class="common-postlist-item">';
      $html .= '<div class="common-postlist-image">';
      if($post_category) {
        $html .= '<a href="' . get_site_url() . '/' . current($post_category)->slug . '/' . $post->post_name . '/">';
      } else {
        $html .= '<a href="' . get_site_url() . '/' . $post->post_name . '/">';
      }
      $html .= '<img class="common-postlist-thumbnail" src="' . get_the_post_thumbnail_url($post->ID) . '" />';
      
      $special_post = get_field('special_post', $post->ID);
      if($special_post) {
        $html .= '<div class="common-postlist-' . $special_post['value'] . '">';
        $html .= '<p class="common-postlist-' . $special_post['value'] . '-image">';
        $html .= '<img src="' . get_template_directory_uri() . '/assets/img/common/icon-' . $special_post['value'] . '.svg" />';
        $html .= '</p>';
        $html .= '<p class="common-postlist-' . $special_post['value'] . '-text">' . $special_post['label'] . '</p>';
        $html .= '</div>';
      }
      $html .= '</a>';
      
      $html .= '</div>';
      $html .= '<div class="common-postlist-content">';
      $html .= '<div class="common-postlist-info">';
      $html .= '<p class="common-postlist-date">' . date('Y年m月d日', strtotime($post->post_date)) . '</p>';
      
      if($post_category) {
        $html .= '<p class="common-postlist-category ' . current($post_category)->slug . '">';
        $html .= '<a class="full-link" href="' . get_site_url() . '/' . current($post_category)->slug . '/">' . current($post_category)->name . '</a>';
        $html .= '</p>';
      }
      $html .= '</div>';
      
      $html .= '<p class="common-postlist-title">';
      if($post_category) {
        $html .= '<a href="' . get_site_url() . '/' . current($post_category)->slug . '/' . $post->post_name . '/">' . $post->post_title . '</a>';
      } else {
        $html .= '<a href="' . get_site_url() . '/' . $post->post_name . '/">' . $post->post_title . '</a>';
      }
      $html .= '</p>';
      $html .= '<div class="common-postlist-taglist">';
      
      $post_zoo = get_the_terms($post->ID, 'post_zoo');
      if($post_zoo) {
        $html .= '<p class="common-tag zoo">';
        $html .= '<a href="' . get_site_url() . '/zoo/' . current($post_zoo)->slug . '/">' . current($post_zoo)->name . '</a>';
        $html .= '</p>';
      }
      
      $post_author = get_userdata($post->post_author); 
      $html .= '<p class="common-tag author">';
      $html .= '<a href="' . get_site_url() . '/author/' . $post_author->nickname . '/">' . $post_author->last_name . $post_author->first_name . '</a>';
      $html .= '</p>';
      
      $post_kind = get_the_terms($post->ID, 'post_kind'); 
      if($post_kind) {
        $html .= '<p class="common-tag kind">';
        $html .= '<a href="' . get_site_url() . '/kind/' . current($post_kind)->slug . '/">' . current($post_kind)->name . '</a>';
        $html .= '</p>';
      }
      
      $post_tags = get_the_tags($post->ID); 
      if($post_tags) {
        foreach($post_tags as $post_tag) {
          $html .= '<p class="common-tag">#';
          $html .= '<a href="' . get_site_url() . '/tag/' . $post_tag->slug . '/">' . $post_tag->name . '</a>';
          $html .= '</p>';
        }
      }
      
      $html .= '</div>';
      $html .= '</div>';
      $html .= '</div>';
    }
    $html .= '</div>';
    $html .= '</div>';
    return $html;
  }
}

/*
 * トップページもっと見るHTML取得Ajax処理
 */
function func_get_front_more(){
  $end_flag = false;
  
  $offset = intval($_POST['offset']) * FRONT_TOPICS_PER_BLOCK;
  $topic_list = get_posts(
    array(
      'posts_per_page'   => FRONT_TOPICS_PER_BLOCK,
      'offset'           => $offset,
      'orderby'          => 'date',
      'order'            => 'DESC',
      'post_type'        => 'post',
      'post_status'      => 'publish',
    )
  );
  
  $html = get_html_post_list($topic_list);
  
  $topic_count = count(get_posts(array('posts_per_page' => -1, 'post_type' => 'post', 'post_status' => 'publish')));
  
  if($topic_count <= ($offset + FRONT_TOPICS_PER_BLOCK)) {
    $end_flag = true;
  }
  
  $response = array(
    'result' => true,
    'html' => $html,
    'end_flag' => $end_flag,
    'topic_count' => $topic_count,
    'offset' => $offset,
    'end_count' => $offset + FRONT_TOPICS_PER_BLOCK,
  );
  
  echo json_encode($response);

  die();
}
add_action('wp_ajax_get_front_more', 'func_get_front_more');
add_action('wp_ajax_nopriv_get_front_more', 'func_get_front_more');

/*
 * 特定IDの投稿の「いいね」ボタン構築（WP ULikeを有効化する必要がある）
 */
if( !function_exists('get_the_ulike_btn') ){
  function get_the_ulike_btn( $post_id ){
    $attributes    = apply_filters( 'wp_ulike_posts_add_attr', null );
    $options       = wp_ulike_get_option( 'posts_group' );
    $post_settings = wp_ulike_get_post_settings_by_type( 'likeThis' );

    // Check deprecated option name
    if( ! empty( $options['disable_likers_pophover'] ) && ! isset( $options['likers_style'] ) ){
      $options['likers_style'] = 'default';
    }

    //Main data
    $defaults = array_merge( $post_settings, array(
      "id"                   => $post_id,
      "method"               => 'likeThis',
      "type"                 => 'post',
      "wrapper_class"        => '',
      "up_vote_inner_text"   => '',
      "down_vote_inner_text" => '',
      "options_group"        => 'posts_group',
      "attributes"           => $attributes,
      "logging_method"       => isset( $options['logging_method'] ) ? $options['logging_method'] : 'by_username',
      "display_likers"       => isset( $options['enable_likers_box'] ) ? $options['enable_likers_box'] : 0,
      "disable_pophover"     => isset( $options['disable_likers_pophover'] ) ? $options['disable_likers_pophover'] : 0,
      "likers_style"         => isset( $options['likers_style'] ) ? $options['likers_style'] : 'popover',
      "style"                => isset( $options['template'] ) ? $options['template'] : 'wpulike-default',
      "button_type"          => isset( $options['button_type'] ) ? $options['button_type'] : 'image',
      "only_logged_in_users" => isset( $options['enable_only_logged_in_users'] ) ? $options['enable_only_logged_in_users'] : 0,
      "logged_out_action"    => isset( $options['logged_out_display_type'] ) ? $options['logged_out_display_type'] : 'button',
    ) );

    $parsed_args = wp_parse_args( $args, $defaults );
    // Output templayte
    $output      = wp_ulike_display_button( $parsed_args );
    
    echo $output;
  }
}

/*
 * 「いいね」ボタンの数値表示に「+」を消す（WP ULikeを有効化する必要がある）
 */
function wp_ulike_new_format_number($value, $num, $plus){
    if ($num >= 1000 && get_option('wp_ulike_format_number') == '1'):
    $value = round($num/1000, 2) . 'K';
    else:
    $value = $num;
    endif;
    return $value;
}
add_filter('wp_ulike_format_number','wp_ulike_new_format_number',10,3);