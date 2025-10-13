<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header>
  <div class="container">
    <div style="display:flex;align-items:center;justify-content:space-between;gap:16px;">
      <div>
        <h1 style="margin:0;font-size:1.4rem;">
          <a href="<?php echo esc_url( home_url('/') ); ?>"><?php bloginfo('name'); ?></a>
        </h1>
        <p style="margin:4px 0 0 0;opacity:.8;"><?php bloginfo('description'); ?></p>
      </div>
      <nav>
        <?php
          wp_nav_menu(array(
            'theme_location' => 'header_menu',
            'container'      => false,
            'menu_class'     => 'menu'
          ));
        ?>
      </nav>
    </div>
  </div>
</header>
<main class="container">
