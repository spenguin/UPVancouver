<?php

namespace CustomPosts;

use WP_Query;

\CustomPosts\initialize();

function initialize()
{
    add_action('init', '\CustomPosts\custom_post_type', 0);
    add_action('init', '\CustomPosts\custom_taxonomy_type', 0);
    add_action('admin_init', '\CustomPosts\admin_init');
    add_action('save_post_show', '\CustomPosts\save_show_dates');
    // add_action('save_post_performance', '\CustomPosts\save_performance_meta');
    add_action('save_post_performance', '\CustomPosts\save_preview');
    add_action('save_post_performance', '\CustomPosts\save_talkback');
}

function custom_post_type()
{

    // Set UI labels for Custom Post Type Performances
    $labels = array(
        'name'                => _x('Shows', 'Post Type General Name', 'upv'),
        'singular_name'       => _x('Show', 'Post Type Singular Name', 'upv'),
        'menu_name'           => __('Shows', 'upv'),
        'parent_item_colon'   => __('Parent Show', 'upv'),
        'all_items'           => __('All Shows', 'upv'),
        'view_item'           => __('View Show', 'upv'),
        'add_new_item'        => __('Add New Show', 'upv'),
        'add_new'             => __('Add New', 'upv'),
        'edit_item'           => __('Edit Show', 'upv'),
        'update_item'         => __('Update Show', 'upv'),
        'search_items'        => __('Search Show', 'upv'),
        'not_found'           => __('Not Found', 'upv'),
        'not_found_in_trash'  => __('Not found in Trash', 'upv'),
    );

    // Set other options for Custom Post Type
    $args = array(
        'label'               => __('show', 'upv'),
        'description'         => __('Shows listings', 'upv'),
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        'supports'            => array('title', 'editor', 'thumbnail', 'excerpt'),
        // You can associate this CPT with a taxonomy or custom taxonomy. 
        'taxonomies'          => array('seasons'),
        'rewrite' => array('slug' => 'show', 'with_front' => false),
        /* A hierarchical CPT is like Pages and can have
		* Parent and child items. A non-hierarchical CPT
		* is like Posts.
		*/
        'hierarchical'        => true,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 15,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
    );

    // Registering Custom Post Type Blogs
    register_post_type('show', $args);

    // Set UI labels for Custom Post Type Performances
    $labels = array(
        'name'                => _x('Performances', 'Post Type General Name', 'upv'),
        'singular_name'       => _x('Performance', 'Post Type Singular Name', 'upv'),
        'menu_name'           => __('Performances', 'upv'),
        'parent_item_colon'   => __('Parent Performance', 'upv'),
        'all_items'           => __('All Performances', 'upv'),
        'view_item'           => __('View Performance', 'upv'),
        'add_new_item'        => __('Add New Performance', 'upv'),
        'add_new'             => __('Add New', 'upv'),
        'edit_item'           => __('Edit Performance', 'upv'),
        'update_item'         => __('Update Performance', 'upv'),
        'search_items'        => __('Search Performance', 'upv'),
        'not_found'           => __('Not Found', 'upv'),
        'not_found_in_trash'  => __('Not found in Trash', 'upv'),
    );

    // Set other options for Custom Post Type
    $args = array(
        'label'               => __('performance', 'upv'),
        'description'         => __('Performances listings', 'upv'),
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        'supports'            => array('title'),
        // You can associate this CPT with a taxonomy or custom taxonomy. 
        // 'taxonomies'          => array('seasons'),
        'rewrite' => array('slug' => 'performance', 'with_front' => false),
        /* A hierarchical CPT is like Pages and can have
		* Parent and child items. A non-hierarchical CPT
		* is like Posts.
		*/
        'hierarchical'        => true,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 18,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
    );

    // Registering Custom Post Type Blogs
    register_post_type('performance', $args);
}


function custom_taxonomy_type()
{
    register_taxonomy(
        'season',
        'show',
        array(
            'labels'    => array(
                'name'  => 'Seasons',
                'add_new_item'  => 'Add New Season',
                'new_item_name' => 'New Season'
            ),
            'show_ui'   => TRUE,
            'show_tagcloud' => FALSE,
            'hierarchical'  => TRUE
        )
    );
}

/**
 * Custom Fields in Posts
 */
function admin_init()
{
    add_meta_box('show_dates_meta', 'Show Dates &amp; Times', '\CustomPosts\show_dates', 'show');
    add_meta_box('show_meta', 'Show Name', '\CustomPosts\showName', 'performance', 'side');
    add_meta_box('performance_meta', 'Performance Details', '\CustomPosts\performanceDetails', 'performance', 'side');
    add_meta_box('performance_preview_meta', 'Preview', '\CustomPosts\preview', 'performance', 'side');
    add_meta_box('performance_talkback_meta', 'Talkback', '\CustomPosts\talkback', 'performance', 'side');
}


