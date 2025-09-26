<?php get_header()?>

<h1>Welcome to Page</h1>
<div class="container">

<?php
while(have_posts()){
the_post(); ?>
<div class="row">
<p>this a page not a post</p>
<h2><?php the_title()?></h2>
<div class="content col-12 card">
    <?php the_content()?>
</div>
</div>
<?php }
?>
</div>
<?php get_footer()?>