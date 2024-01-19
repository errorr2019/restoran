<?php
// Plugin Name: Chef Custom Our Team
// Plugin URI: https://www.genetechsolutions.com/
// Description: You Can Add Team Members Here
// Version: 1.0
// Author: Ali Asghar


// To Prevent Direct Access To PHP Files
if (!defined('ABSPATH')) {
    exit();
}

// Adding action of fields
function create_our_team_cpt(){
    $labels = array( 
        'name' => __('Our_Team', 'Our_Team'),
        'singular_name' => __('Our_Team', 'Our_Team'),
        'menu_name' => __('Our_Team', 'Our_Team'),
        'name_admin_bar' => __('Our_Team', 'Our_Team'),
        'attributes' => __('Our_Team Attributes', 'Our_Team'),
        'parent_item_colon' => __('Parent Our_Team', 'Our_Team'),
        'all_items' => __('All Our_Team', 'Our_Team'),
        'add_new_item' => __('Add New Our_Team', 'Our_Team'),
        'add_new' => __('Add New', 'Our_Team'),
        'new_item' => __('New Our_Team', 'Our_Team'),
        'edit_item' => __('Edit Our_Team', 'Our_Team'),
        'update_item' => __('Update Our_Team', 'Our_Team'),
        'view_item' => __('View Our_Team', 'Our_Team'),
        'view_items' => __('View Our_Team', 'Our_Team'),
        'search_items' => __('Search Our_Team', 'Our_Team'),
        'not_found' => __('Not Found', 'Our_Team'),
        'not_found_in_trash' => __('Not Found In Trash', 'Our_Team'),
        'insert_into_item' => __('Insert Into Our_Team', 'Our_Team'),
        'uploaded_to_this_item' => __('Uploaded Into This Our_Team', 'Our_Team'),
        'items_list' => __('Our_Team List', 'Our_Team'),
        'items_list_navigation' => __('Our_Team List Navigation', 'Our_Team'),
        'filter_items_list' => __('Filter Our_Team List', 'Our_Team'),
    );

    $args = array(
        'label' => __('Our_Team', 'Our_Team'),
        'description' => __('List Of All Our_Team', 'Our_Team'),
        'labels' => $labels,
        'supports' => array('title', 'excerpt', 'revisions', 'category', 'editor', 'thumbnail'),
        'taxonomies' => array('category', 'post_tag'),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 6,
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'hierarchical' => false,
        'exclude_from_search' => false,
        'show_in_rest' => true,
        'publicly_queryable' => true,
        'capability_type' => 'post',
        'rewrite' => array('slug' => 'our_team'),
    );

    register_post_type('our_team', $args);
}

add_action('init', 'create_our_team_cpt');

function create_our_team_hierarchical_taxonomy(){
    $labels = array(
        'name' => _x('Our_Team Category', 'taxonomy general name'),
        'singular_name' => _x('Topic', 'taxonomy singular name'),
        'search_items' => __('Search Categories'),
        'all_items' => __('All Categories'),
        'parent_item' => __('Parent Categories'),
        'parent_item_colon' => __('Parent Categories:'),
        'edit_item' => __('Edit Categories'),
        'update_item' => __('Update Categories'),
        'add_new_item' => __('Add New Categories'),
        'new_item_name' => __('New Categories Name'),
        'menu_name' => __('Our_Team Categories'),
    );

    register_taxonomy('our_team_category', array('our_team'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'our_team-category'),
    ));
}

add_action('init', 'create_our_team_hierarchical_taxonomy');

// Creating Structural Short Code
function show_our_team($atts){
    $args = array(
        'post_type' => 'our_team',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'orderby' => 'ID',
        'order' => 'asc',
        'tax_query' => array(
            array(
                'taxonomy' => 'our_team_category',
                'field' => 'slug',
                'terms' => $atts['slug'],
            ),
        ),
    );


    $featured = new WP_Query($args);
    $html = '';

    $html .= '<div class="about_our_team-section">';

    if ($featured->have_posts()):
        while ($featured->have_posts()): $featured->the_post();

            $html .= '<div class="about_our_team_row">
                        <div class="about_our_team_col">
                          <div class="about-cpt-bg"> <div class="about_feature-img">
                                <img src="'.get_the_post_thumbnail_url(get_the_ID()).'">
                            </div> 
                            <div class="about_our_team_content">
                                <h2>'.get_the_title().'</h2>
                               
                                <p class="about_our_team_bio">'.get_the_content().'</p>
                            </div>
                            </div> 
                        </div>
                    </div>';

        endwhile;
    endif;

    $html .= '</div>';

    wp_reset_query();
    return $html;
}

add_shortcode('show_our_team_shortcode', 'show_our_team');
?>
