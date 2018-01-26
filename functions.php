<?php
/*
Author: Paul Grieselhuber, Eddie Machado
URL: https://sepalandseed.com/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, etc.
*/

// LOAD SEPAL AND SEED CORE (if you remove this, the theme will break)
require_once( 'library/sepal-and-seed.php' );

// CUSTOMIZE THE WORDPRESS ADMIN (off by default)
// require_once( 'library/admin.php' );

/*********************
LAUNCH SEPAL AND SEED
Let's get everything up and running.
*********************/

function sepal_and_seed_ahoy() {

  //Allow editor style.
  add_editor_style( get_stylesheet_directory_uri() . '/library/css/editor-style.css' );

  // let's get language support going, if you need it
  load_theme_textdomain( 'sepalandseedtheme', get_template_directory() . '/library/translation' );

  // launching operation cleanup
  add_action( 'init', 'sepal_and_seed_head_cleanup' );
  // remove WP version from RSS
  add_filter( 'the_generator', 'sepal_and_seed_rss_version' );
  // remove pesky injected css for recent comments widget
  add_filter( 'wp_head', 'sepal_and_seed_remove_wp_widget_recent_comments_style', 1 );
  // clean up comment styles in the head
  add_action( 'wp_head', 'sepal_and_seed_remove_recent_comments_style', 1 );
  // clean up gallery output in wp
  add_filter( 'gallery_style', 'sepal_and_seed_gallery_style' );

  // enqueue base scripts and styles
  add_action( 'wp_enqueue_scripts', 'sepal_and_seed_scripts_and_styles', 999 );
  // ie conditional wrapper

  // launching this stuff after theme setup
  sepal_and_seed_theme_support();

  // adding sidebars to Wordpress (these are created in functions.php)
  add_action( 'widgets_init', 'sepal_and_seed_register_sidebars' );

  // cleaning up random code around images
  add_filter( 'the_content', 'sepal_and_seed_filter_ptags_on_images' );
  // cleaning up excerpt
  add_filter( 'excerpt_more', 'sepal_and_seed_excerpt_more' );

} /* end sepal and seed ahoy */

// let's get this party started
add_action( 'after_setup_theme', 'sepal_and_seed_ahoy' );

/************* Remove emoji *************/
function disable_wp_emojicons() {

  // all actions related to emojis
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

  // filter to remove TinyMCE emojis
  add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
}
add_action( 'init', 'disable_wp_emojicons' );

function disable_emojicons_tinymce( $plugins ) {
  if ( is_array( $plugins ) ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
  } else {
    return array();
  }
}

/************* Remove embed.js *************/
function disable_embeds_init() {

    // Remove the REST API endpoint.
    remove_action('rest_api_init', 'wp_oembed_register_route');

    // Turn off oEmbed auto discovery.
    // Don't filter oEmbed results.
    remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);

    // Remove oEmbed discovery links.
    remove_action('wp_head', 'wp_oembed_add_discovery_links');

    // Remove oEmbed-specific JavaScript from the front-end and back-end.
    remove_action('wp_head', 'wp_oembed_add_host_js');
}

add_action('init', 'disable_embeds_init', 9999);

remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed
remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
remove_action( 'wp_head', 'index_rel_link' ); // index link
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // prev link
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // start link
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // Display relational links for the posts adjacent to the current post.
remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version

/************* OEMBED SIZE OPTIONS *************/

if ( ! isset( $content_width ) ) {
	$content_width = 680;
}

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'sepal-and-seed-thumb-600', 600, 600, true );
add_image_size( 'sepal-and-seed-thumb-300', 300, 300, true );

/************* Add Title Tag Support *************/
add_theme_support( 'title-tag' );

/*
to add more sizes, simply copy a line from above
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 100 sized image,
we would use the function:
<?php the_post_thumbnail( 'sepal-and-seed-thumb-300' ); ?>
for the 600 x 150 image:
<?php the_post_thumbnail( 'sepal-and-seed-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

add_filter( 'image_size_names_choose', 'sepal_and_seed_custom_image_sizes' );

function sepal_and_seed_custom_image_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'sepal-and-seed-thumb-600' => __('600px by 600px', 'sepalandseedtheme'),
        'sepal-and-seed-thumb-300' => __('300px by 300px', 'sepalandseedtheme'),
    ) );
}

/*
The function above adds the ability to use the dropdown menu to select
the new images sizes you have just created from within the media manager
when you add media to your content blocks. If you add more image sizes,
duplicate one of the lines in the array and name it according to your
new image size.
*/

