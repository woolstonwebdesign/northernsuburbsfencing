<?php

/*
@package: wwd blankslate
*/

add_theme_support('post-thumbnails');
add_theme_support('automatic-feed-links');
add_post_type_support('layout', 'thumbnail');
add_post_type_support('post', 'page-attributes');
add_image_size('medium_large', 600, 600);
add_filter('widget_text', 'do_shortcode');

function wwd_custom_logo_setup() {
    $defaults = array(
        'height'      => 100,
        'width'       => 100,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ),
    );
    add_theme_support( 'custom-logo', $defaults );
}
add_action( 'after_setup_theme', 'wwd_custom_logo_setup' );

//  Special methods for adding dashboard videos.
function wwd_dashboard_videos()
{
    $videos = array(
        // array(
        //     'url' => 'https://res.cloudinary.com/woolston-web-design/video/upload/v1593785366/focussed_marketing/lacuna-editing-navigating.mp4', 
        //     'title' => '04/07/2020: Editing Layout Content'
        // ),
        // array(
        //     'url' => 'https://res.cloudinary.com/woolston-web-design/video/upload/v1593083090/focussed_marketing/lacuna.mp4', 
        //     'title' => 'Development Methodology'
        // )
    );
    if (function_exists('wwd_render_videos') && count($videos) > 0) {
        echo wwd_render_videos($videos);
    } else {
        echo "<h2>No videos at this time</h2>";
    }
}    

//  Custom Post Types specific to this theme
function wwd_custom_post_types() {
    if (function_exists('wwd_generic_taxonomy')) {
        wwd_generic_taxonomy('builder-component', 'Component Locations', 'builder-component', array('layout'));
    }

    if (function_exists('wwd_add_custom_post')) {
        wwd_add_custom_post('layout', 'Layout Builder', 'Layout Builders', 'dashicons-book-alt', array('post'));
    }
}
add_action('init', 'wwd_custom_post_types');

if (class_exists('WWD_Custom_Taxonomy')) {
    $wwd_custom_tax = new WWD_Custom_Taxonomy();
    $wwd_custom_tax->Taxonomies = array('builder-component');
    $wwd_custom_tax->init();
}

function wwd_search_filter($query) {

    if (is_admin() || !$query->is_main_query()) { return $query; }

    global $wp_post_types;
    $wp_post_types['layout']->exclude_from_search = true;

    $meta_query = [];

    if ($query->is_archive) {
        
        if (array_key_exists('product_cat', $query->query)) {
            $query->set('order', 'ASC');
            $query->set('orderby', 'title');
            $query->set('posts_per_page', -1);
        }
    }

    if ($query->is_search) {
        $query->set('posts_per_page', 8);
    }

    // var_dump($query);
    return $query;
}
add_action('pre_get_posts', 'wwd_search_filter');
