<?php
/**
 * Functions specific for the Ticket Admin page
*/

function get_order_note($order_id)
{
    $tmp    = get_post_meta( $order_id, 'custom_field_name', TRUE ); 

    if(empty($tmp)) return '';
    $tmp    = unserialize(base64_decode($tmp)); 

    return $tmp; //unserialize(base64_decode($tmp));
    
    // $custom = get_post_custom($order_id); 

    // $notes  = unserialize(base64_decode($custom['custom_field_name'][0])); var_dump($notes);
}

function set_order_note( $order_id, $note )
{
    $tmp    = base64_encode(serialize($note)); 
    add_post_meta( $order_id, 'custom_field_name', $tmp );
}


function get_order_customer( $order )
{
    $billing_email  = $order->get_billing_email(); 
    return get_user_by( 'email', $billing_email ); 
}


function set_admin_order_note($order_id)
{
    $admin_order_note   = '';
    $admin_order_notes  = wc_get_order_notes([
        'order_id' => $order_id
     ]); 
    if( !empty($admin_order_notes) && strpos($admin_order_notes[0]->content, '[ta]') !== FALSE )
    {
        $admin_order_note = trim(substr($admin_order_notes[0]->content, 4 )); 
    }
    return $admin_order_note;
}