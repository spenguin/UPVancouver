<?php
/** Navigation */
?>

<nav class="nav__mobile">
    <?php 
    wp_nav_menu( ['menu'=>'Mobile Main Menu','container'=>FALSE] ); ?>
</nav>
<nav class="nav__desktop max-wrapper">
    <?php 
    wp_nav_menu( ['menu'=>'Desktop Main Menu','container'=>FALSE] ); ?>
</nav>
