<?php get_header()?>


<div class="container">

<?php
while(have_posts()){
the_post(); ?>
<div class="title-atelier ">
    <h2><?php the_title()?></h2>
</div>
<div class="row">



<div class="content col-10 card">
    <?php the_content()?>
</div>
<div class="col-2">
<aside class="sidebar">
    <?php ma_sidebar(); ?>
</aside>
</div>
</div>
<?php }
?>
</div>


<?php get_footer()?>