<?php

/**
 * Show-specific content presentation
 */
include_once(CORE_INC . '/show-functions.php');
include_once(CORE_INC . '/ticket-functions.php');
$show_dates = get_calendar_values($post->ID);
$tickets    = get_tickets();
// var_dump($tickets);
// var_dump($show_dates);
?>
<section class="show-details">
    <?php echo show_details($post->ID);
    ?>
</section>
<section class="show-tickets">
    <div id="Show"></div>
    <div id="Tickets"></div>

    <script>
        var show_dates = <?php echo json_encode($show_dates); ?>;
        var tickets = <?php echo json_encode($tickets); ?>;
    </script>
    <script type="text/javascript" src="<?php echo CORE_DIST; ?>show.js"></script>
    <script type="text/javascript" src="<?php echo CORE_DIST; ?>tickets.js"></script>

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