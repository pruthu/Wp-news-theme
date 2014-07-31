<?php
/*===================================================================
Blogmag Functions
=================================================================== */

/*===================================================================
Register Menus
=================================================================== */
function register_menu() {
    register_nav_menu('primary-menu', __('Primary Menu', 'arsene'));
    register_nav_menu('top-menu', __('Top Menu', 'arsene'));
}
add_action('init', 'register_menu');

/*===================================================================
Register Sidebars
=================================================================== */
if (function_exists('register_sidebar')) {

    register_sidebar(array(
        'name' => __('Default Sidebar','arsene'),
        'id' => 'sidebar-default',
        'before_widget' => '<div id="%1$s" class="widget %2$s"><span class="paper-tape"></span>',
        'after_widget' => '</div><div class="clearfix"></div>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ));

    register_sidebar(array(
        'name' => __('Homepage Sidebar','arsene'),
        'id' => 'sidebar-front-page',
        'description' => __('Front Page sidebar. Leave blank if using Default Sidebar.','arsene'),
        'before_widget' => '<div id="%1$s" class="widget %2$s"><span class="paper-tape"></span>',
        'after_widget' => '</div><div class="clearfix"></div>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ));

    register_sidebar(array(
        'name' => __('Single Sidebar','arsene'),
        'id' => 'sidebar-single',
        'description' => __('Single post sidebar. Leave blank if using Default Sidebar.','arsene'),
        'before_widget' => '<div id="%1$s" class="widget %2$s"><span class="paper-tape"></span>',
        'after_widget' => '</div><div class="clearfix"></div>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ));

     register_sidebar(array(
        'name' => __('Single Bottom Sidebar','arsene'),
        'id' => 'sidebar-single-bottom',
        'description' => __('After single post sidebar.','arsene'),
        'before_widget' => '<div id="%1$s" class="widget %2$s"><span class="paper-tape"></span>',
        'after_widget' => '</div><div class="clearfix"></div>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ));

    register_sidebar(array(
        'name' => __('Page Sidebar','arsene'),
        'id' => 'sidebar-page',
        'description' => __('Sidebar for all pages. Leave blank if using Default Sidebar.','arsene'),
        'before_widget' => '<div id="%1$s" class="widget %2$s"><span class="paper-tape"></span>',
        'after_widget' => '</div><div class="clearfix"></div>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ));

    register_sidebar(array(
        'name' => __('Footer Sidebar','arsene'),
        'id' => 'sidebar-footer',
        'description' => __('Drag and drop widgets here (max. 4 widgets).','arsene'),
        'before_widget' => '<div class="span3"><div id="%1$s" class="widget %2$s"><span class="paper-tape"></span>',
        'after_widget' => '</div><div class="clearfix"></div></div>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ));

}

/*===================================================================
Thumbnail setting
=================================================================== */
if (function_exists('add_theme_support')) {
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(100, 80, true); // Normal size
    add_image_size('big-image', 728, 400, true); // Big image
    add_image_size('mediumbig-image', 355, 252, true); // Medium big featured image
    add_image_size('mediumsmall-image', 265, 189, true); // Medium small featured image 
    add_image_size('small-image', 230, 164, true); // small featured image
    add_image_size('big-thumbnail', 168, 124, true); // Bigger thumbnail
}


/*===================================================================
Links
=================================================================== */
add_theme_support( 'automatic-feed-links' );
add_editor_style();

/*  Set default embed width
================================================== */
if ( ! isset( $content_width ) ) $content_width = 750;

/*===================================================================
Enqueue scripts
=================================================================== */
function bt_scripts(){
	wp_register_script('bootstrap', get_template_directory_uri() . '/assets/bootstrap/js/bootstrap.min.js', 'jquery', '2.2.2', true);
	wp_register_script('hoverintent', get_template_directory_uri() . '/assets/js/hoverIntent.js', 'jquery', '', false);
	wp_register_script('superfish', get_template_directory_uri() . '/assets/js/superfish.js', 'jquery', '1.5.1', true);
	wp_register_script('ticker', get_template_directory_uri() . '/assets/js/jquery.ticker.js', 'jquery', '', true);
	wp_register_script('flexslider', get_template_directory_uri() . '/assets/js/jquery.flexslider.js', 'jquery', '2.1', true);
	wp_register_script('flickrfeed', get_template_directory_uri() . '/assets/js/jflickrfeed.min.js', 'jquery', '', true);
	wp_register_script('tweet', get_template_directory_uri() . '/assets/js/jquery.tweet.js', 'jquery', '', true);
    wp_register_script('prettyphoto', get_template_directory_uri() . '/assets/js/jquery.prettyPhoto.js', 'jquery', '', true);
	wp_register_script('base', get_template_directory_uri() . '/assets/js/base.js', 'jquery', '1.0', true);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script('jquery');
	wp_enqueue_script('bootstrap');
	wp_enqueue_script('hoverintent');
	wp_enqueue_script('superfish');
	wp_enqueue_script('ticker');
	wp_enqueue_script('flexslider');
	wp_enqueue_script('flickrfeed');
	wp_enqueue_script('tweet');
    wp_enqueue_script('prettyphoto');
	wp_enqueue_script('base');
}
add_action('wp_print_scripts', 'bt_scripts');


/*===================================================================
Enqueue styles
=================================================================== */
function bt_styles(){
	wp_register_style('bootstrap', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap.min.css', 'style', '2.3.0');
	wp_register_style('bootstrap-responsive', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap-responsive.min.css', 'style', '2.3.0');
	wp_register_style('font-awesome', get_template_directory_uri() . '/assets/font-awesome/css/font-awesome.min.css', 'style', '3.0.2');
	wp_register_style('superfish', get_template_directory_uri() . '/assets/css/superfish.css', 'style', '');
	wp_register_style('ticker', get_template_directory_uri() . '/assets/css/ticker-style.css', 'style', '');
	wp_register_style('flexslider', get_template_directory_uri() . '/assets/css/flexslider.css', 'style', '2.1');
    wp_register_style('prettyphoto', get_template_directory_uri() . '/assets/css/prettyPhoto.css', 'style', '');
	wp_register_style('base', get_template_directory_uri() . '/assets/css/base.css', 'style', '1.0');
    wp_register_style('dynamic-css', admin_url('admin-ajax.php?action=arsene_dynamic_css'));
    wp_register_style('default-style', get_template_directory_uri() . '/style.css', 'style', '1.0');

    
    wp_enqueue_style('bootstrap');
    if(get_arsene_option('arsene_enable_responsive'))
       wp_enqueue_style('bootstrap-responsive');
    wp_enqueue_style('default-style');

	wp_enqueue_style('font-awesome');
	wp_enqueue_style('superfish');
	wp_enqueue_style('ticker');
	wp_enqueue_style('flexslider');
    wp_enqueue_style('prettyphoto');
	wp_enqueue_style('base');
    wp_enqueue_style('dynamic-css');    
}
add_action('wp_print_styles', 'bt_styles');


/*===================================================================
Admin custom script
=================================================================== */
function arsene_custom_admin_script($hook) {
    if ($hook == 'post.php' || $hook == 'post-new.php') {
        wp_register_script('admin-script', get_template_directory_uri() . '/assets/js/admin.js', 'jquery');
        wp_enqueue_script('admin-script');
    }
}
add_action('admin_enqueue_scripts', 'arsene_custom_admin_script');


/*===================================================================
Load Post Meta
=================================================================== */
include("includes/post-meta.php");


/*===================================================================
Load Components
=================================================================== */
include("includes/components/news-ticker.php");
include("includes/components/social-menu.php");
include("includes/components/popular-post-carousel.php");
include("includes/components/editor-picks.php");
include("includes/components/related-posts.php");
include("includes/components/breadcrumb.php");
include("includes/components/social-share.php");
include("includes/components/review-post.php");


/*===================================================================
Load Meta box
=================================================================== */
include("includes/metaboxes/review-metabox.php");
include("includes/metaboxes/editor-picks-metabox.php");


/*===================================================================
Load Widgets
=================================================================== */
include('includes/widgets/widget-social.php');
include('includes/widgets/widget-ads-300x250.php');
include('includes/widgets/widget-ads-125x125.php');
include('includes/widgets/widget-tabber.php');
include('includes/widgets/widget-fb-likebox.php');
include('includes/widgets/widget-tagcloud.php');
include('includes/widgets/widget-feedburner.php');
include('includes/widgets/widget-editor-picks.php');
include('includes/widgets/widget-recent-posts.php');
include('includes/widgets/widget-recent-comments.php');
include('includes/widgets/widget-popular-posts.php');
include('includes/widgets/widget-about.php');
include('includes/widgets/widget-flickr.php');
include('includes/widgets/widget-twitter.php');

/* REGISTER WIDGETS */
register_widget('Arsene_Widget_Social');
register_widget('Arsene_Widget_Ads_300x250');
register_widget('Arsene_Widget_Ads_125x125');
register_widget('Arsene_Widget_Tabber');
register_widget('Arsene_Widget_FB_Likebox');
register_widget('Arsene_Widget_Tagcloud');
register_widget('Arsene_Widget_Feedburner');
register_widget('Arsene_Widget_Editor_Picks');
register_widget('Arsene_Widget_Recent_Posts');
register_widget('Arsene_Widget_Recent_Comments');
register_widget('Arsene_Widget_Popular_Posts');
register_widget('Arsene_Widget_About_Us');
register_widget('Arsene_Widget_Flickr');
register_widget('Arsene_Widget_Twitter');

/*===================================================================
Load Page Builder
=================================================================== */

if(class_exists("AQ_Block")){
/* Load Blocks */
require_once('includes/page-builder/block-parent.php');
require_once('includes/page-builder/block-container.php');
require_once('includes/page-builder/block-post-slider.php');
require_once('includes/page-builder/block-blog-post.php');
require_once('includes/page-builder/block-728-ads.php');
require_once('includes/page-builder/block-300-ads.php');
require_once('includes/page-builder/block-news-box.php');
require_once('includes/page-builder/block-post-thumb.php');
require_once('includes/page-builder/block-archive.php');
require_once('includes/page-builder/block-archive-slider.php');
require_once('includes/page-builder/block-archive-popular.php');
require_once('includes/page-builder/block-text.php');   /* Since v1.0.2 */
require_once('includes/page-builder/block-post-carousel.php');   /* Since v1.0.2 */

/* Register Blocks */
aq_register_block('Arsene_Block_Container');
aq_register_block('Arsene_Block_Post_Slider');
aq_register_block('Arsene_Block_Blog_Post');
aq_register_block('Arsene_Block_News_Box');
aq_register_block('Arsene_Block_Post_Thumb');
aq_register_block('Arsene_Block_728_Ads');
aq_register_block('Arsene_Block_300_Ads');
aq_register_block('Arsene_Block_Archive_Posts');
aq_register_block('Arsene_Block_Archive_Slider');
aq_register_block('Arsene_Block_Archive_Popular');
aq_register_block('Arsene_Block_Text'); /* Since v1.0.2 */
aq_register_block('Arsene_Block_Post_Carousel'); /* Since v1.0.2 */

/* Unregister Blocks */
aq_unregister_block('AQ_Text_Block');
aq_unregister_block('AQ_Column_Block');
aq_unregister_block('AQ_Clear_Block');
aq_unregister_block('AQ_Widgets_Block');
aq_unregister_block('AQ_Alert_Block');
aq_unregister_block('AQ_Tabs_Block');
}

/*===================================================================
Load Shortcodes
=================================================================== */
require_once('includes/shortcodes/shortcode-functions.php');
require_once('includes/shortcodes/shortcode-panels.php');


/*===================================================================
Option Panel
=================================================================== */
require_once('includes/admin/index.php');


/*===================================================================
Translation
=================================================================== */
add_action('after_setup_theme', 'arsene_translation');
function arsene_translation(){
    load_theme_textdomain('arsene', get_template_directory() . '/languages');
}


/*===================================================================
Google Webfonts
=================================================================== */
function arsene_get_google_webfonts(){
    $font = decode_google_webfonts();
    $arr_font = array("Arial" => "Arial");
    foreach($font as $key=>$val ){
        $arr_font[$key] = $key;
    }
    return $arr_font;
}

function arsene_select_google_webfonts($selectedFont = ''){
    if($selectedFont == 'Arial'){
        return '"Helvetica Neue", Helvetica, Arial, sans-serif';
    }else{
        $font = decode_google_webfonts();
        return $font[$selectedFont];
    }
}

function get_arsene_option($option){
    global $arsene_data;
    return stripslashes($arsene_data[$option]);
}


/* Dynamic style */
get_template_part('includes/dynamic','style');


/* Wrap Video oEmbed
================================================== */
add_filter('embed_oembed_html', 'arsene_embed_oembed_html', 99, 4);
function arsene_embed_oembed_html($html, $url, $attr, $post_id) {
  return '<div class="video-wrap">' . $html . '</div>';
}

?>