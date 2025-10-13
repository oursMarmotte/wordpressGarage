</main>
<footer>
  <div class="container" style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;">
    <p style="margin:0;">&copy; <?php echo date('Y'); ?> — <?php bloginfo('name'); ?></p>
    <nav>
       <?php
        // wp_nav_menu(array(
        //   'theme_location' => 'footer_menu',
        //   'container'      => false,
        //   'menu_class'     => 'menu'
        // ));
      ?> 
    </nav>
  </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
