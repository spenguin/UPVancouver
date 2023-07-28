<?php

/**
 * Show List for Home Page
 */

$season     = get_season();
$options    = get_option('performance_options'); 
?>
<h2><?php echo $season->name; ?></h2>
<div class="shows__list">

    <?php echo get_shows_listing($season->term_id); ?>
    <div class="shows__list--ticket">
        <p>Buy TWO Season Tickets, get the THIRD half-price<br /><?php echo $options['performance_field_season_ticket_string']; ?></p>
        <a href="" class="shows__list--ticket__button button">Season Tickets Available</a>
    </div>
    <!-- <div class="shows__list-show"><a href=""><img src="<?php echo get_template_directory_uri(); ?>/assets/upv-show-banner-sm.jpg" />
            <div class="shows__list-info">
                <h4>Tickets & Details</h4>
                <h3>Hedda Gabler</h3>
            </div>
        </a></div>
    <div class="shows__list-show"><a href=""><img src="<?php echo get_template_directory_uri(); ?>/assets/upv-show-banner-sm.jpg" />
            <div class="shows__list-info">
                <h4>Tickets & Details</h4>
                <h3>Hedda Gabler</h3>
            </div>
        </a></div>
    <div class="shows__list-show"><a href=""><img src="<?php echo get_template_directory_uri(); ?>/assets/upv-show-banner-sm.jpg" />
            <div class="shows__list-info">
                <h4>Tickets & Details</h4>
                <h3>Hedda Gabler</h3>
            </div>
        </a></div>
    <div class="shows__list-show"><a href=""><img src="<?php echo get_template_directory_uri(); ?>/assets/upv-show-banner-sm.jpg" />
            <div class="shows__list-info">
                <h4>Tickets & Details</h4>
                <h3>Hedda Gabler</h3>
            </div>
        </a></div> -->
</div>