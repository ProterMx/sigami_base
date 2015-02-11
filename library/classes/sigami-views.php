<?php

/**
 * Class for views and other stuff
 */
class  Sigami_Views
{
    private static $instance = null;

    public static function get_instance()
    {
        if (null == self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    private function Sigami_Views()
    {
        /** Get <head> <title> to behave like other themes **/
        add_filter('wp_title', array($this,'wp_bootstrap_wp_title'), 10, 2);
        /** Remove <p> tags from around images **/
        add_filter('the_content', array($this,'the_content'));
        /** Add lead class to first paragraph **/
        add_filter('the_content', array($this, 'the_content_lead'));
        /** Add entry-content-asset class  **/
        add_filter('embed_oembed_htm', array($this, 'embed_oembed_htm'));
        /** Excerpt stuff  **/
        add_filter('excerpt_length', array($this, 'excerpt_length'));
        add_filter('excerpt_more', array($this, 'excerpt_more'));
    }
    function wp_title($title, $sep)
    {
        global $paged, $page;

        if (is_feed()) {
            return $title;
        }

        // Add the site name.
        $title .= get_bloginfo('name');

        // Add the site description for the home/front page.
        $site_description = get_bloginfo('description', 'display');
        if ($site_description && (is_home() || is_front_page())) {
            $title = "$title $sep $site_description";
        }

        // Add a page number if necessary.
        if ($paged >= 2 || $page >= 2) {
            $title = "$title $sep " . sprintf(__('Page %s', 'sigami'), max($paged, $page));
        }

        return $title;
    }
    function the_content($content)
    {
        return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
    }

    function the_content_lead($content)
    {
        global $post;

        // if we're on the homepage, don't add the lead class to the first paragraph of text
        if (is_page_template('page-homepage.php'))
            return $content;
        else
            return preg_replace('/<p([^>]+)?>/', '<p$1 class="lead">', $content, 1);
    }

    function embed_oembed_htm($cache, $url, $attr = '', $post_ID = '')
    {
        return '<div class="entry-content-asset">' . $cache . '</div>';
    }

    function excerpt_length($length)
    {
        return $length;
    }

    function excerpt_more($more)
    {
        global $post;
        return '...  <a href="' . get_permalink($post->ID) . '" class="more-link" title="Read ' . get_the_title($post->ID) . '">'.__('Read more &raquo;','sigami').'</a>';
    }

}

Sigami_Views::get_instance();

// Numeric Page Navi (built into the theme by default)
function wp_bootstrap_page_navi($before = '', $after = '')
{
    global $wpdb, $wp_query;
    $request = $wp_query->request;
    $posts_per_page = intval(get_query_var('posts_per_page'));
    $paged = intval(get_query_var('paged'));
    $numposts = $wp_query->found_posts;
    $max_page = $wp_query->max_num_pages;
    if ($numposts <= $posts_per_page) {
        return;
    }
    if (empty($paged) || $paged == 0) {
        $paged = 1;
    }
    $pages_to_show = 7;
    $pages_to_show_minus_1 = $pages_to_show - 1;
    $half_page_start = floor($pages_to_show_minus_1 / 2);
    $half_page_end = ceil($pages_to_show_minus_1 / 2);
    $start_page = $paged - $half_page_start;
    if ($start_page <= 0) {
        $start_page = 1;
    }
    $end_page = $paged + $half_page_end;
    if (($end_page - $start_page) != $pages_to_show_minus_1) {
        $end_page = $start_page + $pages_to_show_minus_1;
    }
    if ($end_page > $max_page) {
        $start_page = $max_page - $pages_to_show_minus_1;
        $end_page = $max_page;
    }
    if ($start_page <= 0) {
        $start_page = 1;
    }

    echo $before . '<ul class="pagination">' . "";
    if ($paged > 1) {
        $first_page_text = "&laquo";
        echo '<li class="prev"><a href="' . get_pagenum_link() . '" title="' . __('First', 'sigami') . '">' . $first_page_text . '</a></li>';
    }

    $prevposts = get_previous_posts_link(__('&larr; Previous', 'sigami'));
    if ($prevposts) {
        echo '<li>' . $prevposts . '</li>';
    } else {
        echo '<li class="disabled"><a href="#">' . __('&larr; Previous', 'sigami') . '</a></li>';
    }

    for ($i = $start_page; $i <= $end_page; $i++) {
        if ($i == $paged) {
            echo '<li class="active"><a href="#">' . $i . '</a></li>';
        } else {
            echo '<li><a href="' . get_pagenum_link($i) . '">' . $i . '</a></li>';
        }
    }
    echo '<li class="">';
    next_posts_link(__('Next &rarr;', 'sigami'));
    echo '</li>';
    if ($end_page < $max_page) {
        $last_page_text = "&raquo;";
        echo '<li class="next"><a href="' . get_pagenum_link($max_page) . '" title="' . __('Last', 'sigami') . '">' . $last_page_text . '</a></li>';
    }
    echo '</ul>' . $after . "";
}





