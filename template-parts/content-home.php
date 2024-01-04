<?php
/**
 * Home page listing of shows
 */

$season = getSeason(); 
// $shows  = getShowsBySeason($season->term_id, 'text-listing'); //pvd( $shows );

?>
<section class="home-season max-wrapper">
    <h2>Our <?php echo $season->name; ?> Season</h2>
    <div class="home-season__list">
        <?php displayShowsBySeason($season->term_id, 'text-listing'); ?>
    </div>
</section>
