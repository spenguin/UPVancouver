<?php

/**
 * Show List for Home Page
 */
include_once(CORE_INC . '/show-functions.php');
$season = get_season();
?>
<h2><?php echo $season->name; ?></h2>
<div class="shows__list">

    <?php echo get_shows_listing($season->term_id); ?>
    <div class="shows__list--ticket">
        <p>Buy TWO Season Tickets, get the THIRD half-price - only until 31st July</p>
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