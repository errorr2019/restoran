<?php
/*
Plugin Name: menu
Plugin URI: https://www.genetechsolutions.com/
Description: You Can Add Menu Here
Version: 1.0
Author: sidra zehra
*/

// To Prevent Direct Access To PHP Files
if (!defined('ABSPATH')) {
    exit();
}

// Adding action of fields
function create_Menu_cpt(){
    $labels = array(
        'name' => __('Menu', 'Menu'),
        'singular_name' => __('Menu', 'Menu'),
        'menu_name' => __('Menu', 'Menu'),
        'name_admin_bar' => __('Menu', 'Menu'),
        'attributes' => __('Menu Attributes', 'Menu'),
        'parent_item_colon' => __('Parent Menu', 'Menu'),
        'all_items' => __('All Menu', 'Menu'),
        'add_new_item' => __('Add New Menu', 'Menu'),
        'add_new' => __('Add New', 'Menu'),
        'new_item' => __('New Menu', 'Menu'),
        'edit_item' => __('Edit Menu', 'Menu'),
        'update_item' => __('Update Menu', 'Menu'),
        'view_item' => __('View Menu', 'Menu'),
        'view_items' => __('View Menu', 'Menu'),
        'search_items' => __('Search Menu', 'Menu'),
        'not_found' => __('Not Found', 'Menu'),
        'not_found_in_trash' => __('Not Found In Trash', 'Menu'),
        'insert_into_item' => __('Insert Into Menu', 'Menu'),
        'uploaded_to_this_item' => __('Uploaded Into This Menu', 'Menu'),
        'items_list' => __('Menu List', 'Menu'),
        'items_list_navigation' => __('Menu List Navigation', 'Menu'),
        'filter_items_list' => __('Filter Menu List', 'Menu'),
    );

    $args = array(
        'label' => __('Menu', 'Menu'),
        'description' => __('List Of All Menu', 'Menu'),
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
        'hierarchical' => true,
        'exclude_from_search' => false,
        'show_in_rest' => true,
        'publicly_queryable' => true,
        'capability_type' => 'post',
        'rewrite' => array('slug' => 'menu'),
    );

    register_post_type('menu', $args);
}

add_action('init', 'create_menu_cpt');

// taxonomies
function create_menu_hierarchical_taxonomy(){
    $labels = array(
        'name' => _x('Menu Category', 'taxonomy general name'),
        'singular_name' => _x('Topic', 'taxonomy singular name'),
        'search_items' => __('Search Categories'),
        'all_items' => __('All Categories'),
        'parent_item' => __('Parent Categories'),
        'parent_item_colon' => __('Parent Categories:'),
        'edit_item' => __('Edit Categories'),
        'update_item' => __('Update Categories'),
        'add_new_item' => __('Add New Categories'),
        'new_item_name' => __('New Categories Name'),
        'menu_name' => __('Menu Categories'),
    );



    register_taxonomy('menu_category', array('menu'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'menu-category'),
    ));
}

add_action('init', 'create_menu_hierarchical_taxonomy');

// Creating Structural Short Code
function show_menu($atts){
    $args = array(
        'post_type' => 'menu',
        'posts_per_page' => 8,
        'post_status' => 'publish',
        'orderby' => 'ID',
        'order' => 'asc',
        'tax_query' => array(
            // code for slug
            array(
                'taxonomy' => 'menu_category',
                'field' => 'slug',
                'terms' => $atts['slug'],
            ),
        ),
    );

    

    
    $terms = get_terms(array(
        'taxonomy'   => 'menu_category',
        'hide_empty' => false,
    ));
    
    if ($terms) :
        echo '<ul>';
    
        foreach ($terms as $term) :
            echo '<li><a href="' . get_term_link($term) . '">' . $term->name . '</a></li>';
        endforeach;
    
        echo '</ul>';
    else :
        echo '<p>No menu categories found</p>';
    endif;
    
    // Check if a category is clicked
    if (is_tax('menu_category')) {
        $current_term = get_queried_object();
        
        $args = array(
            'post_type'      => 'menu',
            'posts_per_page' => -1,
            'tax_query'      => array(
                array(
                    'taxonomy' => 'menu_category',
                    'field'    => 'term_id',
                    'terms'    => $current_term->term_id,
                ),
            ),
        );
    
        $menu_items = new WP_Query($args);
    
        if ($menu_items->have_posts()) :
            echo '<ul>';
    
            while ($menu_items->have_posts()) : $menu_items->the_post();
                // Display only the post title without a link
                echo '<li>' . get_the_title() . '</li>';
            endwhile;
    
            echo '</ul>';
        else :
            echo '<p>No menu items found for this category</p>';
        endif;
    
        wp_reset_query(); // Reset the query to avoid conflicts
    }
   
    


    $featured = new WP_Query($args);
    $html = '';

    $html .= '<div class="our_menu-section">';

    if ($featured->have_posts()):
        while ($featured->have_posts()): $featured->the_post();

            $html .= '<div class="our_menu_row">
                        <div class="our_menu_col">
                            <div class="menu_feature-img">
                                <img src="'.get_the_post_thumbnail_url(get_the_ID()).'">
                            </div>
                            <div class="our_menu_content">
                                <h2>'.get_the_title().'</h2>
                                <p class="menu-underline"></p>
                                <p class="menu-bio">'.get_the_content().'</p>
                            </div>
                        </div>
                    </div>';

        endwhile;
    endif;

    $html .= '</div>';

    wp_reset_query();
    return $html;
}

add_shortcode('show_menu_shortcode', 'show_menu');







