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
  
  <div id="post-<?php the_ID(); ?>" <?php post_class("search-results") ?>>
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
    //the_content();
    ?>
    <p>This is the text exerpt featuring the text containing the search terms...</p>
    <p>... blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah...</p>
    <p style="color:red">NOT YET IMPLEMENTED!</p>

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
    <div class="single-post-pagination">GALLERY:
      <span class="single-post-pagination-link"><?php next_post_link($format = '%link', $link = 'PREV'); ?>&nbsp;</span>
      |
      <span class="single-post-pagination-link"><?php previous_post_link($format = '%link', $link = 'NEXT'); ?>&nbsp;</span>
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
