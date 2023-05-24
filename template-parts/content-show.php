<?php

/**
 * Show-specific content presentation
 */
include_once(CORE_INC . '/show-functions.php');
include_once(CORE_INC . '/ticket-functions.php');
?>
<section class="show-details">
    <?php echo show_details($post->ID); ?>
</section>
<section class="show-calendar">
    <?php echo show_calendar($post->ID); ?>
    <?php echo offer_tickets(); ?>
</section>