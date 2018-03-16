<?php
/*
 * NOTE: Stylesheet is NOT declared here! It is added in functions.php via wp_enqueue_style()... which is the proper way to do it.
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">

    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"><!-- sets screen width to width of device screen -->
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"><!-- Pingbacks are a form of automated comment for a page or post, created when another WordPress blog links to that page or post -->
        <!--[if lt IE 9]>
            <script src="<?php echo esc_url(get_template_directory_uri()); ?>/js/html5.js"></script>
        <![endif]-->
        <?php wp_head(); ?>
        <title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>
    </head>

    <body <?php body_class(); ?>>
        <div id="page" class="hfeed site">

            <a class="skip-link screen-reader-text" href="#content">
                <?php _e('Skip to content', 'bsportfolio'); ?>
            </a>



            <header id="masthead" class="site-header" role="banner">

                <div class="menu-bar">
                    <span class="site-header-content">
                        <!-- site title links to home page -->
                        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                            <span class="site-title">
                                <?php bloginfo('name'); ?>
                            </span>
                        </a>

                    <!--
                         * ADD STATIC PAGES TO MENU BAR:
                         * Stylesheet specifies INLINE display style using 'li.page_item' (makes list horizontal).
                         * 'title_li' = '' gets rid of the default heading, so that it will sit properly inline.
                         * 'sort_column'... sorts pages order by publication date.
                    -->
                    <?php echo wp_list_pages(array(
                        'title_li' => '',
                        'sort_column' => 'post_date')); ?>

                    <?php if (get_option('bsp_show_search')) {
                        echo '<span id="nav-menu-search-form">';
                        get_search_form(true);
                        echo '</span>';
                    } ?>
                    </span>
                </div><!-- menu-bar -->

                <?php
                // only show pagination for single-posts (not for page)
                if (is_single()) : ?>

                    <div class="posts-pagination">
                        <span class="site-header-content">
                        WORKS:
                        <span><?php next_post_link($format = '%link', $link = 'PREV'); ?>&nbsp;</span>
                        |
                        <span><?php previous_post_link($format = '%link', $link = 'NEXT'); ?>&nbsp;</span>
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
                        </span>
                    </div> <!-- posts-pagination -->

                <?php endif; ?>
            </header>

            <div id="content" class="site-content">
