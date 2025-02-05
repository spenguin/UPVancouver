<?php
/**
 * Add single purchases (or upload purchases as a spreadsheet)
 * Or Edit an existing order
 */

function upv_ticket_admin()
{
    if( isset($_GET['orderId']))
    {
        $order_id = filter_var($_GET['orderId'], FILTER_SANITIZE_NUMBER_INT); 
        
        // Get the order details from the orderId
        $order = wc_get_order( $order_id ); 
        $custom = get_post_custom($order_id); 



        ?>
        <div class="ticket-admin">
            <div class="ticket-admin__edit">
                <h2>Edit Ticket Purchase</h2>
                <?php if(!empty($message)): ?>
                    <div class="error"><?php echo $message; ?>
                <?php endif; ?>
                <?php 
                    if( !isset($custom['custom_field_name']) )
                    {
                        echo '<p>Order not found</p>';
                    } else {
                        $notes  = unserialize(base64_decode($custom['custom_field_name'][0]));
                        ?>
                        <table>
                            <thead>
                                <tr>
                                    <td>Ticket</td>
                                    <td>Quantity</td>
                                    <td>Performance</td>
                                    <td>Charge</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php //var_dump($notes);
                                foreach( $notes as $ticket_id => $note )
                                { //var_dump($note);
                                    $ticket = get_post($ticket_id); 
                                    $term   = reset(get_the_terms($ticket_id, 'product_cat')); 
                                    ?>
                                    <tr>
                                        <td><?php echo $ticket->post_title; ?>
                                            <?php 
                                            if( "Uncategorized" != $term->name)
                                            {
                                                echo ' (' . $term->name . ')';
                                            } ?>
                                        </td>
                                        <td><?php echo $note['quantity']; ?></td>
                                        <td>
                                            <?php 
                                                if( in_array($term->slug, ['season-ticket', 'donation', "uncategorized"] ) )
                                                {
                                                    echo "N/A";
                                                } else {
                                                    // $performance = get_post_by_title($note['date'], '', 'performance' ); 
                                                    $showTitle = get_show_title_by_performance_date($note['date']);
                                                    echo $showTitle . ', ' . $note['date'] . ' ' . $note['time'];
                                                }
                                            ?>
                                        </td>
                                        <td>&dollar;<?php echo number_format($note['misha_custom_price'], 2); ?></td>
                                    </tr>
                                    <?php
                                } ?>
                            </tbody>
                        </table>
                        <?php
                    }
                ?>
            </div>
        </div>

        <?php
        
    } else {

        $show_titles    = get_show_titles();
        $tickets        = getSingleShowTickets(); //pvd($tickets);


        $message        = "";

        if( isset($_POST['add_order'] ))
        {
            $error  = FALSE;
            if( empty( $_POST['seasons'] . $_POST['adult'] . $_POST['senior'] . $_POST['student'] . $_POST['comp'] ) )
            {
                $error      = TRUE;
                $message    = "At least one ticket must be added";
            }
            if( !isset($_POST['payment']) )
            {
                $error  = TRUE;
                $message    = "Payment status must be selected";
            }
            // Test if Comp ticket is selected; Note required
            if( isset($_POST['comp']) && $_POST['comp'] > 1 && !isset($_POST['notes']) )
            {
                $error      = TRUE;
                $message    = "Comp tickets require explanatory note.";
            }
            // Need to confirm that the date is an actual performance date
            $performance = get_post_by_title( date('j M Y', strtotime($_POST['performance_date']) ), '', 'performance' );
            if( is_null($performance) )
            {
                $error      = TRUE;
                $message    = "Performance date is invalid.";
            }

            if( !$error )
            {
                // Get user

                $email  = filter_var($_POST['userEmail'], FILTER_SANITIZE_EMAIL);

                // User already exist            
                $user = get_user_by( 'email', $email );
                if( !$user ) {
                    // Create new user
                    $user_data = [
                        'user_pass'     => wp_generate_password(),
                        'user_login'    => $email,
                        'user_email'    => $email,
                        'role'          => 'attendee'
                    ];
                    wp_insert_user($user_data);
                    $user = get_user_by( 'email', $email );
                }            
                
                
                // Create new order
                $order          = new WC_Order( $email );
                $order->set_created_via( $email ); 
                $order->set_customer_id( $user->ID ); 

                $note           = htmlspecialchars( $_POST['notes'], ENT_QUOTES );
                $order->add_order_note( $note );

                $tickets_ordered    = [];
                $ordered_count      = 0;
                
                foreach( $tickets as $ticketId => $ticketName )
                {
                    if( !empty($_POST[$ticketName] ) )
                    {
                        // WC()->cart->add_to_cart( $ticketId, $_POST[$ticketName], 0, [], ['misha_custom_price' => '0'] );
                        $order->add_product( wc_get_product( $ticketId ), $_POST[$ticketName] );
                        // WC()->cart->add_to_cart( 182, 2, 0, [], ['misha_custom_price' => '0'] );
                        $tickets_ordered[$ticketId] = $_POST[$ticketName];
                        $ordered_count              += $_POST[$ticketName];
                    }
                }
        //         $address = [
        //             'first_name'    => 'Test',
        //             'last_name'     => 'Testerton',
        //             'company'       => '',
        //             'email'         => 'test@testerton.com',
        //             'phone'         => '604 861 1234',
        //             'address_1'     => '123 Any Street',
        //             'address_2'     => '',
        //             'city'          => "Vancouver",
        //             'state'         => 'BC',
        //             'postcode'      => 'V1A 1A1',
        //             'country'       => 'CA'
        //         ];            

        // $order->set_address( $address, 'billing' );
        // $order->set_address( $address, 'shipping' );

                $order->calculate_totals();
                $payment_status = $_POST['payment'] ? 'wc-completed' : 'wc-pending'; 

                $order->set_status( $payment_status );
                $orderId = $order->save(); //die(pvd($order));

                // Add order to Performance
                $tickets_sold = get_post_meta( $performance->ID, 'tickets_sold', TRUE ); 
                if( empty($tickets_sold) )
                {
                    $tickets_sold           = [];
                    $tickets_sold['count']  = 0;
                } 
                $tickets_sold['count']  += $ordered_count;
                $tickets_sold[$orderId] = $tickets_ordered; 
                update_post_meta( $performance->ID, 'tickets_sold', $tickets_sold );
                $_POST = [];

                $message = "Order successfully added.";
            }
        }
        $userName   = isset($_POST['userName'] ) ? $_POST['userName'] : '';
        $userEmail  = isset($_POST['userEmail'] ) ? $_POST['userEmail'] : '';

        ?>
        <div class="ticket-admin max-wrapper__narrow">
            <div class="ticket-admin__add">
                <h2>Single Performance Ticket Purchases</h2>
                <?php if(!empty($message)): ?>
                    <div class="error"><?php echo $message; ?>
                <?php endif; ?>
                <form action="/ticket-admin" method="post" class="upv-form">
                    <label for="show">Which show:
                        <select name="show_title" required>
                            <option value="">Select Show</option>
                            <?php
                                foreach( $show_titles as $show_id => $show_name )
                                {   
                                    $selected = "";
                                    if( isset($_POST['show_title'] ) && $_POST['show_title'] == $show_id ) $selected = "selected";
                                    ?>
                                        <option value="<?php echo $show_id; ?>" <?php echo $selected; ?>><?php echo $show_name; ?></option>
                                    <?php
                                } ?>
                        </select>
                    </label>
                    <?php $date = isset($_POST['performance_date']) ? $_POST['performance_date'] : ''; ?>
                    <label for="performance_date">Which performance date:&nbsp;<input type="date" name="performance_date" placeholder="Performance date" required value="<?php echo $date; ?>" /></label>
                    <label for="userName">Name:<input type="text" name="userName" placeholder="Buyer name" value="<?php echo $userName; ?>" required/></label>
                    <label for="userEmail">Email:<input type="email" name="userEmail" placeholder="Buyer email" value="<?php echo $userEmail; ?>" required/></label>
                    <label>Tickets ordered:
                        <div class="upv-form__short-text"><input type="text" name="seasons" value="<?php echo isset($_POST['seasons']) ? $_POST['seasons'] : ''; ?>"> Seasons tickets</div>
                        <div class="upv-form__short-text"><input type="text" name="adult" value="<?php echo isset($_POST['adult']) ? $_POST['adult'] : ''; ?>"> Adult tickets</div>
                        <div class="upv-form__short-text"><input type="text" name="senior" value="<?php echo isset($_POST['senior']) ? $_POST['senior'] : ''; ?>"> Senior tickets</div>
                        <div class="upv-form__short-text"><input type="text" name="student" value="<?php echo isset($_POST['student']) ? $_POST['student'] : ''; ?>"> Student tickets</div>
                        <div class="upv-form__short-text"><input type="text" name="comp" value="<?php echo isset($_POST['comp']) ? $_POST['comp'] : ''; ?>"> Comp tickets</div>
                    </label>
                    <?php $payment = isset($_POST['payment']) ? $_POST['payment'] : ''; ?>
                    <label>Payment method:
                        <div class="upv-form__short-text"><input type="radio" name="payment" value="1" <?php echo $payment == 1 ? "checked" : ''; ?>> Paid in full</div>
                        <div class="upv-form__short-text"><input type="radio" name="payment"  value="0" <?php echo $payment == 0 ? "checked" : ''; ?>> Pay at Box Office</div>
                        <!-- <div class="upv-form__short-text"><input type="radio" name="payment" class="short-text"> Comp</div> -->
                    </label>  
                    <label for="notes">Notes: (required for Comp tickets)
                        <textarea name="notes" ><?php echo isset($_POST['notes']) ? $_POST['notes'] : ''; ?></textarea>
                    </label>
                        
                    <input type="submit" class="button" name="add_order" value="Submit" />
                </form>
            </div>
            <!-- <div class="ticket-admin__edit">
                <h2>Ticket Purchase Edit</h2>
                <?php //if(!empty($message)): ?>
                    <div class="error"><?php //echo $message; ?>
                <?php //endif; ?>
                <form action="/ticket-admin" method="post" class="upv-form">
                    <label for="search">Search by email or name:
                        <input type="text" name="search" placeholder="Email or name" value="" required/>
                    </label>
                    <input type="submit" class="button" name="find_order" value="Search" />
                </form>
            </div> -->
        <!-- </section> -->
        <!-- Suspended for now. May not be needed -->
            <!-- <h2>Performance Ticket Purchases File Upload</h2>
            <form action="/ticket-admin" method="post" class="upv-form" enctype="multipart/form-data">
                <label for="ticket_orders">Upload Spreadsheet</label>
                <input type="file" name="ticket_orders" />
                <input type="submit" class="button" name="upload_file" value="Upload" />
            </form> -->

    <?php
    }
}

