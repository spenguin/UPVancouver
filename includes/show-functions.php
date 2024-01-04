<?php
/**
 * Season functions
 */

/**
 * Get the current season. 
 * Where the season is over, get the upcoming season
 * @return (object) Season
 */
/**
 * Find the current or upcoming Season 
 */
function getSeason()
{
    $yearStr    = date('Y');
    $possibleSeasons    = get_terms( [
        'taxonomy'  => 'season',
        'name__like'    => $yearStr
    ] );

    return $possibleSeasons[0];
}

/**
 * Get shows from season
 * @param (int) seasonId
 * @return (object) result
 */
function getShowsBySeason( $seasonId)
{
    if( empty( $seasonId) ) return NULL;

    $args = array(
        'post_type' => 'show',
        'tax_query' => array(
            array(
                'taxonomy' => 'season',
                'field' => 'term_id',
                'terms' => $seasonId
            )
        ),
        'orderby'        => 'ID',
        'order'         => 'ASC'
        // 'meta_key'       => 'start_date',    //This didn't quite work but it's the better way
        // 'orderby'       => 'meta_value_num',
        // 'order'          => 'ASC'
    );
    $query = new WP_Query($args);

    return $query;
}

/**
 * Display shows from season
 * @param (int) seasonId
 * @return (array) shows
 */
function displayShowsBySeason($seasonId = NULL, $format = NULL )
{
    // if( empty( $seasonId) ) return [];

    // $args = array(
    //     'post_type' => 'show',
    //     'tax_query' => array(
    //         array(
    //             'taxonomy' => 'season',
    //             'field' => 'term_id',
    //             'terms' => $seasonId
    //         )
    //     ),
    //     'orderby'        => 'ID',
    //     'order'         => 'ASC'
    //     // 'meta_key'       => 'start_date',    //This didn't quite work but it's the better way
    //     // 'orderby'       => 'meta_value_num',
    //     // 'order'          => 'ASC'
    // );
    // $query = new WP_Query($args);
    $query = getShowsBySeason($seasonId);

    if( $query->have_posts() ): while( $query->have_posts() ): $query->the_post();
        $custom = get_post_custom(); 
        switch ($format){
            case 'text-listing':
                ?>
                <a href="<?php echo get_permalink(); ?>" class="show-listing__item">
                    <h3><?php the_title(); ?></h3>
                    <?php echo the_excerpt(); ?>
                    <p class="show-listing__item--date"><?php echo $custom['start_date'][0]; ?> - <?php echo $custom['end_date'][0]; ?></p>
                </a>
                <?php
                break;


        }

    endwhile; endif; wp_reset_postdata();
}

/**
 * Get a count of the still active shows for the current or upcoming season
 * @return (int) showCount
 */
function getActiveSeasonShowCount()
{
    $seasonId = getSeason()->term_id;
    $query = getShowsBySeason($seasonId);
    
    return $query->found_posts; //FIX
}