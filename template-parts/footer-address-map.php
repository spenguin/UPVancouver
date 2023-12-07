<?php
/** Theatre address and Google map */
?>

<section class="footer__address">
    <div class="footer__address--text">
        <?php echo get_post_by_title('Address'); ?>
    </div>
    <div class="footer__address--map">
        <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d2603.216163262012!2d-123.20299139999999!3d49.2723011!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sca!4v1701815332810!5m2!1sen!2sca" width="350" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        <div class="footer_address--map-overlay"> -->
            <a href="https://www.google.com/maps/place/Jericho+Arts+Centre/@49.272389,-123.2051026,17z/data=!3m1!4b1!4m5!3m4!1s0x548672f149e54ea3:0xa6130ca92c157456!8m2!3d49.272389!4d-123.2029139?shorturl=1" target="_blank"><img src="<?php echo site_url(); ?>/wp-content/uploads/2023/12/Maps.png" /></a>
        <!-- </div>     -->
    </div>
</section>