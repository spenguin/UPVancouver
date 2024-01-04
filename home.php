<?php

/**
 * The home template file
 *
 *
 * @package UPVancouver
 */

get_header();
?>

<main id="primary" class="site-main">
    <?php get_template_part('template-parts/content-home'); ?>

</main><!-- #main -->

<?php
get_sidebar();
get_footer();
