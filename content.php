<?php
/*
 * HOME-PAGE OR TAGS PAGE:
 * Display grid of featured images.
 * Image links to the full post.
 * Different grid-class is added depending on value of bsp_grid_style variable.
 */
if (is_home() || is_archive()) : ?>
    <a class="thumbs-grid" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
        <article id="post-<?php the_ID(); ?>" <?php
                                              switch (get_option('bsp_grid_style')) {
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
            // insert featured image - or display error message!
            if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail(); ?>
            <?php else: ?>
                <b style="color: red">NO FEATURED IMAGE!</b>
            <?php endif; ?>
        </article><!-- gallery-preview -->
    </a><!-- link to post -->



<?php
/*
 * SEARCH RESULTS PAGE:
 * Show featured image with text excerpt alongside.
 */
elseif (is_search()) : ?>

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

                            <p><?php the_title('<h2>', '</h2>') ?></p>
                            
        </article><!-- gallery-preview -->
    </a><!-- link to post -->

    <?php the_excerpt() ?>

                </div>

            </td>
        </tr>
    </table>

    

<?php
/*
 * SINGLE-POST OR PAGE:
 * Display whole content in standard full-width layout.
 * Show pagination for Posts but not Pages.
 */
else : ?>

    <?php
    // Only show pagination for Posts (not for Pages).
    // Tooltip is styled to be invisible except for on mouse rollover.
    if (!is_page()) : ?>
    <div class="single-post-pagination tooltip bsp-header">WORKS:
        <span class="single-post-pagination-link"><?php next_post_link($format = '%link', $link = 'PREV'); ?>&nbsp;</span>
        |
        <span class="single-post-pagination-link"><?php previous_post_link($format = '%link', $link = 'NEXT'); ?>&nbsp;</span>
        <span class="tooltip-text">navigate with left/right cursor keys</span>

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

    <?php // Page content - same for Post and Page. ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header">
            <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
        </header>
        <div class="entry-content">
            <?php
            the_content();
            if (get_option('bsp_show_tags')) { the_tags(); }
            ?>
        </div> <!-- entry-content -->
    </article>

<?php endif; ?>