function show_dates()
{
    global $post;
    $custom = get_post_custom($post->ID);
    $start_date = (isset($custom['start_date'][0])) ? $custom['start_date'][0] : '';
    $end_date   = (isset($custom['end_date'][0])) ? $custom['end_date'][0] : '';
?>
    <label for="start_date">Start Date:</label>
    <input type="date" name="start_date" value="<?php echo $start_date; ?>" />
    <label for="end_date">End Date:</label>
    <input type="date" name="end_date" value="<?php echo $end_date; ?>" />

<?php
}

function save_show_dates()
{
    global $post;
    if (empty($post->ID)) return;
    $custom     = get_post_custom($post->ID);
    $pre_start_date = (isset($custom['start_date'][0])) ? $custom['start_date'][0] : '';
    $pre_end_date   = (isset($custom['end_date'][0])) ? $custom['end_date'][0] : '';
    $start_date = $_POST['start_date'];
    $end_date   = $_POST['end_date'];
    $show_id    = (string) $post->ID;

    $p         = [];


    if ($start_date != $pre_start_date || $end_date != $pre_end_date) {
        update_post_meta($post->ID, 'start_date', $start_date);
        update_post_meta($post->ID, 'end_date', $end_date);

        // Since either the Start Date or the End Date have changed, we need to regenerate all the performance dates
        // delete all posts that have something in a custom field
        \CustomPosts\delete_performances($post->ID);

        // Generate new performance dates
        $options    = get_option('performance_options');
        // var_dump($options);
        $begin      = new \DateTime($start_date);
        $end        = new \DateTime($end_date);
        $interval   = new \DateInterval('P1D');
        $daterange  = new \DatePeriod($begin, $interval, $end);

        for ($i = $begin; $i <= $end; $i->modify('+1 day')) {
            $dateTime = $i->format('j M Y');
            $dayofweek  = (date('w', strtotime($dateTime)) + 6) % 7;
            if (isset($options["'m'"][$dayofweek])) {
                \CustomPosts\create_performance($dateTime, $show_id, $options['performance_field_matinee_starttime']);
            }
            if (isset($options["'e'"][$dayofweek])) {
                \CustomPosts\create_performance($dateTime, $show_id, $options['performance_field_evening_starttime']);
            }
        }
    }
}

function showName()
{
    global $post;
    $custom     = get_post_custom($post->ID);
    $show_id    = $custom['show_id'][0] ? $custom['show_id'][0] : '';
    $showPost   = get_post($show_id);
?>
    <p><?php echo $showPost->post_title; ?></p>
<?php
}

function performanceDetails()
{
    global $post;
    $custom             = get_post_custom($post->ID);
    $performance_time   = $custom['performance_time'][0] ? $custom['performance_time'][0] : '';
?>
    <label for="performance_time">Performance Time:</label>
    <input type="time" name="performance_time" value="<?php echo $performance_time; ?>" />

<?php
}

function save_performance_time()
{
    global $post;
    $performance_time   = $_POST['performance_time'];
    update_post_meta($post->ID, 'performance_time', $performance_time);
}


function create_performance($date, $show_id, $time)
{
    $post_id = wp_insert_post(array(
        'post_type' => 'performance',
        'post_title' => $date,
        'post_content' => '',
        'post_status' => 'publish',
        'comment_status' => 'closed',   // if you prefer
        'ping_status' => 'closed',      // if you prefer
    ));

    if ($post_id) {
        add_post_meta($post_id, 'show_id', $show_id);
        add_post_meta($post_id, 'performance_time', $time);
    }
}

function delete_performances($show_id)
{
    $args = array(
        'posts_per_page'    => -1,
        'post_type'         => 'performance',
        // 'meta_key'          => 'show_id',
        // 'meta_value'        => $show_id
    );
    $the_query = new WP_Query($args);
    if ($the_query->have_posts()) {
        while ($the_query->have_posts()) :
            $the_query->the_post();
            wp_delete_post(get_the_ID());
        endwhile;
    }
    wp_reset_postdata();
}

function preview()
{
    global $post;
    $custom             = get_post_custom($post->ID);
    $preview   = isset($custom['preview']) ? $custom['preview'][0] : '';
?>
    <label for="preview">Preview performance:</label>
    <input type="checkbox" name="preview" value="1" <?php echo ((int) $preview == 1) ? 'checked="checked"' : ''; ?> />

<?php

}

function save_preview()
{
    global $post;
    $preview   = isset($_POST['preview']) ? $_POST['preview'] : '';
    update_post_meta($post->ID, 'preview', $preview);
}

function talkback()
{
    global $post;
    $custom             = get_post_custom($post->ID);
    $talkback   = isset($custom['talkback']) ? $custom['talkback'][0] : '';
?>
    <label for="talkback">Talkback performance:</label>
    <input type="checkbox" name="talkback" value="1" <?php echo ((int) $talkback == 1) ? 'checked="checked"' : ''; ?> />

<?php

}

function save_talkback()
{
    global $post;
    $talkback   = isset($_POST['talkback']) ? $_POST['talkback'] : '';
    update_post_meta($post->ID, 'talkback', $talkback);
}
