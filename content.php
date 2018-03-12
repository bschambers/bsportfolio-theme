<?php
// NOTE:
// is_home() refers to the blog posts index - is_front_page() refers to the front page (which will not be the same if a static front page has been set.
// is_search() refers to the search results page.
// is_archive() ...
if (is_home() || is_archive()) :
/*
  HOME-PAGE:
  * Display grid of featured images
  * image links to the full post.
  */
?>
  <a class="thumbs-grid" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
    <article id="post-<?php the_ID(); ?>" <?php
                                          switch (get_option('bs_grid_style')) {
                                              case 'spaced-grid':
                                                  post_class('grid-spaced');
                                                  break;
                                              case 'horizontal-flow':
                                                  post_class('grid-horizontal-flow');
                                                  break;
                                              case 'horizontal-flow-resize':
                                              default:
                                                  post_class("grid-horizontal-flow-resize");
                                                  break;
                                          }
                                          ?>>
      <?php
      // INSERT FEATURED IMAGE (IF THERE IS ONE)
      if (has_post_thumbnail()) : ?>
      <?php the_post_thumbnail(); ?>
      <?php else: ?>
          <b style="color: red">NO FEATURED IMAGE!</b>
      <?php endif; ?>
    </article><!-- gallery-preview -->
  </a><!-- link to post -->


  


  <!--
       SEARCH RESULTS PAGE:
       * ...
     -->

<?php elseif (is_search()) : ?>

  <table>
    <tr>
      <td>
  
  <div id="post-<?php the_ID(); ?>" <?php post_class("search-results, clearfix") ?>>
    <a class="search-results" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
      <span id="post-<?php the_ID(); ?>" <?php post_class("search-results-image") ?>>
        <?php
        // INSERT FEATURED IMAGE (IF THERE IS ONE)
        if (has_post_thumbnail()) : ?>
          <?php the_post_thumbnail(); ?>
        <?php else: ?>
          <b style="color: red">NO FEATURED IMAGE!</b>
        <?php endif; ?>

        <p><?php the_title('<h2>', '</h2>'); ?></p>
        
      </article><!-- gallery-preview -->
    </a><!-- link to post -->

    <?php
    /* EXERPT OF TEXT FEATURING SEARCH TERMS */
    the_excerpt();
    ?>

  </div>

      </td>
    </tr>
  </table>

  
  <!--
       SINGLE-POST PAGE: (or any other type of page)
       * Display whole content in standard full-width layout...
     -->

<?php else : ?>

  <?php // only show pagination for posts (not for pages)
  if (!is_page()) : ?>
    <div class="single-post-pagination tooltip">WORKS:
      <span class="single-post-pagination-link"><?php next_post_link($format = '%link', $link = 'PREV'); ?>&nbsp;</span>
      |
      <span class="single-post-pagination-link"><?php previous_post_link($format = '%link', $link = 'NEXT'); ?>&nbsp;</span>
      <span class="tooltip-text">navigate with mouse or left/right cursor keys</span>

      <script type="text/javascript">
       <!--
         /* Script for enabling cursor key navigation taken from here:
            https://helloacm.com/how-to-use-keyboard-arrow-keys-for-wordpress-posts-navigation/ */
         document.onkeydown = function (e) {
             var e = e || event, 
                 keycode = e.which || e.keyCode; 
             if (keycode == 37)
                 location = "<?php echo get_permalink(get_next_post()); ?>";
             if (keycode == 39)
                 location = "<?php echo get_permalink(get_previous_post()); ?>";
         }
       -->
      </script>
      
    </div> <!-- single-post-pagination -->
    <br/>
  <?php endif; ?>

  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
      <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
    </header>
    <div class="entry-content">
      <?php
      the_content();
      if (get_option('bs_show_tags')) { the_tags(); }
      ?>
    </div> <!-- entry-content -->
  </article>

<?php endif; ?>
