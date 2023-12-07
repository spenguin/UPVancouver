<?php

/**
 * Bespoke functions for Performance Custom Post Type
 */

/**
 * @since: 18 August 2023
 * Get all performance dates and post_meta values, for a specific showId
 * @param (int) showId
 * @return (array) performanceData
 */

function getPerformanceDates( $showId = NULL )
{
    if( is_null( $showId ) || $showId < 0 ) return [];
    
    $args = [
        'post_type'     => 'performance',
        'posts_per_page' => -1,
        'meta_key'   => 'show_id',
        'meta_value' => $showId
        // ],
        // 'orderby'
    ];
    $query = new WP_Query($args);
    $o = [];
    if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
            $post_id = get_the_ID();
            $custom = get_post_custom($post_id);
            $date   = strtotime(get_the_title());
            $o[$date]  = [
                'date'      => $date,
                'preview'   => isset($custom['preview']) ? $custom['preview'][0] : '',
                'talkback'  => isset($custom['talkback']) ? $custom['talkback'][0] : '',
                'performance_time'  => isset($custom['performance_time']) ? $custom['performance_time'][0] : ''
            ];
        endwhile;
    endif;
    wp_reset_postdata();

    ksort($o);

    return $o;
}