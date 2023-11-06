<?php

/**
 * Show-specific content presentation
 */
?>

<section class="show max-wrapper">
    <div class="show__content">
        <section class="show__content--main">
            <p>Show Main</P>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas hendrerit tempus tellus, id euismod mi dapibus faucibus. In pretium sem non ornare blandit. Aliquam nec lectus arcu. Phasellus porta auctor bibendum. Aliquam id leo ut augue posuere cursus. Integer dictum laoreet massa et commodo.</p>
            <p><a href="#tickets" class="internal-link">Go to Tickets</a></p>
        </section>
        <section class="show__content--production">
            <p>Show Sidebar</p>
            <p> Aliquam in tortor non urna ultrices congue. Donec tristique eros sit amet accumsan convallis. Duis viverra vitae dui ut dignissim. Sed quis porta orci. Pellentesque sit amet dignissim dolor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Ut quis urna odio. Suspendisse dictum porttitor turpis id viverra. In feugiat placerat orci nec tincidunt. </p>
        </section>
        <section class="show__content--tickets" id="tickets">
            <?php get_template_part('template-parts/select-tickets-for-performance'); ?>
        </section>
    </div>
    <div class="show__sidebar">
        <section class="show__sidebar--production">
            <p>Show Sidebar</p>
            <p> Aliquam in tortor non urna ultrices congue. Donec tristique eros sit amet accumsan convallis. Duis viverra vitae dui ut dignissim. Sed quis porta orci. Pellentesque sit amet dignissim dolor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Ut quis urna odio. Suspendisse dictum porttitor turpis id viverra. In feugiat placerat orci nec tincidunt. </p>
        </section>
    </div>
</section>