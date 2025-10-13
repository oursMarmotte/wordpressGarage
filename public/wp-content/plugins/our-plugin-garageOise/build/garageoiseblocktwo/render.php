


<?php


// Shortcode principal
function rp_shortcode_recherche_taxonomies()
{
    // 🔹 Personnalise ici : liste des taxonomies à utiliser
    $taxonomies = array('occasion', 'annee'); 

    // Récupération des valeurs envoyées
    $filters = array();
    foreach ($taxonomies as $tax) {
        if (isset($_GET[$tax]) && !empty($_GET[$tax])) {
            $filters[$tax] = sanitize_text_field($_GET[$tax]);
        }
    }

    ob_start();
    ?><div class=" second-block col card">
		<div class="form-group">
    <form method="get" action="">
        <?php foreach ($taxonomies as $tax) : ?>
            <?php
            $terms = get_terms(array(
                'taxonomy'   => $tax,
                'hide_empty' => false,
            ));
            if (!empty($terms) && !is_wp_error($terms)) :
            ?>
                <label for="<?php echo esc_attr($tax); ?>">
                    <?php echo ucfirst($tax); ?> :
                </label>
                <select class="form-control" name="<?php echo esc_attr($tax); ?>" id="<?php echo esc_attr($tax); ?>">
                    <option value="">-- Tous --</option>
                    <?php foreach ($terms as $term) : 
                        $selected = (isset($filters[$tax]) && $filters[$tax] == $term->slug) ? 'selected' : '';
                    ?>
                        <option value="<?php echo esc_attr($term->slug); ?>" <?php echo $selected; ?>>
                            <?php echo esc_html($term->name); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <br>
            <?php endif; ?>
        <?php endforeach; ?>

        <button class="btn btn-primary" type="submit ">Rechercher</button>
    </form>
    <hr>
	</div>
	</div>
    <?php

    // 🔹 Construire la requête WP_Query
    $tax_query = array('relation' => 'AND');
    foreach ($filters as $tax => $value) {
        $tax_query[] = array(
            'taxonomy' => $tax,
            'field'    => 'slug',
            'terms'    => $value,
        );
    }

    $args = array(
        'post_type'      => 'voiture', // 🔹 Change si tu veux un CPT (ex: voiture)
        'posts_per_page' => 10,
    );

    if (count($tax_query) > 1) {
        $args['tax_query'] = $tax_query;
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        echo '<ul>';
        while ($query->have_posts()) {
            $query->the_post();
            echo '<li><a href="' . esc_url(get_permalink()) . '">' . get_the_title() . '</a></li>';
        }
        echo '</ul>';
    } else {
        echo '<p>Aucun résultat trouvé.</p>';
    }

    wp_reset_postdata();

    return ob_get_clean();
}
 add_shortcode('recherche_taxonomies', 'rp_shortcode_recherche_taxonomies');

