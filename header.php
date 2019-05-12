<!DOCTYPE html>
<html lang="<?php language_attributes(); ?>">
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="<?php bloginfo('description'); ?>">

  <?php wp_head(); ?>

</head>
<body>
  <header>
    <div class="container">
      <div class="wrapLogo">
        <h2>EVOTHeeee</h2>
      </div>
      <div class="wrapMenuHeader">
          <?php
             wp_nav_menu([
               'menu'            => 'header',
               'theme_location'  => 'header',
               'container'       => 'div',
               'container_id'    => 'bs4navbar',
               'container_class' => 'collapse navbar-collapse',
               'menu_id'         => false,
               'menu_class'      => 'navbar-nav mr-auto',
               'depth'           => 2,
               'fallback_cb'     => 'bs4navwalker::fallback',
               'walker'          => new bs4navwalker()
             ]);
       ?>
      </div>
    </div>
  </header>
