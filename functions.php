<?php
/*
Name: Sigami Base
Description: WordPress Boostrap Skeleton
Author: Miguel Sirvent
*/
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
        $files = glob($this->theme_dir."/library/classes/*.php");
        foreach ($files as $file) {
            require_once ($file);
        }
        load_theme_textdomain('sigami', $this->theme_path . '/languages');
        // Set content width
        if (!isset($content_width)) $content_width = 580;
        /************* THUMBNAIL SIZE OPTIONS *************/
        add_image_size('featured', 780, 300, true);
        add_image_size('featured-home', 970, 311, true);
        add_image_size('featured-carousel', 970, 400, true);
        //ACTIONS
        add_action('after_setup_theme',array($this,'after_setup_theme'));
        /** Sidebars & Widgetizes Areas **/
        add_action('widgets_init', array($this,'widgets_init'));
        //add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_scripts' ) );
        //add_action( 'init', array( $this, 'init' ) );
        //add_action( 'admin_init', array( $this, 'admin_init' ) );
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
        /** Custom Theme Supports  **/
        add_theme_support('sigami-ie'); //internet explorer 8 support
        add_theme_support('sigami-grunt'); //reload browser on grunt, only for development
    }
    public function widgets_init()
    {
        register_sidebar(array(
            'id' => 'sidebar1',
            'name' => 'Main Sidebar',
            'description' => __('Used on every page BUT the homepage page template.','sigami'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h4 class="widgettitle">',
            'after_title' => '</h4>',
        ));

        register_sidebar(array(
            'id' => 'home-page',
            'name' => 'Homepage Sidebar',
            'description' => __('Used only on the homepage page template.','sigami'),
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

        wp_register_style('jutzu', get_template_directory_uri() . '/library/dist/css/jutzu.css', array(), '1.0', 'all');
        wp_enqueue_style('jutzu');

        wp_register_script('jutzu', get_template_directory_uri() . '/library/dist/js/jutzu.min.js', array('jquery'), '1.2');
        wp_enqueue_script('jutzu');

    }
    static function main_nav_fallback(){
        wp_page_menu( $args = array() );
    }
    static function footer_links_fallback(){
        wp_page_menu( $args = array() );
    }

}
Sigami_Base::get_instance();