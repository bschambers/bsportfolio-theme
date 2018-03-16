<?php

/*
   THEME: BSPortfolio

   SEE: functions.php --> custom_dashboard_help() for usage guidelines



   TODO:
 * menu bar zooming - wrap around and resize
 * search results page - show featured image & snippet of text on right (summary below when zoomed a lot)

   
   
   MENU BAR:
   Ben Chambers | About | News | Shows and Publications | Contact | BS Art Prize
   Ben Chambers | About | Shows | Contact | BS Art Prize
   
   VISIBILITY - public/password/private
   FORMAT - standard/gallery
   CATEGORIES - 
   TAGS - 
   
 */

get_header();

?>



<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">

    <?php
    if (have_posts()) :
    
    //// START THE LOOP ////
    while (have_posts()) :
                  
    // * Iterates the post index in The Loop.
    // * Retrieves the next post and sets it up.
    // * Sets the 'in the loop' property to true.
    the_post();
    
    /*
     * DISPLAY THE POST
     *
     * Include the Post-Format-specific template for the content.
     * If you want to override this in a child theme, then include a file
     * called content-___.php (where ___ is the Post Format name) and that will be used instead.
     */
    get_template_part('content', get_post_format());

    endwhile;

    // Previous/next page navigation.
    the_posts_pagination();

    else:
    ?>
    <h1>NO POSTS FOUND!</h1>
    <?php endif; ?>

  </main><!-- .site-main -->
</div><!-- .content-area -->


<?php get_footer() ?>
