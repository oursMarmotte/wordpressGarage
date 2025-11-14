

<?php

require_once get_template_directory() .'/class-wp-bootstrap-navwalker.php';
require_once get_template_directory().'/inc/ajax-handlers.php';
 require_once get_template_directory().'/inc/ajax-handlersTwo.php';
add_action('after_setup_theme',function(){

    add_image_size('vignette accueil',400,400,true);
    add_image_size('baniere large',1200,500,true);
    add_image_size('portrait',400,400,false);
});

add_filter('image_size_names_choose',function($sizes){

    return array_merge($sizes,array(
        'vignette-accueil' => __('Vignette Accueil (400x300)', 'textdomain'),
        'banniere-large'   => __('Bannière Large (1200x500)', 'textdomain'),
        'portrait'         => __('Portrait (600x800)', 'textdomain'),
    ));
});

// Activer certaines fonctionnalités du thème
function pizza(){
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme','pizza');

// Forcer la barre admin à s'afficher
show_admin_bar(true);

// Charger JS/CSS du thème
function my_theme_enqueue_styles(){
    wp_enqueue_script('jquery');

    // Script principal
    wp_enqueue_script(
        'mon-script',
        get_template_directory_uri() . '/js/main.js',
        array('jquery'),
        '1.0.0',
        true
    );

    // Style principal
    wp_enqueue_style('theme-style', get_stylesheet_uri());

    wp_localize_script(
        'mon-script' ,
        'monscriptAjax',array(
            'ajax_url'=>admin_url('admin-ajax.php'),
            'nonce' =>wp_create_nonce('mon-script_nonce')
        )
    );




    wp_enqueue_script(
        'auto-reservation',
        get_template_directory_uri().'/js/autoreservation.js',
        array('jquery'),
        '1.0.0',
        true


    );


     wp_localize_script(
        'auto-reservation' ,
        'autoreservationAjax',array(
            'ajax_url'=>admin_url('admin-ajax.php'),
            'nonce' =>wp_create_nonce('auto-reservation_nonce')
        )
    );
}
add_action('wp_enqueue_scripts','my_theme_enqueue_styles');



// function jg_handle_ajax_request(){
//     check_ajax_referer('mon-script_nonce','security');
//     $message = sanitize_text_field($_POST['message']?? '');
//     $response = "Message recu coté serveur:" .$message;
//     echo $response;
//     wp_die();
// }

// add_action('wp_ajax_mon_script_action','jg_handle_ajax_request');

// add_action('wp_ajax_nopriv_mon_script_action','jg_handle_ajax_request');

// Charger Bootstrap (CDN)
function jg_theme_enqueue_bootstrap(){
    // CSS Bootstrap
    wp_enqueue_style(
        'bootstrap-css',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css',
        array(),
        '5.3.3'
    );
 wp_enqueue_style(
        'bootstrap-icons',
        'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css',
        array(),
        '1.11.3'
    );
    // Ton style après Bootstrap
    wp_enqueue_style(
        'mon_theme_style',
        get_stylesheet_uri(),
        array('bootstrap-css')
    );

    // JS Bootstrap
    wp_enqueue_script(
        'bootstrap-js',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js',
        array(),
        '5.3.3',
        true
    );
}
add_action('wp_enqueue_scripts','jg_theme_enqueue_bootstrap');

// Enregistrer les menus
function mon_theme_register_menus(){
    register_nav_menus(
        array(
            'header_menu' => __('Menu principal','mon-theme'),
            'footer_menu' => __('Menu pied de page','mon-theme'),
        )
    );
}
add_action('after_setup_theme','mon_theme_register_menus');




function hotelblocks_blockone_block_init() {
	/**
	 * Registers the block(s) metadata from the `blocks-manifest.php` and registers the block type(s)
	 * based on the registered block metadata.
	 * Added in WordPress 6.8 to simplify the block metadata registration process added in WordPress 6.7.
	 *
	 * @see https://make.wordpress.org/core/2025/03/13/more-efficient-block-type-registration-in-6-8/
	 */
	if ( function_exists( 'wp_register_block_types_from_metadata_collection' ) ) {
		wp_register_block_types_from_metadata_collection( __DIR__ . '/build', __DIR__ . '/build/blocks-manifest.php' );
		return;
	}

	/**
	 * Registers the block(s) metadata from the `blocks-manifest.php` file.
	 * Added to WordPress 6.7 to improve the performance of block type registration.
	 *
	 * @see https://make.wordpress.org/core/2024/10/17/new-block-type-registration-apis-to-improve-performance-in-wordpress-6-7/
	 */
	if ( function_exists( 'wp_register_block_metadata_collection' ) ) {
		wp_register_block_metadata_collection( __DIR__ . '/build', __DIR__ . '/build/blocks-manifest.php' );
	}
	/**
	 * Registers the block type(s) in the `blocks-manifest.php` file.
	 *
	 * @see https://developer.wordpress.org/reference/functions/register_block_type/
	 */
	$manifest_data = require __DIR__ . '/build/blocks-manifest.php';
	foreach ( array_keys( $manifest_data ) as $block_type ) {
		register_block_type( __DIR__ . "/build/{$block_type}" );
	}
}
add_action( 'init', 'hotelblocks_blockone_block_init' );




function mes_sidebars() {
    register_sidebar(array(
        'name' => 'Sidebar Articles',
        'id'   => 'sidebar-posts',
    ));
    
    register_sidebar(array(
        'name' => 'Sidebar Pages',
        'id'   => 'sidebar-pages',
    ));
    
    register_sidebar(array(
        'name' => 'Sidebar Page Spécifique',
        'id'   => 'sidebar-unique',
    ));
}
add_action('widgets_init', 'mes_sidebars');

// Afficher la bonne sidebar
function ma_sidebar() {
    // Page unique (changez 'contact' par votre slug de page)
    if (is_page('nos-occasions')) {
dynamic_sidebar('sidebar-unique');

        echo '<div class="mon-shortcode-wrapper">';
echo do_shortcode('[recherche_taxonomies]');
echo '</div>';

    }
    // Articles
    elseif (is_single()) {
        dynamic_sidebar('sidebar-posts');
    }
    // Toutes les pages
    elseif (is_page()) {
        dynamic_sidebar('sidebar-pages');
    }
}

//supprimer le logo Wordpress
add_action('admin_bar_menu', function($wp_admin_bar){
    $wp_admin_bar->remove_node('wp-logo');
}, 999);

