<?php get_header(); ?>

<?php if ( have_posts() ) : ?>
  <div class="grid">
    <?php while ( have_posts() ) : the_post(); ?>
      <article class="card">
        <?php if ( has_post_thumbnail() ) : ?>
          <a href="<?php the_permalink(); ?>" style="display:block;margin-bottom:8px;">
            <?php the_post_thumbnail('medium_large', ['style'=>'width:100%;height:auto;border-radius:8px;']); ?>
          </a>
        <?php endif; ?>
        <h2 style="font-size:1.25rem;"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <p style="opacity:.7;margin:0 0 8px 0;">
          Publié le <?php echo esc_html( get_the_date() ); ?> par <?php the_author(); ?>
        </p>
        <div><?php the_excerpt(); ?></div>
        <p style="margin-top:8px;"><a href="<?php the_permalink(); ?>">Lire la suite</a></p>
      </article>
    <?php endwhile; ?>
  </div>

  <div class="pagination">
    <?php the_posts_pagination(); ?>
  </div>
<?php else : ?>
  <p>Aucun contenu trouvé.</p>
<?php endif; ?>

<?php get_footer(); ?>
