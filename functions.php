<?php

/**
 * Storefront automatically loads the core CSS even if using a child theme as it is more efficient
 * than @importing it in the child theme style.css file.
 *
 * Uncomment the line below if you'd like to disable the Storefront Core CSS.
 *
 * If you don't plan to dequeue the Storefront Core CSS you can remove the subsequent line and as well
 * as the sf_child_theme_dequeue_style() function declaration.
 */
//add_action( 'wp_enqueue_scripts', 'sf_child_theme_dequeue_style', 999 );

/**
 * Dequeue the Storefront Parent theme core CSS
 */
function sf_child_theme_dequeue_style() {
    wp_dequeue_style( 'storefront-style' );
    wp_dequeue_style( 'storefront-woocommerce-style' );
}

/** 
 * Note: DO NOT! alter or remove the code above this text and only add your custom PHP functions below this text.
 */
function create_artwork_post() {
    register_post_type( 'artwork_post',
    array(
        'labels' => array (
            'name' => 'Artwork',
            'add_new' => 'Add New',
            'add_new_item' => 'Add New Artwork',
            'edit' => 'Edit',
            'edit_item' => "Edit Artwork",
            'new_item' => 'New Artwork',
            'view' => 'View',
            'view_item' => 'View Artwork',
            'search_items' => 'Search Artwork',
            'not_found' => 'No Artwork found',
            'not_found_in_trash' => 'No Artwork found in Trash',
            'parent' => 'Parent Artwork'
        ),
        'public' => true,
        'menu_position' => 15,
        'has_archive' => true,
        'rewrite' => array( 'slug' => 'artwork'), //produces a custom slug term
        'show_in_rest' => true,
        'supports' => array( 'title', 'editor', 'featured-image', 'custom-fields', 'author', 'thumbnail', 'comments', 'revisions', 'post-formats', 'admin_column' )
    )
    );
}
add_action( 'init', 'create_artwork_post');

function artpost_taxonomy() {

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
        'menu_name'         => __( 'Projects' ),
    );
    $args   = array(
        'labels'            => $labels,
        'hierarchical'      => true, // make it hierarchical (like categories)
        'public'            => true,
        'show_in_rest'      => true, //add support for Gutenberg editor
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_tagcloud'     => false,
        'query_var'         => true,
        'rewrite'           => [ 'slug' => '/', 'with_front' => false ]
    );
    register_taxonomy( 'project', [ 'artwork_post' ], $args );
}
add_action( 'init', 'artpost_taxonomy' );

function material_taxonomy() {
    $labels = array(
        'name'              => _x( 'Materials', 'taxonomy general name' ),
        'singular_name'     => _x( 'Material', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Materials' ),
        'all_items'         => __( 'All Materials' ),
        'parent_item'       => __( 'Parent Material' ),
        'parent_item_colon' => __( 'Parent Material:' ),
        'edit_item'         => __( 'Edit Material' ),
        'update_item'       => __( 'Update Material' ),
        'add_new_item'      => __( 'Add New Material' ),
        'new_item_name'     => __( 'New Material Name' ),
        'menu_name'         => __( 'Materials' ),
    );
    $args   = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'public'            => true,
        'show_in_rest'      => true, //add support for Gutenberg editor
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_tagcloud'     => false,
        'query_var'         => true,
        'rewrite'           => [ 'slug' => '/', 'with_front' => false ]
    );
    register_taxonomy( 'material', [ 'artwork_post' ], $args );
}
add_action( 'init', 'material_taxonomy' );

function software_taxonomy() {
    $labels = array(
        'name'              => _x( 'Software', 'taxonomy general name' ),
        'singular_name'     => _x( 'Software', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Software' ),
        'all_items'         => __( 'All Software' ),
        'parent_item'       => __( 'Parent Software' ),
        'parent_item_colon' => __( 'Parent Software:' ),
        'edit_item'         => __( 'Edit Software' ),
        'update_item'       => __( 'Update Software' ),
        'add_new_item'      => __( 'Add New Software' ),
        'new_item_name'     => __( 'New Software Name' ),
        'menu_name'         => __( 'Software' ),
    );
    $args   = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'public'            => true,
        'show_in_rest'      => true, //add support for Gutenberg editor
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_tagcloud'     => false,
        'query_var'         => true,
        'rewrite'           => [ 'slug' => '/', 'with_front' => false ]
    );
    register_taxonomy( 'software', [ 'artwork_post' ], $args );
}
add_action( 'init', 'software_taxonomy' );

add_filter( 'template_include', 'include_template_function', 1 );

add_action( 'admin_init', 'my_admin' );
function my_admin() {
    add_meta_box( 'artwork_post_meta_box',
        'Artwork Details',
        'display_artwork_post_meta_box',
        'artwork_post', 'normal', 'high'
    );
}
?>
<?php
function display_artwork_post_meta_box( $artwork_post) {
    //Retrieve details of the artwork post like year and materials
    $release_time = esc_html( get_post_meta ($artwork_post->ID, 'release_time', true) );
?>
<table>
    <tr>
        <td style="width: 100%">Completed:</td>
        <td><input type="text" size="80" name="artwork_post_release_time" value="<?php echo $release_time; ?>" /></td>
    </tr>
    <tr>
        <td style="width: 100%">Watch it:</td>
        <td><input type="text" size="80" name="artwork_post_YT_video" value="<?php echo $YT_video; ?>" /></td>
    </tr>
</table>
<?php
}
add_action( 'save_post', 'add_artowrk_post_fields', 10, 2 );
function add_artowrk_post_fields( $artwork_post_id, $artwork_post ) {
    //Check post type for artwork
    if ( $artwork_post->post_type == 'artwork_post' ) {
        //Store data in post meta table if present in post data
        if ( isset( $_POST['artwork_post_release_time']) && $_POST['artwork_post_release_time'] != '' ) {
            update_post_meta( $artwork_post_id, 'release_time', $_POST['artwork_post_release_time'] );
        }
        if ( isset( $_POST['artwork_post_YT_video']) && $_POST['artwork_post_YT_video'] != '' ) {
            update_post_meta( $artwork_post_id, 'YT_video', $_POST['artwork_post_YT_video'] );
        }
    }
}
function include_template_function( $template_path) {
    if ( get_post_type() == 'artwork_post' ) {
        if ( is_single() ) {
            //checks if the file exists in the theme first,
            //otherwise serve the file from the plugin
            if ( $theme_file = locate_template( array ( 'single_artwork_post.php' ))) {
                $template_path = $theme_file;
            } else {
                $template_path = plugin_dir_path( _FILE_ ) . '/single_artwork_post.php';
            }
            }
        }
        return $template_path;
    }
?>