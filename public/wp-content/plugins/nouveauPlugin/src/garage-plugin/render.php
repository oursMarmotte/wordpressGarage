<?php


$args = array(
    'post_type'      => 'voiture',
    'posts_per_page' => -1, // tous les résultats
    'tax_query'      => array(
        array(
            'taxonomy' => 'marque',     // ta taxonomie
            'field'    => 'slug',       // ou 'term_id'
            'terms'    => 'renault',    // valeur à filtrer
        ),
    ),
    'meta_query'     => array(
        array(
            'key'     => 'annee',       // nom de ton champ personnalisé
            'value'   => 2010,
            'compare' => '>',           // supérieur à
            'type'    => 'NUMERIC'      // important pour comparer des nombres
        ),
    ),
);

$query = new WP_Query($args);

if ($query->have_posts()) {
    while ($query->have_posts()) {
        $query->the_post(); ?>
<div class="col col-3 card">
	<h2>
<?php echo the_title(); ?>
	</h2>
	<h3><a href="<?php the_permalink();?>">lien</a></h3>
</div>


     <?php echo '<h2>' . get_the_title() . '</h2>';
        echo '<p>Année : ' . get_post_meta(get_the_ID(), 'annee', true) . '</p>';
    }
    wp_reset_postdata();
} else {
    echo '<p>Aucune Renault après 2010 trouvée 🚗</p>';
}
?>
