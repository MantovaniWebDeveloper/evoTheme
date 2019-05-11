<?php

function et_setup_theme(){

  add_theme_support('title-tag');

  add_theme_support( 'post-thumbnails' );

  add_image_size('et_big',1400, 800, true);
  add_image_size('et_quadro',600, 600, true);
  add_image_size('et_single',800, 600, true);

  register_nav_menus(array(
    'header' => esc_html__('Header','et'),
  ));
}

add_action('after_setup_theme','et_setup_theme');

/*INCLUDE JAVASCRIPT e CSS FILES*/
/*------------------------*/
function et_scripts(){
  wp_enqueue_script('et_main_js', get_template_directory_uri().'/public/js/main.js', array('jquery'), null, true);
}

add_action('wp_enqueue_scripts','et_scripts');

function et_styles(){
  wp_enqueue_style('et_app_css', get_template_directory_uri().'/public/css/app.css');
  
}

add_action('wp_enqueue_scripts','et_styles');



 ?>
