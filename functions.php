<?php
/*
Name: Sigami Base
Description: WordPress Boostrap Skeleton
Author: Miguel Sirvent
*/
define('SIGAMI_LANG', 'es');
$files = glob('library/classes/*.php');

foreach ($files as $file) {
    require_once ($file);
}

class  Sigami_Base {
    private static $instance = null;
    private $theme_path;
    private $theme_url;
    public static function get_instance() {
    if ( null == self::$instance ) {
        self::$instance = new self;
    }
        return self::$instance;
    }
    private function Sigami_Base() {
        $this->theme_dir = get_stylesheet_directory();
        $this->theme_url = get_stylesheet_directory_uri();
        load_theme_textdomain('sigami', $this->theme_path . '/languages');
        // Set content width
        if (!isset($content_width)) $content_width = 580;
        /************* THUMBNAIL SIZE OPTIONS *************/
        add_image_size('wpbs-featured', 780, 300, true);
        add_image_size('wpbs-featured-home', 970, 311, true);
        add_image_size('wpbs-featured-carousel', 970, 400, true);
        //ACTIONS
        add_action('after_setup_theme',array($this,'widgets_init'));
        /** Sidebars & Widgetizes Areas **/
        add_action('widgets_init', array($this,'widgets_init'));
        //add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
        //add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_scripts' ) );
        //add_action( 'init', array( $this, 'init' ) );
        //add_action( 'admin_init', array( $this, 'admin_init' ) );
        //FILTERS
        //$this->run_theme();
    }
    public function after_setup_theme(){
        add_theme_support('post-thumbnails');      // wp thumbnails (sizes handled in functions.php)
        set_post_thumbnail_size(125, 125, true);   // default thumb size
//        add_theme_support('custom-background');  // wp custom background
        add_theme_support('automatic-feed-links'); // rss
        add_theme_support( 'html5', array(
            'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
        ) );
        // Add post format support - if these are not needed, comment them out
//        add_theme_support('post-formats',      // post formats
//            array(
//                'aside',   // title less blurb
//                'gallery', // gallery of images
//                'link',    // quick link to other site
//                'image',   // an image
//                'quote',   // a quick quote
//                'status',  // a Facebook like status update
//                'video',   // video
//                'audio',   // audio
//                'chat'     // chat transcript
//            )
//        );
        add_theme_support('menus');            // wp menus
        register_nav_menus(                      // wp3+ menus
            array(
                'main_nav' => 'The Main Menu',   // main nav in header
                'footer_links' => 'Footer Links' // secondary nav in footer
            ));
    }
    public function widgets_init()
    {
        register_sidebar(array(
            'id' => 'sidebar1',
            'name' => 'Main Sidebar',
            'description' => 'Used on every page BUT the homepage page template.',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h4 class="widgettitle">',
            'after_title' => '</h4>',
        ));

        register_sidebar(array(
            'id' => 'sidebar2',
            'name' => 'Homepage Sidebar',
            'description' => 'Used only on the homepage page template.',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h4 class="widgettitle">',
            'after_title' => '</h4>',
        ));

        register_sidebar(array(
            'id' => 'footer1',
            'name' => 'Footer 1',
            'before_widget' => '<div id="%1$s" class="widget col-sm-4 %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h4 class="widgettitle">',
            'after_title' => '</h4>',
        ));

        register_sidebar(array(
            'id' => 'footer2',
            'name' => 'Footer 2',
            'before_widget' => '<div id="%1$s" class="widget col-sm-4 %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h4 class="widgettitle">',
            'after_title' => '</h4>',
        ));

        register_sidebar(array(
            'id' => 'footer3',
            'name' => 'Footer 3',
            'before_widget' => '<div id="%1$s" class="widget col-sm-4 %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h4 class="widgettitle">',
            'after_title' => '</h4>',
        ));


    }
    public function get_theme_url() {
        return $this->theme_dir;
    }
    public function get_theme_path() {
        return $this->theme_path;
    }
    public function init() {
    }
    public function admin_init() {
    }        
    public function admin_enqueue_scripts() {
    }
    public function wp_enqueue_scripts() {
        if (!is_admin()) {
            if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1))
                wp_enqueue_script('comment-reply');
        }

        wp_register_style('jutzu', get_template_directory_uri() . '/library/dist/css/jutzu.min.css', array(), '1.0', 'all');
        wp_enqueue_style('jutzu');

        wp_register_script('jutzu',
            get_template_directory_uri() . '/library/dist/js/jutzu.min.js',
            array('jquery'),
            '1.2');

        wp_enqueue_script('jutzu');
    }
}
Sigami_Base::get_instance();

function wp_bootstrap_main_nav()
{
    // Display the WordPress menu if available
    wp_nav_menu(
        array(
            'menu' => 'main_nav', /* menu name */
            'menu_class' => 'nav navbar-nav',
            'theme_location' => 'main_nav', /* where in the theme it's assigned */
            'container' => 'false', /* container class */
            'fallback_cb' => 'wp_bootstrap_main_nav_fallback', /* menu fallback */
        )
    );
}

function wp_bootstrap_footer_links()
{
    // Display the WordPress menu if available
    wp_nav_menu(
        array(
            'menu' => 'footer_links', /* menu name */
            'theme_location' => 'footer_links', /* where in the theme it's assigned */
            'container_class' => 'footer-links clearfix', /* container class */
            'fallback_cb' => 'wp_bootstrap_footer_links_fallback' /* menu fallback */
        )
    );
}

// this is the fallback for header menu
function wp_bootstrap_main_nav_fallback()
{
    /* you can put a default here if you like */
}

// this is the fallback for footer menu
function wp_bootstrap_footer_links_fallback()
{
    /* you can put a default here if you like */
}