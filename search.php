<?php
/*
 * Displays the results of the search.
 */

get_header();
?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">

    <header class="page-header">
      <h1 class="page-title"><?php printf(__('Search Results for: %s', 'shape'), '<span>' . get_search_query() . '</span>'); ?></h1>
    </header><!-- .page-header -->

    <?php /* Start the Loop */ ?>
    <?php while ( have_posts() ) : the_post(); ?>

      <?php get_template_part('content', 'search'); ?>

    <?php endwhile; ?>
    
  </main>
</div>

<?php get_footer() ?>
