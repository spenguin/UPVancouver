<?php

/**
 * Show-specific content presentation
 */
// $show_dates = get_calendar_values($post->ID);
$showId         = $post->ID; 
$performances   = getPerformanceDates( $post->ID );
$tickets        = getTickets();

// var_dump($tickets);
// var_dump($show_dates);
?>
<section class="show-details">
    <?php echo show_details($post->ID);
    ?>
</section>
<section class="show-tickets">
    <div id="TicketSales"></div>

    <script>
        var showId = '<?php echo $showId; ?>';
        var performances = <?php echo json_encode($performances); ?>;
        var tickets = <?php echo json_encode($tickets); ?>;
        // console.log('tickets', tickets);
    </script>
    <script type="text/javascript" src="<?php echo CORE_DIST; ?>ticketsales.js"></script>

</section>