<?php
/*
  Plugin Name: WP Questions
  Plugin URI: -
  Description: Question and Answer interface for developers
  Version: 1.0
  Author: Rakhitha Nimesh
  Author URI: http://www.innovativephp.com/
  License: GPLv2 or later
*/

add_action('init', 'register_wp_questions');

/*
* Register new custom post type for questions
*
* @return void
*/
function register_wp_questions() {

    $labels = array(
            'name'                  => __( 'Questions', 'wp_question' ),
            'singular_name'         => __( 'Question', 'wp_question' ),
            'add_new'               => __( 'Add New', 'wp_question' ),
            'add_new_item'          => __( 'Add New Question', 'wp_question' ),
            'edit_item'             => __( 'Edit Questions', 'wp_question' ),
            'new_item'              => __( 'New Question', 'wp_question' ),
            'view_item'             => __( 'View Question', 'wp_question' ),
            'search_items'          => __( 'Search Questions', 'wp_question' ),
            'not_found'             => __( 'No Questions found', 'wp_question' ),
            'not_found_in_trash'    => __( 'No Questions found in Trash', 'wp_question' ),
            'parent_item_colon'     => __( 'Parent Question:', 'wp_question' ),
            'menu_name'             => __( 'Questions', 'wp_question' ),
    );

    $args = array(
            'labels'                => $labels,
            'hierarchical'          => true,
            'description'           => __( 'Questions and Answers', 'wp_question' ),
            'supports'              => array( 'title', 'editor', 'comments' ),
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'show_in_nav_menus'     => true,
            'publicly_queryable'    => true,
            'exclude_from_search'   => false,
            'has_archive'           => true,
            'query_var'             => true,
            'can_export'            => true,
            'rewrite'               => true,
            'capability_type'       => 'post'
    );

    register_post_type( 'wp_question', $args );
}
