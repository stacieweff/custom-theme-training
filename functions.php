<?php
function customtheme_resources() {
  wp_enqueue_style('style', get_stylesheet_uri());
}

add_action('wp_enqueue_scripts', 'customtheme_resources');


//get top get_top_ancestor
function get_top_ancestor_id() {
  global $post;
  if ($post->post_parent) {
    $ancestors = array_reverse(get_post_ancestors($post->ID));
    return $ancestors[0];
  }
  return $post->ID;
}

//does page have children
function has_children() {
  global $post;

  $pages = get_pages('child_of=' . $post->ID);
  return count($pages);
}

//customize excerpt word count length
function custom_excerpt_length() {
  return 25;
}

add_filter('excerpt_length', 'custom_excerpt_length');

//Theme setup
function customTheme_setup() {
  //navigation  menus
  register_nav_menus(array(
    'primary' => __('Primary Menu'),
    'footer' => __('Footer Menu'),
  ));

  // Add featured image support
  add_theme_support('post-thumbnails');
  add_image_size('small-thumbnail', 180, 120, true);
  add_image_size('banner-image', 920, 210, array('left', 'top'));

  //Add post format support
  add_theme_support('post-formats', array('aside', 'gallery', 'link'));
}

add_action('after_setup_theme', 'customTheme_setup');

//add widget locations
function ourWidgetsInit() {
  register_sidebar( array(
    'name' => 'Sidebar',
    'id' => 'sidebar1',
    'before_widget' => '<div class="widget-item">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="my-special-class">',
    'after_title' => '</h4>'
  ));

  register_sidebar( array(
    'name' => 'Footer Area 1',
    'id' => 'footer1',
    'before_widget' => '<div class="widget-item">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="my-special-class">',
    'after_title' => '</h4>'
  ));

  register_sidebar( array(
    'name' => 'Footer Area 2',
    'id' => 'footer2',
    'before_widget' => '<div class="widget-item">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="my-special-class">',
    'after_title' => '</h4>'
  ));

  register_sidebar( array(
    'name' => 'Footer Area 3',
    'id' => 'footer3',
    'before_widget' => '<div class="widget-item">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="my-special-class">',
    'after_title' => '</h4>'
  ));

  register_sidebar( array(
    'name' => 'Footer Area 4',
    'id' => 'footer4',
    'before_widget' => '<div class="widget-item">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="my-special-class">',
    'after_title' => '</h4>'
  ));
}

add_action('widgets_init', 'ourWidgetsInit');

//customize appearance options
function custom_theme_customize_register( $wp_customize ) {
  $wp_customize->add_setting('custheme_link_color', array(
    'default' => '#006ec3',
    'transport' => 'refresh',
  ));
  $wp_customize->add_setting('custheme_button_color', array(
    'default' => '#006ec3',
    'transport' => 'refresh',
  ));
  $wp_customize->add_section('custheme_standard_colors', array (
    'title' => __('Standard Colors', 'custom-theme'),
    'priority' => 30,
  ));
  $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'custheme_link_color_control', array(
    'label' => __('Link Color', 'custom-theme'),
    'section' => 'custheme_standard_colors',
    'settings' => 'custheme_link_color',
  )));
  $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'custheme_button_color_control', array(
    'label' => __('Button Color', 'custom-theme'),
    'section' => 'custheme_standard_colors',
    'settings' => 'custheme_button_color',
  )));
}

add_action('customize_register', 'custom_theme_customize_register');

//output customize class
function custheme_customize_css() {
  ?>
  <style type="text/css">
    a:link,
    a:visited {
      color: <?php echo get_theme_mod('custheme_link_color'); ?>;
    }

    .site-header nav ul li.current-menu-item a:link,
    .site-header nav ul li.current-menu-item a:visited,
    .site-header nav ul li.current-page-ancestor a:link,
    .site-header nav ul li.current-page-ancestor a:visited {
      background-color: <?php echo get_theme_mod('custheme_link_color'); ?>;
    }

    .btn-a,
    .btn-a:link,
    .btn-a:visited,
    div.hd-search #searchsubmit {
      background-color: <?php echo get_theme_mod('custheme_button_color'); ?>;
    }
  </style>

  <?php
}

add_action('wp_head', 'custheme_customize_css');

 ?>
