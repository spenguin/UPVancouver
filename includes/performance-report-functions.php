<?php
/**
 * Performance Report functions
 */

function array_csv_download( $performance_id, $filename = "export.csv", $delimiter=";" )
{ 
    $tickets_sold   = get_post_meta($performance_id,'tickets_sold', TRUE); 
    $tickets        = getSingleShowTickets(); die(pvd($tickets));
    $column_headings= [
        'Name',
        'Paid status',
        'Season',
        'Preview',
        'Student',
        'Senior',
        'Adult',
        'Comp',
        'Order Note',
        'Order Note (Admin)',
        'Customer Note (Admin)'
    ];

    
    header( 'Content-Type: application/csv' );
    header( 'Content-Disposition: attachment; filename="' . $filename );

    // clean output buffer
    ob_end_clean();
    
    $handle = fopen( 'php://output', 'w' );

    // use keys as column titles
    fputcsv( $handle, $column_headings );

    foreach ( $tickets_sold as $key => $order ) {
        if( $key == "count" ) continue;
        $order_notes    = get_order_note($key); 


        fputcsv( $handle, $value );
    }

    fclose( $handle );

    // flush buffer
    ob_flush();
    
    // use exit to get rid of unexpected output afterward
    exit();
}