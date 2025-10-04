<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <article>
    <h1><?php the_title(); ?></h1>
    <p style="opacity:.7;">Publié le <?php echo esc_html( get_the_date() ); ?> par <?php the_author(); ?></p>
    <div><?php the_content(); ?></div>
  </article>
<?php endwhile; endif; ?>

<?php get_footer(); ?>
