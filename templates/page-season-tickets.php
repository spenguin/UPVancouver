<?php /* Template Name: Season Tickets */
get_header();
$season = get_season();
$shows  = getShowsBySeasonId($season->term_id, TRUE );
$tickets= getTickets(TRUE); var_dump($tickets );

?>
<main id="primary" class="site-main">
    <?php get_template_part('template-parts/hero-section'); ?>

    <section class="shows max-wrapper">
        <div class="shows__wrapper">
            <h1><?php echo $season->name; ?></h1>
            <?php if( 3 > $shows->post_count ){ ?>
                <p>Season Tickets are no longer available for this season</p>
                <?php echo listShows( $shows ); ?>

            <?php } else {
                echo listShows( $shows ); ?>

            <?php } ?>
            <?php //echo generateSeasonShowsListing(); ?>
        </div>
    </section>
</main><!-- #main -->

<?php
get_footer();
