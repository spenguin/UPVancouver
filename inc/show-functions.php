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

// May not be needed FIX
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

/**
 * Find the current or upcoming Season 
 */
function get_season()
{
    $yearStr    = 'Our ' . date('Y') . ' - ' . date('Y') + 1 . ' Season';

    $season     = get_term_by('name', $yearStr, 'season');
    return $season;
}

/** 
 * Find the Shows based on the Season
 */
function get_shows_listing($seasonId)
{
    // Any shows promoted before the Season Listing?

    $args = [
        'post_type' => 'show',
        'tax_query' => array(
            array(
                'taxonomy' => 'season',
                'field' => 'term_id',
                'terms' => $seasonId
            )
        ),
        'meta_key'  => 'promote_show',
        'meta_value'=> "1"        
    ];
    $query = new WP_Query($args);
    if( $query->have_posts()) : while( $query->have_posts()) : $query->the_post();
        $post_id = get_the_ID(); //var_dump(get_post_thumbnail_id( $post_id));
        ob_start();
        ?>
            <div class="shows_promoted-show">
                <a href="">
                    <?php the_post_thumbnail('show_listing'); ?>
                </a>
            </div>
        <?php
    endwhile; endif; wp_reset_postdata();

    
    
    $args = array(
        'post_type' => 'show',
        'tax_query' => array(
            array(
                'taxonomy' => 'season',
                'field' => 'term_id',
                'terms' => $seasonId
            )
        ),
        'ordeby'        => 'ID',
        'order'         => 'ASC'
        // 'meta_key'       => 'start_date',    //This didn't quite work but it's the better way
        // 'orderby'       => 'meta_value_num',
        // 'order'          => 'ASC'
    );
    $query = new WP_Query($args);
    // var_dump($query);
 
    if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
        ?>
            <div class="shows__list-show">
                <?php if (has_post_thumbnail()) { ?>
                    <!-- <a href=""><img src="<?php  echo get_template_directory_uri(); ?>/assets/upv-show-banner-sm.jpg" /> -->
                        <div class="shows__list-info">
                            <h4>Tickets & Details</h4>
                            <h3><?php get_the_title(); ?></h3>
                        </div>
                    </a>
                <?php
                } else { ?>
                    <div class="shows__list-info">
                        <?php echo the_excerpt(); ?>
                    </div>
                <?php
                } ?>
            </div>
<?php
        endwhile;
    endif;
    wp_reset_postdata();
    return ob_get_clean();
}


/**
 * @author: John Anderson
 * @since: 7 August 2023
 * Get the shows for the current season
 * @param (int) season Id
 * @return (object) shows
 */
function getShowsBySeasonId( $seasonId, $notPast = FALSE )
{
    $args = array(
        'post_type' => 'show',
        'tax_query' => array(
            array(
                'taxonomy' => 'season',
                'field' => 'term_id',
                'terms' => $seasonId
            )
        ),
        'ordeby'        => 'ID',
        'order'         => 'ASC',
        'meta_key'      => 'end_date',    //This didn't quite work but it's the better way
        'meta_value'    => date( 'Y-m-d' ),
        'meta_compare'  => '>='
    );
    $query = new WP_Query($args); 
    wp_reset_postdata();

    return $query;
}

/**
 * @author: John Anderson
 * @since: 7 August 2023
 * List the shows
 * @param (object) shows
 * @return (str) shows Listing
 */
function listShows( $shows )
{   
    ob_start();
    if ($shows->have_posts()) : while ($shows->have_posts()) : $shows->the_post();
        ?>
            <div class="shows__list-show">
                <div class="shows__list-info">
                    <?php echo the_excerpt(); ?>
                </div>
            </div>
    <?php
        endwhile;
    endif;
    return ob_get_clean();
}

/**
 * @author: John Anderson
 * @since: 7 August 2023
 * Generate the current season shows listing
 */
function generateSeasonShowsListing()
{

    return '<h1>' . $season->name . '</h1>' . listShows( $shows );
}
