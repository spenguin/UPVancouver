<?php /* Template Name: Season Tickets */
get_header();
$season         = get_season();
$shows          = getShowsBySeasonId($season->term_id, TRUE ); //var_dump($shows );
$tickets        = getTickets(TRUE, $shows->post_count); //var_dump($tickets );
$ticketSpecial  = isTicketSpecialAvailable();

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
                <div id="Tickets"></div>
                <script>
                    var tickets         = <?php echo json_encode($tickets); ?>;
                    var ticketSpecial   = '<?php echo $ticketSpecial; ?>';
                </script>                
                <script type="text/javascript" src="<?php echo CORE_DIST; ?>tickets.js"></script>


            <?php } ?>
            <?php //echo generateSeasonShowsListing(); ?>
        </div>
    </section>
</main><!-- #main -->

<?php
get_footer();
