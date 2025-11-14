<?php get_header()?>


<div class="container-fluid content-page">

<?php
while(have_posts()){
the_post(); ?>
<div class="title-atelier ">
    <h2><?php the_title()?></h2>
</div>
<div class="row">



<div class="content col-12 ">
    
    <?php the_content()?>
  
</div>

</div>

<?php }
?>
</div>


<?php get_footer()?>