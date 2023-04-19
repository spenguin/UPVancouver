<?php

namespace CustomPosts;

use WP_Query;

\CustomPosts\initialize();

function initialize()
{
    add_action('init', '\CustomPosts\custom_post_type', 0);
    add_action('init', '\CustomPosts\custom_taxonomy_type', 0);
    add_action('admin_init', '\CustomPosts\admin_init');
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
        'supports'            => array('title', 'editor', 'thumbnail', 'excerpt'),
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
}


function show_dates()
{
    global $post;
    $custom = get_post_custom($post->ID);
    $start_date = ($custom['start_date'][0]) ? $custom['start_date'][0] : '';
    $end_date   = ($custom['end_date'][0]) ? $custom['end_date'][0] : '';
?>
    <label for="start_date">Start Date:</label>
    <input type="date" name="start_date" value="<?php echo (empty($start_date) ? date('d/m/Y') : date('d/m/Y', $start_date)); ?>">
    <label for="end_date">End Date:</label>
    <input type="date" name="end_date" value="<?php echo (empty($end_date) ? date('d/m/Y') : date('d/m/Y', $end_date)); ?>">

<?php
}
