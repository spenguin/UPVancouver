<?php

/**
 * Template for Custom Post type shows
 */

get_header();
while (have_posts()) :
    the_post();

    $thumbnail_url = get_the_post_thumbnail_url($post->ID);
    $title = get_the_title();
?>
    <img src="<?php echo $thumbnail_url; ?>" alt="<?php echo $title; ?>" />
    <div class="container">

        <header class="title">
            <!-- <h1><?php echo get_the_title(); ?></h1> -->

        </header>
        <div class="content">
            <main>

                <?php echo get_the_content(); ?>
                <?php get_template_part('template-parts/content', get_post_type()); ?>

            </main>
            <sidebar></sidebar>
        </div>

    </div>
<?php
endwhile;
get_footer();
