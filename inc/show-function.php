<?php

/**
 * Bespoke functions for show Custom Post Type
 */

function show_details()
{
    ob_start(); ?>
    <p><span class="show-details__label">Dates</span>June 2 - 25, 2023</p>
    <p><span class="show-details__label">Times</span>Thurs-Sat evenings at 8:00 pm, Sun matinee at 2:00 pm</p>
    <p><span class="show-details__label">Preview</span>June 1 ($15.00)</p>
    <p><span class="show-details__label">Opening</span> June 2</p>
    <p><span class="show-details__label">Talkbacks</span> Thursday, June 8 and Sunday, June 11</p>
    <p><span class="show-details__label">Matinées</span> All Sundays (June 4, 11, 18, 25)</p>
<?php
    $o = ob_get_clean();
    return $o;
}
