<?php

/*------------------- ADD STYLESHEET TO WEBSITE --------------------*/

function enqueue_style_bsportfolio() {
    wp_enqueue_style('bsportfolio-style', get_stylesheet_uri());
}

add_action('wp_enqueue_scripts', 'enqueue_style_bsportfolio');


/*--------------------- THEME SUPPORT FEATURES ---------------------*/

if (function_exists('add_theme_support')) {

    // Enables support for FEATURED IMAGE in posts:
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(300, 300);

    add_theme_support('html5', array('search-form'));

    //add_theme_support('post-formats', array('gallery'));
}



/*-------------------- CUSTOM DASHBOARD WIDGETS --------------------*/

add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');

function my_custom_dashboard_widgets() {

    // Globalize the metaboxes array, this holds all the widgets for wp-admin
    global $wp_meta_boxes;

    wp_add_dashboard_widget('custom_help_widget', 'BS Portfolio Theme Support', 'custom_dashboard_help');
}

function custom_dashboard_help() {
    //echo '<p><strong>Tips for using the BS Portfolio theme</strong></p>
echo '
<p><strong>IMAGE GUIDELINES:</strong></p>
<ul style="list-style-type: disc;">

<li>Decide and set default image sizes BEFORE you start uploading images! Wordpress automatically resizes images when you upload them according to the defaults which you have set - if you change the defaults (and you want to apply the new sizes to your existing images) it means removing ALL of your images and re-uploading them. I have been using medium=600, large=1000. To set defaults, go to Settings-->Media.</li>

<li>For each post, you need to set a <i>featured image</i>, this is what is shown in the image array on the home page.</li>

<li>You may want to make <i>featured images</i> (see below) in a smaller size, otherwise they&lsquo;ll be shrunk down from larger size (which may be a bit inefficient).</li>
</ul>





<p><strong>POSTS:</strong></p>
<ul style="list-style-type: disc;">

<li>Posts are Gallery posts.</li>

<li>Remember to set a <i>featured image</i> for each post, so that it will appear on the home page image grid.</li>

<li>Choice of size and dimensions for featured images may depend on which style you chose for the home page image grid (see below).</li>

<li>When you insert images into a post, if you want images to link to the full size version, you need to select the option when you insert the image into the post. In the <i>Insert Media</i> page, select the image to insert, then in the panel on the right hand side, select <i>Link To: Media File</i>. If you forgot to select the option when you inserted it, you will just have to remove it and insert it again. Once you select this option, it should be selected by default the next time you insert an image.</li>

<li><i>Tags</i> are invisible by default. They can be enabled in the menu Settings-->BS Portfolio theme. I decided to make a more minimal, clean look the default for this theme.</li>

</ul>





<p><strong>HOME PAGE:</strong></p>
<ul style="list-style-type: disc;">

<li>Image-grid style: for more info, and to change style, go to Settings-->BS Portfolio Theme.</li>

<li>Changing the order of the posts on the home page: Wordpress automatically orders posts by date. The easiest way to change the order in which they appear is to edit the relevent posts and manually change the dates. One approach would be to use dates corresponding the the creation or exhibition of the artwork depicted in each post.</li>

<li>To set number of posts on home page grid go to Settings-->Reading. You will probably want to increase it from the default.</li>

</ul>





<p><strong>MENU BAR:</strong></p>
<ul style="list-style-type: disc;">

<li><i>Static Pages:</i> These are listed on the menu bar. Change the order of pages by changing publication dates, same as for <i>posts</i> (see above).</li>

<li>The <i>search box</i> is disabled by default. It can be enabled in the menu Settings-->BS Portfolio theme.</li>

</ul>





<p><strong>MISC:</strong></p>
<ul style="list-style-type: disc;">

<li>To set an icon for the web browser tab, go to Appearance-->Customize-->Site Identity-->Site Icon</li>

<li>Contact the developer: <a href="mailto:enquiries@bschambers.info">ben@bschambers.info</a></li>

<li>Developer&rsquo;s personal website: <a href="http://www.bschambers.info" target="_blank">http://www.bschambers.info</a></li>

</ul>';
}



/*------------------- CUSTOM ADMINISTRATION MENU -------------------*/



