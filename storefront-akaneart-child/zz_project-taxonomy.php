<?php
/*
* Plugin Name: Project Taxonomy
* Description: A short example showing how to add a taxonomy called Artwork.
* Version: 1.0
* Author: developer.wordpress.org
* Author URI: https://codex.wordpress.org/User:Aternus
*/

function wporg_register_taxonomy_Project() {
	 $labels = array(
		 'name'              => _x( 'Projects', 'taxonomy general name' ),
		 'singular_name'     => _x( 'Project', 'taxonomy singular name' ),
		 'search_items'      => __( 'Search Projects' ),
		 'all_items'         => __( 'All Projects' ),
		 'parent_item'       => __( 'Parent Project' ),
		 'parent_item_colon' => __( 'Parent Project:' ),
		 'edit_item'         => __( 'Edit Project' ),
		 'update_item'       => __( 'Update Project' ),
		 'add_new_item'      => __( 'Add New Project' ),
		 'new_item_name'     => __( 'New Project Name' ),
		 'menu_name'         => __( 'Project' ),
	 );
	 $args   = array(
		 'hierarchical'      => true, // make it hierarchical (like categories)
		 'labels'            => $labels,
		 'show_ui'           => true,
		 'show_admin_column' => true,
		 'query_var'         => true,
		 'rewrite'           => [ 'slug' => 'Project' ],
	 );
	 register_taxonomy( 'Project', [ 'post' ], $args );
}
add_action( 'init', 'wporg_register_taxonomy_Project' );
?>
