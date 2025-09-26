<?php
/**
 * Screenshot Theme functions and definitions
 */

if ( ! function_exists( 'screenshot_theme_setup' ) ) {
    function screenshot_theme_setup() {
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'responsive-embeds' );
        add_theme_support( 'editor-styles' );
        add_theme_support( 'wp-block-styles' );
        add_theme_support( 'custom-units' );
        add_theme_support( 'appearance-tools' );
        add_theme_support( 'automatic-feed-links' );
        // Register menus (also usable by Navigation block as sources)
        register_nav_menus( array(
            'primary' => __( 'Primary Menu', 'screenshot-theme' ),
            'footer'  => __( 'Footer Menu', 'screenshot-theme' ),
        ) );
    }
}
add_action( 'after_setup_theme', 'screenshot_theme_setup' );

// Enqueue optional front-end assets
add_action( 'wp_enqueue_scripts', function() {
    wp_enqueue_style( 'screenshot-theme-custom', get_theme_file_uri( '/assets/css/custom.css' ), array(), '1.0.0' );
    wp_enqueue_script( 'screenshot-theme-custom', get_theme_file_uri( '/assets/js/custom.js' ), array(), '1.0.0', true );
} );
