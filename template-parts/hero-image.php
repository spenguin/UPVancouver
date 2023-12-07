<?php

/** Hero Image presentation 
 * 
 * If page is Home, use Current Show Production Image, if available, else Jericho Arts Centre image
 * If page is Show, use Show Banner
 * Else, use black banner with text
 * 
*/
$logo_url = CORE_TEMPLATE_URL . "/assets/UPV-logo.svg"; //var_dump($logo_url);
?>
    <section class="hero__mobile">
        <?php if( is_home() ): ?>
            <img  src="<?php echo site_url(); ?>/wp-content/uploads/2023/11/UPV-logo.png"  alt="United Players of Vancouver" />
            <div class="hero__mobile--text">
                <?php echo get_post_by_title('Home'); ?>
            </div>
        <?php elseif( has_post_thumbnail($post)):
            // Display post thumbnail
?>
       
       <?php else: ?>
            <h1 class="not-home"><?php echo $post->post_title; ?></h1>
        <?php endif; ?>


    </section>
    <section class="hero__desktop">
        <?php if( is_home() ): ?>
            <img src="<?php echo site_url(); ?>/wp-content/uploads/2023/12/Theatre_1900x875.jpg" alt="United Players of Vancouver" />
            <div class="hero__desktop--home">
                <div class="hero__desktop--home-wrapper">
                    <div class="hero__desktop--home-text">
                        <?php echo get_post_by_title('Home'); ?>
                    </div>
                    <div class="hero__desktop--home-logo">
                        <img  src="<?php echo site_url(); ?>/wp-content/uploads/2023/11/UPV-logo.png"  alt="United Players of Vancouver" />
                    </div>
                </div>
            </div>

        <?php elseif( has_post_thumbnail($post)):
            // Display post thumbnail
?>
        <?php else: ?>
            <h1 class="not-home"><?php echo $post->post_title; ?></h1>
        <?php endif; ?>


    </section>




