<?php get_header()?>

<h1>Welcome to single pet</h1>


<?php
while(have_posts()){
the_post(); ?>
<div>
<p>thie a dog page not post</p>
<h2><?php the_title()?></h2>
<div class="content">
    <?php the_content()?>
</div>
</div>
<?php }
?>

<p>Footer</p>