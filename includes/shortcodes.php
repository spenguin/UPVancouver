<?php

namespace Shortcodes;


\Shortcodes\initialize();

function initialize()
{
    add_shortcode( 'content_display', '\Shortcodes\content_display' );
}

/**
 * A shortcode to wrap content in appropriate classes 
 * */
function content_display($atts, $content=NULL)
{ 
    extract(shortcode_atts([
        'background'    => "white",
        'columns'       => '1'
    ], $atts));
    ob_start();
    ?>
        <div class="page-content page-content__<?php echo $background;?> column-<?php echo $columns; ?>">
            <div class="max-wrapper">
                <?php echo $content; ?>
            </div>
        </div>
    <?php
    return ob_get_clean();
}