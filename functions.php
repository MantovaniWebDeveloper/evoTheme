<?php

function et_setup_theme(){

  add_theme_support('title-tag');

  add_theme_support('post-thumbnail');

  add_image_size('et_big',1400, 800, true);
  add_image_size('et_quadro',600, 600, true);
  add_image_size('et_single',800, 600, true);

  register_nav_menus(array(
    'header' => esc_html__('Header','et'),
  ));
}

add_action('after_setup_theme','et_setup_theme');


 ?>
