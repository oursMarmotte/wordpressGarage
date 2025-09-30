<?php
/**
 * Plugin Name: Car Search
 * Description: Plugin de recherche de voitures avec taxonomies.
 * Version: 1.0.0
 * Author: Ton Nom
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Sécurité
}

// Inclure le fichier de rendu (une seule fois)
require_once plugin_dir_path(__FILE__) . 'build/car-search/render.php';

/**
 * Enregistrement du bloc côté serveur
 */
add_action( 'init', function() {
    register_block_type( __DIR__ . '/build/car-search', array(
        'render_callback' => 'rp_render_block',
    ) );
});

// (Optionnel) Réutiliser la fonction de rendu comme shortcode
add_shortcode( 'recherche_taxonomies', 'rp_render_block' );
