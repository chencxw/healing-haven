<?php 
function fwd_register_custom_post_types() {

    // Register Therapists
    $labels = array(
        'name'                  => _x( 'Therapists', 'post type general name' ),
        'singular_name'         => _x( 'Therapist', 'post type singular name'),
        'menu_name'             => _x( 'Therapists', 'admin menu' ),
        'name_admin_bar'        => _x( 'Therapist', 'add new on admin bar' ),
        'add_new'               => _x( 'Add New', 'therapist' ),
        'add_new_item'          => __( 'Add New Therapist' ),
        'new_item'              => __( 'New Therapist' ),
        'edit_item'             => __( 'Edit Therapist' ),
        'view_item'             => __( 'View Therapist' ),
        'all_items'             => __( 'All Therapists' ),
        'search_items'          => __( 'Search Therapists' ),
        'parent_item_colon'     => __( 'Parent Therapists:' ),
        'not_found'             => __( 'No therapists found.' ),
        'not_found_in_trash'    => __( 'No therapists found in Trash.' ),
        'archives'              => __( 'Therapist Archives'),
        'insert_into_item'      => __( 'Insert into therapist'),
        'uploaded_to_this_item' => __( 'Uploaded to this therapist'),
        'filter_item_list'      => __( 'Filter therapists list'),
        'items_list_navigation' => __( 'Therapists list navigation'),
        'items_list'            => __( 'Therapists list'),
        'featured_image'        => __( 'Therapist featured image'),
        'set_featured_image'    => __( 'Set therapist featured image'),
        'remove_featured_image' => __( 'Remove therapist featured image'),
        'use_featured_image'    => __( 'Use as featured image'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_nav_menus'  => true,
        'show_in_admin_bar'  => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'therapists' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-groups',
        'supports'           => array( 'title', 'thumbnail', 'editor' ),
        'template'           => array( array( 'woocommerce/bookings-availability-schedule-block' ) ),
        'template_lock'      => 'all',
    );

    register_post_type( 'hhm-therapists', $args );

    // Add Testimonial CPT
    $labels = array(
        'name'               => _x( 'Testimonials', 'post type general name'  ),
        'singular_name'      => _x( 'Testimonial', 'post type singular name'  ),
        'menu_name'          => _x( 'Testimonials', 'admin menu'  ),
        'name_admin_bar'     => _x( 'Testimonial', 'add new on admin bar' ),
        'add_new'            => _x( 'Add New', 'testimonial' ),
        'add_new_item'       => __( 'Add New Testimonial' ),
        'new_item'           => __( 'New Testimonial' ),
        'edit_item'          => __( 'Edit Testimonial' ),
        'view_item'          => __( 'View Testimonial'  ),
        'all_items'          => __( 'All Testimonials' ),
        'search_items'       => __( 'Search Testimonials' ),
        'parent_item_colon'  => __( 'Parent Testimonials:' ),
        'not_found'          => __( 'No testimonials found.' ),
        'not_found_in_trash' => __( 'No testimonials found in Trash.' ),
    );
    
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'testimonials' ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 7,
        'menu_icon'          => 'dashicons-heart',
        'supports'           => array( 'title', 'editor'),
        'template'           => array( array( 'core/quote' ) ),
        'template_lock'      => 'all',
    );
    
    register_post_type( 'hhm-testimonial', $args );

}
add_action( 'init', 'fwd_register_custom_post_types' );


function fwd_register_taxonomies() {

    // Add therapist specialty taxonomy
    $labels = array(
        'name'              => _x( 'Specialties', 'taxonomy general name' ),
        'singular_name'     => _x( 'Specialty', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Specialties' ),
        'all_items'         => __( 'All Specialties' ),
        'parent_item'       => __( 'Parent Specialty' ),
        'parent_item_colon' => __( 'Parent Specialty:' ),
        'edit_item'         => __( 'Edit Specialty' ),
        'view_item'         => __( 'Vview Specialty' ),
        'update_item'       => __( 'Update Specialty' ),
        'add_new_item'      => __( 'Add New Specialty' ),
        'new_item_name'     => __( 'New Specialty Name' ),
        'menu_name'         => __( 'Specialty' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_menu'      => true,
        'show_in_nav_menu'  => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'specialties' ),
    );
    register_taxonomy( 'hhm-specialties', array( 'hhm-therapists' ), $args );

}
add_action( 'init', 'fwd_register_taxonomies');

function fwd_rewrite_flush() {
    fwd_register_custom_post_types();
    fwd_register_taxonomies();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'fwd_rewrite_flush' );