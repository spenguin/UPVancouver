<?php

/**
 * Bespoke Header functions
 */

function header_display()
{
    $today  = date('Y-m-d');
    $args = [
        'post_type'     => 'show',
        'meta_query'    => [
            [
                'key'       => 'start_date',
                'value'     => $today,
                'compare'   => '<='
            ],
            [
                'key'       => 'end_date',
                'value'     => $today,
                'compare'   => '>'
            ]
        ]
    ];
    $query = new WP_Query($args);
    // var_dump($query);
    if (!$query->found_posts) {
        // Not current shows
        return '<a href="">Next Season Tickets now on sale!</a>';
    } else {
        $current_show = $query->posts[0];
        return '<a href="">Now playing: <strong>' . $current_show->post_title . '</strong></a>';
    }
}
