<?php
get_header();
the_archive_title('<h1 class="page-title">', '</h1>');
?>

<p>
<b>Other tags:</b>
<?php wp_tag_cloud(); ?>
</p>

<?php
//// THE LOOP //// (see content.php for fully commented code)
if (have_posts()) :
while (have_posts()) : the_post();
get_template_part('content', get_post_format());
endwhile;
endif;

get_footer();
?>
