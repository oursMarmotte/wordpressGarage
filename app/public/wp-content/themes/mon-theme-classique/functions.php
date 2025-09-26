<?php
// Charger le style du thème
function mtc_enqueue_styles() {
    wp_enqueue_style('mtc-style', get_stylesheet_uri(), array(), '1.0.0');
}
add_action('wp_enqueue_scripts', 'mtc_enqueue_styles');

// Support de base
add_theme_support('title-tag');
add_theme_support('post-thumbnails');
add_theme_support('html5', array('search-form','comment-form','comment-list','gallery','caption','style','script'));

// Déclarer les menus
function mtc_register_menus() {
    register_nav_menus(array(
        'header_menu' => __('Menu principal', 'mon-theme-classique'),
         'footer_menu' => __('Menu pied de page', 'mon-theme-classique'),
    ));
}
add_action('after_setup_theme', 'mtc_register_menus');
