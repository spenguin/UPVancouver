<?php
/**
 * Page template
 */
get_header();
?>

<main id="primary" class="site-main">
    <?php
        if( have_posts()): the_post();
            the_content();
        endif;
    ?>
        

</main><!-- #main -->

<?php
get_sidebar();
get_footer();
