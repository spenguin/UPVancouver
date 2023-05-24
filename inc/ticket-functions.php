<?php

/**
 * Bespoke code to for tickets
 */

function offer_tickets()
{
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1
    );
    $loop = new WP_Query($args);
    if ($loop->have_posts()) {
        while ($loop->have_posts()) : $loop->the_post();
            get_template_part('template-parts/content', get_post_type());
        endwhile;
    } else {
        echo __('No products found');
    }
    wp_reset_postdata();
}
