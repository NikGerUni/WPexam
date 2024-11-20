<?php
/*
Template Name: Custom Home Page
*/
?>

<?php get_header(); ?>

<div class="container">
    <div class="content">
        <?php
        global $wp_query;
        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

        $args = array(
            'post_type'      => 'post',
            'posts_per_page' => 4,
            'paged'          => $paged,
        );

        $query = new WP_Query( $args );
        $temp_query = $wp_query;
        $wp_query = $query;

        if ( $query->have_posts() ) :
            while ( $query->have_posts() ) : $query->the_post(); ?>
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <?php the_excerpt(); ?>
            <?php endwhile; ?>

            <!-- Pagination -->
            <?php the_posts_pagination( array(
                'mid_size'  => 2,
                'prev_text' => __( '&laquo; Previous', 'my-theme' ),
                'next_text' => __( 'Next &raquo;', 'my-theme' ),
            ) ); ?>

        <?php else : ?>
            <p><?php esc_html_e( 'No posts found.', 'my-theme' ); ?></p>
        <?php endif; ?>

        <?php
        $wp_query = $temp_query;
        wp_reset_postdata();
        ?>

        <div class="ajax-filter">
            <h2>Custom Post's AJAX filter</h2>
            <?php echo do_shortcode('[thepost_ajax_filter]'); ?>
        </div>

    </div>

    <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>

<?php wp_footer(); ?>