/************* THEME CUSTOMIZE *********************/

/*
  A good tutorial for creating your own Sections, Controls and Settings:
  http://code.tutsplus.com/series/a-guide-to-the-wordpress-theme-customizer--wp-33722

  Good articles on modifying the default options:
  http://natko.com/changing-default-wordpress-theme-customization-api-sections/
  http://code.tutsplus.com/tutorials/digging-into-the-theme-customizer-components--wp-27162

  To do:
  - Create a js for the postmessage transport method
  - Create some sanitize functions to sanitize inputs
  - Create some boilerplate Sections, Controls and Settings
*/

function sepal_and_seed_theme_customizer($wp_customize) {
  // $wp_customize calls go here.
  //
  // Uncomment the below lines to remove the default customize sections

  // $wp_customize->remove_section('title_tagline');
  // $wp_customize->remove_section('colors');
  // $wp_customize->remove_section('background_image');
  // $wp_customize->remove_section('static_front_page');
  // $wp_customize->remove_section('nav');

  // Uncomment the below lines to remove the default controls
  // $wp_customize->remove_control('blogdescription');

  // Uncomment the following to change the default section titles
  // $wp_customize->get_section('colors')->title = __( 'Theme Colors' );
  // $wp_customize->get_section('background_image')->title = __( 'Images' );
}

add_action( 'customize_register', 'sepal_and_seed_theme_customizer' );

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function sepal_and_seed_register_sidebars() {
	// register_sidebar(array(
	// 	'id' => 'sidebar1',
	// 	'name' => __( 'Sidebar 1', 'sepalandseedtheme' ),
	// 	'description' => __( 'The first (primary) sidebar.', 'sepalandseedtheme' ),
	// 	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	// 	'after_widget' => '</div>',
	// 	'before_title' => '<h4 class="widgettitle">',
	// 	'after_title' => '</h4>',
	// ));

	/*
	to add more sidebars or widgetized areas, just copy
	and edit the above sidebar code. In order to call
	your new sidebar just use the following code:

	Just change the name to whatever your new
	sidebar's id is, for example:

	register_sidebar(array(
		'id' => 'sidebar2',
		'name' => __( 'Sidebar 2', 'sepalandseedtheme' ),
		'description' => __( 'The second (secondary) sidebar.', 'sepalandseedtheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	To call the sidebar in your template, you can just copy
	the sidebar.php file and rename it to your sidebar's name.
	So using the above example, it would be:
	sidebar-sidebar2.php

	*/
} // don't remove this bracket!


/************* COMMENT LAYOUT *********************/

// Comment Layout
function sepal_and_seed_comments( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment; ?>
  <div id="comment-<?php comment_ID(); ?>" <?php comment_class('cf'); ?>>
    <article  class="cf">
      <header class="comment-author vcard">
        <cite><?php echo get_comment_author_link();?></cite> commented on <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__( 'F jS, Y', 'sepalandseedtheme' )); ?> </a></time>
        <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
      </header>
      <?php if ($comment->comment_approved == '0') : ?>
        <div class="alert alert-info">
          <p><?php _e( 'Your comment is awaiting moderation.', 'sepalandseedtheme' ) ?></p>
        </div>
      <?php endif; ?>
      <section class="comment_content cf">
        <?php comment_text() ?>
      </section>
       <?php edit_comment_link('Edit/Delete');?>
    </article>
  <?php // </li> is added by WordPress automatically ?>
<?php
} // don't remove this bracket!


/*
This is a modification of a function found in the
twentythirteen theme where we can declare some
external fonts. If you're using Google Fonts, you
can replace these fonts, change it in your scss files
and be up and running in seconds.
*/
function sepal_and_seed_fonts() {
  //wp_enqueue_style('googleFonts', '//fonts.googleapis.com/css?family=Open+Sans');
}

//add_action('wp_enqueue_scripts', 'sepal_and_seed_fonts');

