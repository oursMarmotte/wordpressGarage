<?php get_header()?>

<h1>Welcome to ur brand new site INDEX</h1>

<?php
while(have_posts()){
the_post(); ?>
<div>

<h2><a href="<?php the_permalink() ?>"><?php the_title()?></a></h2>
</div>
<?php }
?>

<?php get_footer()?>