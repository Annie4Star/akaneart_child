<?php
/*Template Name: New Template
*/
get_header(); ?>
<div id="primary">
    <div id="content" role="main">
    <?php
    $mypost = array( 'post_type' => 'artwork_post', );
    $loop = new WP_Query( $mypost );
    ?>
    <?php while ( $loop->have_posts() ) : $loop->the_post();?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
                
            </header>
            <!-- Display featured image in left aligned floating div -->
            <div style="float: left; margin-right: 2em">
                    <?php the_post_thumbnail( array (700, 700) ); ?>
                </div>
                <div style="font-family: 'Amatic SC', cursive; font-size: 3em; line-height: 1; padding-bottom: .25em "><?php the_title(); ?></div>
                <strong>Completed: </strong>
                <?php echo esc_html( get_post_meta( get_the_ID(), 'release_time', true) ); ?>
                <br />
                <strong>Project: </strong>
                <?php
                $terms = wp_get_post_terms($post->ID, 'project');
                if ( Is_array( $terms ) ) {
                    foreach ($terms as $term) {
                    echo $term->name;
                    }
                }
                ?>
                <br />
                <strong>Materials: </strong>
                <?php
                $terms = wp_get_post_terms($post->ID, 'material', $before = '', $sep = ', ', $after = '' );
                if ( Is_array( $terms ) ) {
                    foreach ($terms as $term) {
                    echo $term->name, $before, $sep, $after;
                    }
                }
                ?>
                <br />
                <strong>Software: </strong>
                <?php
                $terms = wp_get_post_terms($post->ID, 'software', $before = '', $sep = ', ', $after = '');
                if ( Is_array( $terms ) ) {
                    foreach ($terms as $term) {
                    echo $term->name, $before, $sep, $after;
                    }
                }
                ?>
                <br />
            <div class="entry-conent"><?php the_content(); ?></div>
        </article>
<?php endwhile; ?>
</div>
</div>
<?php wp_reset_query(); ?>