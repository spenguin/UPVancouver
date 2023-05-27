<?php

/**
 * Ticket display template
 */
?>
<!-- <div class="ticket-offer">
    <?php echo the_title(); ?>
    <div class="qtySelector text-center">
        <i class="fa fa-minus decreaseQty"></i>
        <input type="text" class="qtyValue" value="0" />
        <i class="fa fa-plus increaseQty"></i>
    </div>
    <style>
        .qtySelector {
            border: 1px solid #ddd;
            width: 107px;
            height: 35px;
            margin: 10px auto 0;
        }

        .qtySelector .fa {
            padding: 10px 5px;
            width: 35px;
            height: 100%;
            float: left;
            cursor: pointer;
        }

        .qtySelector .fa.clicked {
            font-size: 12px;
            padding: 12px 5px;
        }

        .qtySelector .fa-minus {
            border-right: 1px solid #ddd;
        }

        .qtySelector .fa-plus {
            border-left: 1px solid #ddd;
        }

        .qtySelector .qtyValue {
            border: none;
            padding: 5px;
            width: 35px;
            height: 100%;
            float: left;
            text-align: center
        }
    </style>
    <script>
        jQuery(document).ready(function() {
            var minVal = 0,
                maxVal = 20; // Set Max and Min values
            // Increase product quantity on cart page
            jQuery(".increaseQty").on('click', function() {
                var $parentElm = jQuery(this).parents(".qtySelector");
                jQuery(this).addClass("clicked");
                setTimeout(function() {
                    jQuery(".clicked").removeClass("clicked");
                }, 100);
                var value = $parentElm.find(".qtyValue").val();
                if (value < maxVal) {
                    value++;
                }
                $parentElm.find(".qtyValue").val(value);
            });
            // Decrease product quantity on cart page
            jQuery(".decreaseQty").on('click', function() {
                var $parentElm = jQuery(this).parents(".qtySelector");
                jQuery(this).addClass("clicked");
                setTimeout(function() {
                    jQuery(".clicked").removeClass("clicked");
                }, 100);
                var value = $parentElm.find(".qtyValue").val();
                if (value > 1) {
                    value--;
                }
                $parentElm.find(".qtyValue").val(value);
            });
        });
    </script>
</div> -->
<ul class="products">
    <?php
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => 12
    );
    $loop = new WP_Query($args);
    if ($loop->have_posts()) {
        while ($loop->have_posts()) : $loop->the_post();
            wc_get_template_part('content', 'product');
        endwhile;
    } else {
        echo __('No products found');
    }
    wp_reset_postdata();
    ?>
</ul><!--/.products-->