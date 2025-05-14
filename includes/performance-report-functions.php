<?php
/**
 * Performance Report functions
 */

function array_csv_download( $performance, $filename = "export.csv" )
{ 
    $tickets_sold   = get_post_meta($performance->ID,'tickets_sold', TRUE);
    $tickets        = getSingleShowTickets(); //die(pvd($tickets));
    $column_headings= [
        // 'name'      => 'Name',
        // 'status'    => 'Paid Status',
        // 'season'    => 'Season',
        // 'preview'   => 'Preview',
        // 'student'   => 'Student',
        // 'senior'    => 'Senior',
        // 'adult'     => 'Adult',
        // 'comp'      => 'Comp',
        // 'order_note'=> 'Order Note',
        // 'order_note_admin'      => 'Order Note (Admin)',
        // 'customer_note_admin'   => 'Customer Note (Admin)'
        'Name',
        'Phone',
        'Paid Status',
        'Seasons',
        'Preview',
        'Student',
        'Senior',
        'Adult',
        'Comp',
        'Seating',
    ];

    
    header( 'Content-Type: application/csv' );
    header( 'Content-Disposition: attachment; filename="' . $filename );

    // clean output buffer
    ob_end_clean();
    
    $handle = fopen( 'php://output', 'w' );

    // use keys as column titles
    fputcsv( $handle, $column_headings );

    foreach ( $tickets_sold as $order_id => $stuff ) {
        if( $order_id == "count" ) continue;
        $value  = array_fill(0, 10, 0 );

        $order_notes    = get_order_note($order_id); pvd($order_notes);

        // Get the customer details first
        $order  = wc_get_order( $order_id ); 
        $email  = $order->get_billing_email(); 
        
        if( $email == get_option('admin_email') ) // Using default email
        {   
            $value[0]   = $order_notes['customer_contact']['name']; 
            $value[1]   = $order_notes['customer_contact']['phone'];
            } else {
            $value[0]   = $order->get_billing_first_name() . ' ' . $order->get_billing_last_name();
            $value[1]   = $order->get_billing_phone();
        }

        $value[2]    = array_key_exists( 'boxoffice', $order_notes ) ? 'boxoffice' : 'complete';
        
        foreach( $order_notes as $key => $ticket_order )
        {
            if( $key == "amended" ) continue; // Are there other keys I need to check for?
            if( $key == "customer_contact" ) continue;

            if( $ticket_order['date'] != $performance->post_title ) continue; // Not for this performance
            $value[array_search($ticket_order['name'], $column_headings)]   = $ticket_order['quantity'];

        }
        fputcsv( $handle, $value );
    }

    fclose( $handle );

    // flush buffer
    ob_flush();
    
    // use exit to get rid of unexpected output afterward
    exit();
}