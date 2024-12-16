<?php
/*
Template Name: My Custom Page
*/

get_header(); ?>

<div class="wrapper">
    <?php
    while (have_posts()) : the_post();
        the_content(); ?>
    <?php endwhile; // End of the loop.
    ?>
</div><!-- #primary -->

<?php get_footer(); ?>