// database option names
$opt_tags = 'bs_show_tags';
$opt_search = 'bs_show_search';
$opt_grid_style = 'bs_grid_style';
$opt_image_size = 'bs_grid_image_size';
$opt_image_spacing = 'bs_grid_image_spacing';
$opt_spaced_spacing = 'bs_grid_spaced_spacing';



// register a new admin menu
add_action('admin_menu', 'bsportfolio_menu');

// the function which creates the new admin menu
function bsportfolio_menu() {
    // add_options_page( $page_title, $menu_title, $capability, $menu_slug, $function)
    add_options_page('bsportfolio theme', 'BS Portfolio theme', 'manage_options', 'bsportfolio-settings', 'bsportfolio_settings');
}

// 
function bsportfolio_settings() {
    if (!current_user_can( 'manage_options')) {
	wp_die( __('You do not have sufficient permissions to access this page.'));
    }

    // make global variables available
    global $opt_tags, $opt_search, $opt_grid_style,
    $opt_image_size, $opt_image_spacing, $opt_spaced_spacing;
    
    // field names
    $field_tags = "bs-show-tags";
    $field_search = "bs-show-search";
    $field_grid = 'bs-grid-style';
    $field_image_size = 'bs-grid-image-size';
    $field_image_spacing = 'bs-grid-image-spacing';
    $field_spaced_spacing = 'bs-grid-spaced-spacing';
    //
    $hidden_field = 'bs_submit_hidden';

    // read in existing values from the database
    $show_tags = get_option($opt_tags);
    $show_search = get_option($opt_search);
    $grid_style = get_option($opt_grid_style);
    $image_size = get_option($opt_image_size);
    $image_spacing = get_option($opt_image_spacing);
    $spaced_spacing = get_option($opt_spaced_spacing);

    // see if the user has posted us some information
    // if they did, this hidden field will be set to 'Y'
    if (isset($_POST[$hidden_field]) && $_POST[$hidden_field] == 'Y') {
        // read the posted values
        $show_tags = $_POST[$field_tags];
        $show_search = $_POST[$field_search];
        $grid_style = $_POST[$field_grid];
        $image_size = $_POST[$field_image_size];
        $image_spacing = $_POST[$field_image_spacing];
        $spaced_spacing = $_POST[$field_spaced_spacing];
        // save the posted values in the database...
        // ... if the option doesn't exist, update_option will create it automatically
        update_option($opt_tags, $show_tags);
        update_option($opt_search, $show_search);
        update_option($opt_grid_style, $grid_style);
        update_option($opt_image_size, $image_size);
        update_option($opt_image_spacing, $image_spacing);
        update_option($opt_spaced_spacing, $spaced_spacing);
        // put a 'settings saved' message on screen
        // NOTE: _e() is a translation function... see documentation...
  ?>
  <div class='updated'><p><strong><?php _e('Settings saved.', 'bsportfolio-settings'); ?></strong></p>
    <p>show-tags = <?php echo $show_tags; ?></p>
    <p>show-search = <?php echo $show_search; ?></p>
    <p>grid-style = <?php echo $grid_style; ?></p>
    <p>image-size = <?php echo $image_size; ?></p>
    <p>image-spacing = <?php echo $image_spacing; ?></p>
    <p>spaced-grid-spacing = <?php echo $spaced_spacing; ?></p>
</div>
  <?php
  }



  // display settings editing form
  echo '<div class="wrap">';
  // header
  echo "<h2>" . __('BS Portfolio Theme Settings', 'bsportfolio-settings') . "</h2>";
  // settings form
  ?>

  <form name="bsportfolio-form" method="post" action="">
    <input type="hidden" name="<?php echo $hidden_field; ?>" value="Y"/>



    <p><h2>Tags and Search</h2></p>

    <p><input type='checkbox' name='<?php echo $field_tags; ?>' value="1" <?php checked('1',  $show_tags); ?>/>Show tags</p>
    <p><input type='checkbox' name='<?php echo $field_search; ?>' value='1' <?php checked('1',  $show_search); ?>/>Show search box</p>


    
    <p><h2>Home Page Grid Style</h2></p>

    <?php // a bit of extra code required to display saved value on radio buttons
    $horiz_flow_val = 'horizontal-flow';
    $horiz_flow_resize_val = 'horizontal-flow-resize';
    $spaced_grid_val = 'spaced-grid';
    ?>

    <p>
      <input type="radio" name="<?php echo $field_grid; ?>" value="<?php echo $horiz_flow_val; ?>" <?php checked($horiz_flow_val, get_option($opt_grid_style)); ?> /><?php echo $horiz_flow_val; ?><br/>
      Images aligned on top edge and NOT resized, so if you want them to all be the same height you need to either make sure that your images are all the same height, or use horizontal-flow-resized.<br/>
      If you want a grid of squares or rectangles of regular size then you need to make your images the right size before you upload them.<br/>
      Spacing is set with the <i>image spacing</i> option below.<br/>
      Unaffected by <i>image size</i> option.
    </p>
    <p>
      <input type="radio" name="<?php echo $field_grid; ?>" value="<?php echo $horiz_flow_resize_val; ?>" <?php checked($horiz_flow_resize_val, get_option($opt_grid_style)); ?> /><?php echo $horiz_flow_resize_val; ?><br/>
      Same as horizontal-flow, but will force images to fit the standard height.<br/>
      Height is set with the <i>image size</i> option below.<br/>
      Spacing is set with the <i>image spacing</i> option below.
    </p>
    <p>
      <input type="radio" name="<?php echo $field_grid; ?>" value="<?php echo $spaced_grid_val; ?>" <?php checked($spaced_grid_val, get_option($opt_grid_style)); ?> /><?php echo $spaced_grid_val; ?><br/>
      Images placed in a regular grid, with some padding in between them.<br/>
      Images will be forced to standard size.<br/>
      Size is set with the <i>image size</i> option below.<br/>
      Padding is set with <i>spaced-grid spacing</i> option below.
    </p>


    
    <p><h2>Grid Style Options</h2></p>

    <p>
      <label for="<?php echo $field_image_size; ?>"><?php _e('image size (default = 300px)'); ?></label>
      <input name="<?php echo $field_image_size; ?>" type="number" step="1" min="0" id="<?php echo $field_image_size; ?>" value="<?php echo get_option($opt_image_size); ?>" class="small-text" />
    </p>
    <p>
      <label for="<?php echo $field_image_spacing; ?>"><?php _e('image spacing (default = 0.5rem)'); ?></label>
      <input name="<?php echo $field_image_spacing; ?>" type="number" step="0.1" min="0" id="<?php echo $field_image_spacing; ?>" value="<?php echo get_option($opt_image_spacing); ?>" class="small-text" />
    </p>
    <p>
      <label for="<?php echo $field_spaced_spacing; ?>"><?php _e('spaced-grid spacing (default = 2rem)'); ?></label>
      <input name="<?php echo $field_spaced_spacing; ?>" type="number" step="0.1" min="0" id="<?php echo $field_spaced_spacing; ?>" value="<?php echo get_option($opt_spaced_spacing); ?>" class="small-text" />
    </p>
    

    
    <p class="submit">
    <input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
    </p>
    
    </form>

    <?php
}


    

    
    /*
       NOTE:
       - before a section is visible, it must contain at least one setting
       - before a setting is visible, it must have an associated control
     */
    function bsportfolio_theme_customize_register($wp_customize) {

        $wp_customize->add_section('bs_theme_colors', array(
            'title' => 'Colors',
            'description' => 'Change colors for BS Portfolio theme.',
            'priority' => 35,
        ));

        $wp_customize->add_setting('bs_menu_bar_color', array(
            'default'           => '#888',
            'sanitize_callback' => 'sanitize_hex_color',
        ));
        $wp_customize->add_control('bs_menu_bar_color', array(
            'label' => 'Menu Bar Color',
            'section' => 'bs_theme_colors',
            'type' => 'text',
            ));

        /* $wp_customize->add_setting('bs_menu_bar_text_color', array(
         *     'default'           => '#fff',
         *     'sanitize_callback' => 'sanitize_hex_color',
         * ));
         * $wp_customize->add_control('bs_menu_bar_text_color', array(
         *     'label' => 'Menu Bar Text Color',
         *     'section' => 'bs_theme_colors',
         *     'type' => 'text',
         * ));

         * $wp_customize->add_setting('bs_menu_bar_rollover_color', array(
         *     'default'           => '#ddd',
         *     'sanitize_callback' => 'sanitize_hex_color',
         * ));
         * $wp_customize->add_control('bs_menu_bar_rollover_color', array(
         *     'label' => 'Menu Bar Text Link Roll-Over Color',
         *     'section' => 'bs_theme_colors',
         *     'type' => 'text',
         * ));
         */
        /* $wp_customize->('colors', array(
         *     'title'    => __('Colors', 'bsportfolio-beta'),
         *     'priority' => '30',
         *     ));
         */
        
        /* $wp_customize->add_control(
	   new WP_Customize_Color_Control(
	   $wp_customize,
	   'menu_bar_color',
	   array(
	   'label'      => __('Menu Bar Color', 'mytheme'),
	   'section'    => 'bs_theme_colors',
	   'settings'   => 'bs_menu_bar_color',
	   ))
         * );
         */
    }
    add_action('customize_register', 'bsportfolio_theme_customize_register');
    
    
    
    /**
     * Adjust color lightness by percentage amount for both HEX and RGB values.
     *
     * @param $color_code
     * @param int $percentage_adjuster
     * @return array|string
     * @author Jaspreet Chahal
     */
    function lighten_or_darken($color_code, $percentage_adjuster = 0) {
        $percentage_adjuster = round($percentage_adjuster/100,2);
        if(is_array($color_code)) {
            $r = $color_code["r"] - (round($color_code["r"])*$percentage_adjuster);
            $g = $color_code["g"] - (round($color_code["g"])*$percentage_adjuster);
            $b = $color_code["b"] - (round($color_code["b"])*$percentage_adjuster);
            
            return array("r"=> round(max(0,min(255,$r))),
                         "g"=> round(max(0,min(255,$g))),
                         "b"=> round(max(0,min(255,$b))));
        }
        else if(preg_match("/#/",$color_code)) {
            $hex = str_replace("#","",$color_code);
            $r = (strlen($hex) == 3)? hexdec(substr($hex,0,1).substr($hex,0,1)):hexdec(substr($hex,0,2));
            $g = (strlen($hex) == 3)? hexdec(substr($hex,1,1).substr($hex,1,1)):hexdec(substr($hex,2,2));
            $b = (strlen($hex) == 3)? hexdec(substr($hex,2,1).substr($hex,2,1)):hexdec(substr($hex,4,2));
            $r = round($r - ($r*$percentage_adjuster));
            $g = round($g - ($g*$percentage_adjuster));
            $b = round($b - ($b*$percentage_adjuster));
            
            return "#".str_pad(dechex( max(0,min(255,$r)) ),2,"0",STR_PAD_LEFT)
                  .str_pad(dechex( max(0,min(255,$g)) ),2,"0",STR_PAD_LEFT)
                  .str_pad(dechex( max(0,min(255,$b)) ),2,"0",STR_PAD_LEFT);
        }
    }



    
    function bsportfolio_theme_customize_css() {
        global $opt_image_size, $opt_image_spacing, $opt_spaced_spacing;
        
        // get lighter version of color for roll-over color...
        // $hover_color = '#f00';
        $hover_color = lighten_or_darken(get_theme_mod('bs_menu_bar_color'), -60); // lighten by 50%
        
    ?>
      <style type="text/css">
       header.site-header, .single-post-pagination {
           Background: <?php echo get_theme_mod('bs_menu_bar_color', '#888'); ?>;
       }
       header a:hover, .single-post-pagination a:hover {
           color: <?php echo $hover_color ?>;
       }
       
       article.grid-horizontal-flow-resize, article.grid-spaced {
           height: <?php echo get_option($opt_image_size) ?>px;
       }
       article.grid-spaced {
           width: <?php echo get_option($opt_image_size) ?>px;
           padding: <?php echo get_option($opt_spaced_spacing) ?>rem;
       }

        article.grid-horizontal-flow, article.grid-horizontal-flow-resize {
           margin: <?php echo get_option($opt_image_spacing) ?>rem;
       }

      </style>
    <?php
    }
    add_action('wp_head', 'bsportfolio_theme_customize_css');
    
?>
