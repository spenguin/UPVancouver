<?php
/**
 * Create Hero section based on page
 */
?>
<section class="hero">
<div class="hero__main max-wrapper">
    <img class="hero-image" src="<?php echo get_template_directory_uri(); ?>/assets/defaultheroimage.jpg" />
    <div class="hero__text-wrapper">
        <!-- <div class="hero__show"><a href=""><span class="hero__show--text"><strong>Hedda Gabler</strong> running from 24 March to 16 April</span></a></div> -->
        <div class="hero__upv">
            <div class="hero__upv-statement">
                <?php
                echo getPostByTitle('UPV Opening Statement');
                ?>
            </div>
            <div class="hero__upv-logo"><img src="http://upv.penguintestflight.com/wp-content/uploads/2023/04/UPV-logo.png" /></div>
        </div>
    </div>
</div>
<div class="hero__mobile">
    <div class="hero__mobile--logo"><img src="http://upv.penguintestflight.com/wp-content/uploads/2023/04/UPV-logo.png" /></div>
    <div class="hero__mobile--statement">
        <?php echo getPostByTitle('UPV Opening Statement'); ?>
    </div>
</div>
</section>