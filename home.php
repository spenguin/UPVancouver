<?php

/**
 * The Home Page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package UPVancouver
 */

get_header();
?>

<main id="primary" class="site-main">
    <section class="hero">
        <img class="hero-image" src="<?php echo get_template_directory_uri(); ?>/assets/UPV_Home_Hero_temp.jpg" />
        <div class="hero__show"><strong>Hedda Gabler</strong> running from 24 March to 16 April</div>
        <div class="hero__upv">
            <div class="hero__upv-statement">
                <h1>United Players of Vancouver</h1> from the second to the eighteenth year of her life, was brought up under my care, and, except when at school under my roof.
            </div>
            <div class="hero__upv-logo"><img src="http://upv.penguintestflight.com/wp-content/uploads/2023/04/UPV-logo.png" /></div>
        </div>
    </section>



</main><!-- #main -->

<?php
// get_sidebar();
get_footer();
