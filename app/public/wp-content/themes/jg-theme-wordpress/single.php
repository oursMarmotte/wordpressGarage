
<?php get_header(); ?>

<h1>Welcome to single</h1>

<?php
while(have_posts()){
the_post(); ?>
<div class="container">
<div class="row">
<div class="col-3">
    <h2><?php the_title()?></h2>
</div>

</div>

<div class="row ">

    
    <div class="col col-6">
    <?php the_post_thumbnail('large', array('class'=>'img-fluid rounded')); ?>
    </div>

        <div class="col col-4">
<?php the_content('medium', array('class'=>'img-fluid rounded'))?>
    </div>
</div>
</div>
<?php }
?>

<?php get_footer()?>