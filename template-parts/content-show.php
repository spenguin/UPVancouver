<?php

/**
 * Show-specific content presentation
 */
include_once(CORE_INC . '/show-functions.php');
include_once(CORE_INC . '/ticket-functions.php');
?>
<section class="show-details">
    <?php echo show_details($post->ID);
    ?>
</section>
<section class="show-tickets">
    <div id="Show"></div>
    <script type="text/javascript" src="<?php echo CORE_DIST; ?>show.js" />
</section>

// <!-- <section class="show-calendar">
//     <?php //echo show_calendar($post->ID); 
        //     
        ?>
//     <?php //echo offer_tickets(); 
        //     
        ?>
//     <div id="Test"></div>
//     <script type="text/javascript" src="<?php echo CORE_DIST; ?>test.js" />
// </section> -->