// Add manual excerpt back to wp-admin default view
add_filter('default_hidden_meta_boxes', 'be_hidden_meta_boxes', 10, 2);
function be_hidden_meta_boxes($hidden, $screen) {
    if ( 'post' == $screen->base || 'page' == $screen->base ) {
        // removed 'postcustom',
        $hidden = array(
            'slugdiv',
            'trackbacksdiv',
            'postexcerpt',
            'commentstatusdiv',
            'commentsdiv',
            'authordiv',
            'revisionsdiv'
        );
    }
    return $hidden;
}

// LOAD Custom Recent Posts Widget
// require_once( 'library/class-custom-recent-posts-widget.php' );
//
// add_action( 'widgets_init', create_function( '', 'register_widget( "Custom_Widget_Recent_Posts" );' ) );

function erin_custom_background_cb() {
    // $background is the saved custom image, or the default image.
    $background = set_url_scheme( get_background_image() );

    // $color is the saved custom color.
    // A default has to be specified in style.css. It will not be printed here.
    $color = get_background_color();

    if ( $color === get_theme_support( 'custom-background', 'default-color' ) ) {
        $color = false;
    }

    if ( ! $background && ! $color ) {
        if ( is_customize_preview() ) {
            echo '<style type="text/css" id="custom-background-css"></style>';
        }
        return;
    }

    $style = $color ? "background-color: #$color;" : '';

    if ( $background ) {
        $image = ' background-image: url("' . esc_url_raw( $background ) . '"),linear-gradient(to top right,#fff , #eee, #bbb);';

        // Background Position.
        $position_x = get_theme_mod( 'background_position_x', get_theme_support( 'custom-background', 'default-position-x' ) );
        $position_y = get_theme_mod( 'background_position_y', get_theme_support( 'custom-background', 'default-position-y' ) );

        if ( ! in_array( $position_x, array( 'left', 'center', 'right' ), true ) ) {
            $position_x = 'left';
        }

        if ( ! in_array( $position_y, array( 'top', 'center', 'bottom' ), true ) ) {
            $position_y = 'top';
        }

        $position = " background-position: $position_x $position_y;";

        // Background Size.
        $size = get_theme_mod( 'background_size', get_theme_support( 'custom-background', 'default-size' ) );

        if ( ! in_array( $size, array( 'auto', 'contain', 'cover' ), true ) ) {
            $size = 'auto';
        }

        $size = " background-size: $size;";

        // Background Repeat.
        $repeat = get_theme_mod( 'background_repeat', get_theme_support( 'custom-background', 'default-repeat' ) );

        if ( ! in_array( $repeat, array( 'repeat-x', 'repeat-y', 'repeat', 'no-repeat' ), true ) ) {
            $repeat = 'repeat';
        }

        $repeat = " background-repeat: $repeat;";

        // Background Scroll.
        $attachment = get_theme_mod( 'background_attachment', get_theme_support( 'custom-background', 'default-attachment' ) );

        if ( 'fixed' == $attachment ) {
            $attachment = 'scroll'; // disallow fixed backgrounds, which don't work in iOS and are computationally-expensive
        }

        $attachment = " background-attachment: $attachment;";

        $style .= $image . $position . $size . $repeat . $attachment;
    }
?>
<script>
	// conditional load of bg img
	function updateViewportDimensions() {
		var w=window,d=document,e=d.documentElement,g=d.getElementsByTagName('body')[0],x=w.innerWidth
		||e.clientWidth||g.clientWidth,y=w.innerHeight||e.clientHeight||g.clientHeight;
		return { width:x,height:y };
	}
	var viewport = updateViewportDimensions();
	if(viewport.width > 590){
		var css = 'body.custom-background .searchbar-bottom,header[role="banner"]{ <?php echo trim( $style ); ?> }',
		    head = document.head || document.getElementsByTagName('head')[0],
		    style = document.createElement('style');
		style.type = 'text/css';
		if (style.styleSheet){
		  style.styleSheet.cssText = css;
		} else {
		  style.appendChild(document.createTextNode(css));
		}
		head.appendChild(style);
	}
</script>

<?php
}

/* DON'T DELETE THIS CLOSING TAG */ ?>
