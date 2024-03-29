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

/**
 * Get tickets as an array
 */
function get_tickets()
{
    $args = array(
        'post_type' => 'ticket',
        'posts_per_page' => -1
    );
    $o  = [];
    $loop = new WP_Query($args);
    if ($loop->have_posts()) :
        while ($loop->have_posts()) : $loop->the_post();
            $ticketId       = get_the_ID();
            $ticket_charge  = get_post_meta($ticketId, 'ticket_charge', TRUE);
            $o[]   = [
                'ticketid'  => $ticketId,
                'name'      => get_the_title(),
                'charge'    => $ticket_charge,
                'quantity'  => 0
            ];
        endwhile;
    endif;
    wp_reset_postdata();
    return $o;
}

/**
 * @author: John Anderson
 * @since: 7 August 2023
 * Get ticket details
 * @param (bool) Season tickets
 * @return (array)
 */
function getTickets( $seasonTickets = FALSE, $showCount = 1 )
{
    $args = [
        'post_type' => 'ticket',
        'posts_per_page' => -1,
        'tax_query' => [
            [
            'taxonomy'  => 'ticket-type',
            'field'     => 'slug',
            'terms'     => $seasonTickets ? 'season-ticket' : 'single-show'
            ]
        ]
    ]; 
    $o  = [];
    $query = new WP_Query($args); 
    if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
            $ticketId       = get_the_ID();
            $ticket_charge  = get_post_meta($ticketId, 'ticket_charge', TRUE) * $showCount;
            $o[]   = [
                'ticketid'  => $ticketId,
                'name'      => get_the_title(),
                'charge'    => $ticket_charge,
                'quantity'  => 0
            ];
        endwhile;
    endif;
    wp_reset_postdata();
    return $o;
}

/**
 * @author: John Anderson
 * @since: 10 August 2023
 * Is the Season Ticket Special still available?
 * @return (bool)
 */
function isTicketSpecialAvailable()
{
    // For now
    return TRUE;
}
