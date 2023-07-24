<?php

/**
 * Custom post functions
 */

/**
 * Get post by title
 * @param (str) title
 * @returns (str) post content
 */

function getPostByTitle($title = NULL)
{
    global $wpdb;

    if (is_null($title)) return "";

    $mypostids = $wpdb->get_col("select ID from $wpdb->posts where post_title = '" . $title . "'");

    $args = array(
        'post__in'  => $mypostids,
        'post_type' => 'post',
        'orderby'   => 'title',
        'order'     => 'asc'
    );

    $query  = new WP_Query($args);

    $content    = $query->posts[0]->post_content;
    $content    = apply_filters('the_content', $content);
    $content    = str_replace(']]>', ']]&gt;', $content);

    return $content;
}
