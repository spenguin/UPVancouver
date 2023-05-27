<?php

/**
 * Bespoke functions for show Custom Post Type
 */

function show_details($show_id)
{

    $custom = get_post_custom($show_id);
    $start_date = ($custom['start_date'][0]) ? $custom['start_date'][0] : '';
    $end_date   = ($custom['end_date'][0]) ? $custom['end_date'][0] : '';

    $preview_dates  = get_preview_dates($show_id);
    $talkback_dates = get_talkback_dates($show_id);

    ob_start(); ?>
    <p><span class="show-details__label">Dates:</span> <?php echo date('j M', strtotime($start_date)); ?> - <?php echo date('j M Y', strtotime($end_date)); ?></p>
    <p><span class="show-details__label">Times:</span> Thurs-Sat evenings at 8:00 pm, Sun matinee at 2:00 pm</p>
    <p><span class="show-details__label">Preview:</span> <?php echo join(', ', $preview_dates); ?></p>
    <p><span class="show-details__label">Opening:</span> <?php echo date('j M', strtotime($start_date . '+ ' . count($preview_dates) . ' days ')); ?></p>
    <p><span class="show-details__label">Talkbacks:</span> <?php echo join(', ', $talkback_dates); ?></p>
    <p><span class="show-details__label">Matinées:</span> All Sundays (June 4, 11, 18, 25)</p>
    <?php
    $o = ob_get_clean();
    return $o;
}


function get_preview_dates($show_id)
{
    $args = [
        'post_type'     => 'performance',
        'meta_query'    => [
            [
                'key'   => 'preview',
                'value' => "1"
            ],
            [
                'key'   => 'show_id',
                'value' => $show_id
            ]
        ]
    ];
    $query = new WP_Query($args);
    $o = [];
    if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
            $o[]    = date('j M', strtotime(get_the_title()));

        endwhile;
    endif;
    wp_reset_postdata();

    return $o;
}

function get_talkback_dates($show_id)
{
    $args = [
        'post_type'     => 'performance',
        'posts_per_page' => -1,
        'meta_query'    => [
            [
                'key'   => 'talkback',
                'value' => "1"
            ],
            [
                'key'   => 'show_id',
                'value' => $show_id
            ]
        ]
    ];
    $query = new WP_Query($args);
    $o = [];
    if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
            $o[]    = date('j M', strtotime(get_the_title()));

        endwhile;
    endif;
    wp_reset_postdata();

    return $o;
}

function show_calendar($show_id)
{
    $dates = get_calendar_values($show_id);
    ob_start();
    foreach ($dates as $k => $date) {
    ?>
        <div class="calendar__entry">
            <?php echo date('j M', $k); ?>
            <?php echo !empty($date['preview']) ? ' Preview ' : ''; ?>
            <?php echo !empty($date['talkback']) ? ' Talkback ' : ''; ?>
        </div>
<?php
    }
}

function get_calendar_values($show_id)
{
    $args = [
        'post_type'     => 'performance',
        'posts_per_page' => -1,
        'meta_query'    => [
            [
                'key'   => 'show_id',
                'value' => $show_id
            ]
        ],
        'orderby'
    ];
    $query = new WP_Query($args);
    $o = [];
    if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
            $post_id = get_the_ID();
            $custom = get_post_custom($post_id);
            $o[strtotime(get_the_title())]  = [
                'preview'   => isset($custom['preview']) ? $custom['preview'][0] : '',
                'talkback'  => isset($custom['talkback']) ? $custom['talkback'][0] : ''
            ];
        endwhile;
    endif;
    wp_reset_postdata();

    ksort($o);

    return $o;
}
