<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package UPVancouver
 */

?>

<footer id="colophon" class="footer max-wrapper">
    <?php get_template_part('template-parts/footer-address-map'); ?>

    <div class="footer_acknowledgement">
        <p>We acknowledge that the land on which we gather is the unceded, ancestral territories of the xʷməθkʷəy̓əm (Musqueam), Sḵwx̱wú7mesh (Squamish) and Səl̓ílwətaʔ/Selilwitulh (Tsleil-Waututh) peoples.</p>
    </div>
    <div class="footer_column-wrapper">
        <div class="footer_column-wrapper--one">
            <p>&copy; <?php echo date('Y' ); ?> United Players of Vancouver</p>
        </div>
        <div class="footer_column-wrapper--two">
            <p>Instagram or Facebook feed</p>
        </div>
        <div class="footer_column-wrapper--three">
            <?php get_template_part('template-parts/footer-social-media'); ?>
        </div>                
    </div>


</footer><!-- #colophon .footer -->
</div><!-- .container -->

<?php wp_footer(); ?>

</body>

</html>