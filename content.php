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
                <?php /* show site icon if there is no featured-image */
                if (has_site_icon()) : ?>
                    <img height="50" class="no-image-image" src="<?php echo get_site_icon_url() ?>" />
                <?php else : ?>
                    <b style="color: red">NO FEATURED IMAGE!</b>
                <?php endif; ?>
            <?php endif; ?>
        </article>
    </a><!-- link to post -->



<?php
/*
 * SEARCH RESULTS PAGE:
 * Show featured image with text excerpt alongside.
 */
elseif (is_search()) : ?>

    <div id="post-<?php the_ID(); ?>" <?php post_class("search-results clearfix") ?>>
        <a class="search-results" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
            <?php
            if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail(); ?>
            <?php else: ?>
                <?php /* show site icon if there is no featured-image */
                if (has_site_icon()) : ?>
                    <img height="50" class="no-image-image" src="<?php echo get_site_icon_url() ?>" />
                    <?php else : ?>
                    <b style="color: red">NO FEATURED IMAGE!</b>
                <?php endif; ?>
            <?php endif; ?>
            <h2><?php the_title() ?></h2>
        </a><!-- link to post -->
        <?php the_excerpt() ?>
    </div>



<?php
/*
 * SINGLE-POST OR PAGE:
 * Display whole content in standard full-width layout.
 */
else : ?>

    <?php /* Page content - same for Post and Page */ ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class("single-page-content"); ?>>
        <header class="entry-header">
            <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
        </header>
        <div class="entry-content">
            <?php
            the_content();
            if (get_option('bsp_show_tags')) { the_tags(); }
            ?>
        </div>
    </article>

<?php endif; ?>
