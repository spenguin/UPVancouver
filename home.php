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
        <div class="hero__main max-wrapper">
            <img class="hero-image" src="<?php echo get_template_directory_uri(); ?>/assets/defaultheroimage.jpg" />
            <div class="hero__text-wrapper">
                <!-- <div class="hero__show"><a href=""><span class="hero__show--text"><strong>Hedda Gabler</strong> running from 24 March to 16 April</span></a></div> -->
                <div class="hero__upv">
                    <div class="hero__upv-statement">
                        <?php
                        echo getPostByTitle('UPV Opening Statement');
                        ?>
                    </div>
                    <div class="hero__upv-logo"><img src="http://upv.penguintestflight.com/wp-content/uploads/2023/04/UPV-logo.png" /></div>
                </div>
            </div>
        </div>
        <div class="hero__mobile">
            <div class="hero__mobile--logo"><img src="http://upv.penguintestflight.com/wp-content/uploads/2023/04/UPV-logo.png" /></div>
            <div class="hero__mobile--statement">
                <?php echo getPostByTitle('UPV Opening Statement'); ?>
            </div>
        </div>
    </section>

    <section class="shows max-wrapper">
        <div class="shows__wrapper">
            <?php get_template_part('template-parts/content-show-list'); ?>
        </div>
    </section>

    <!-- <section class="news">
        <div class="news__article">
            <div class="news__article--text">
                <h2>United Players welcomes a new Artistic Director</h2>
                <p>United Players is delighted to announce the appointment of its new Artistic Director, Sarah Rodgers. Sarah has been sharing her creative talents with United Players for several years as a director, most recently with a show opening this month, <strong>The Thursday Night Bridge Circle</strong>. We look forward to her creativity, enthusiasm and leadership talents moving United Players forward to continued success as she works towards creating vibrant, exciting and meaningful seasons in our future.</p>
                <p>Welcome Sarah. We are so happy to have you as Artistic Director.</p>
            </div>
            <div class="news__article--image">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/New-AD-Sarah-Rodgers.jpg" />
            </div>
        </div>
    </section> -->

</main><!-- #main -->

<?php
// get_sidebar();
get_footer();
