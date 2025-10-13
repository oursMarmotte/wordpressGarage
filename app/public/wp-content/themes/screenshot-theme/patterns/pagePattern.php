<?php
/**
 * Title: Post
 * Slug: screenshot-theme/pagePattern
 * Categories: featured
 */
?>


<!-- wp:group {"layout":{"type":"constrained"},"style":{"spacing":{"padding":{"top":"40px","bottom":"40px"}}}} -->
<div class="wp-block-group" style="padding-top:40px;padding-bottom:40px">
    <!-- wp:query {"queryId":1,"query":{"perPage":6,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date"},"displayLayout":{"type":"flex","columns":3}} -->
    <div class="wp-block-query">
        <!-- wp:post-template -->
            <!-- wp:group {"style":{"border":{"radius":"var(--wp--custom--radius--2xl)"},"spacing":{"padding":{"top":"16px","bottom":"16px","left":"16px","right":"16px"}},"color":{"background":"var(--wp--preset--color--primary)"}}} -->
            <div class="wp-block-group has-background" style="border-radius:var(--wp--custom--radius--2xl);padding:16px;background-color:var(--wp--preset--color--primary)">
                <!-- wp:post-featured-image {"isLink":true,"width":"100%","height":"200px","style":{"border":{"radius":"var(--wp--custom--radius--xl)"}}} /-->
                <!-- wp:post-title {"isLink":true} /-->
                <!-- wp:post-excerpt {"moreText":"Lire la suite"} /-->
            </div>
            <!-- /wp:group -->
        <!-- /wp:post-template -->
        <!-- wp:query-pagination {"layout":{"type":"flex","justifyContent":"center"}} -->
        <div class="wp-block-query-pagination">
            <!-- wp:query-pagination-previous /-->
            <!-- wp:query-pagination-numbers /-->
            <!-- wp:query-pagination-next /-->
        </div>
        <!-- /wp:query-pagination -->
    </div>
    <!-- /wp:query -->
</div>
<!-- /wp:group -->