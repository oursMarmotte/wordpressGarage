<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title(''); ?></title>
    
    <?php wp_head() ?>




   

</head>


<body>
    <header>
    
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <div class="logo-site mb-2">
     
    </div>
    <a class="navbar-brand" href="<?php echo home_url(); ?>">
      <div class="info-name">
  <?php bloginfo('name'); ?>
      </div>
    
    </a>
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="<?php esc_attr_e('Menu', 'mon-theme'); ?>">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="mainNav">
      <?php
        wp_nav_menu(array(
          'theme_location' => 'header_menu',
          'container'      => false,
          'menu_class'     => 'navbar-nav top-menu  ms-auto mb-2 mb-lg-0',
          'fallback_cb'    => '__return_false',
          'depth'          => 2,
          'walker'         => new WP_Bootstrap_Navwalker() ,// (optionnel, voir étape 3)
        ));
      ?>
    </div>
  </div>
</nav>


    </header>
