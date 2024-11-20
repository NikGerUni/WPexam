<?php
/*
Template Name: View all Custom Posts
*/
?>

<?php get_header(); ?>

<div class="container">
    <div class="content">
        <?php
        global $wp_query;
        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

        $args = array(
            'post_type'      => 'thepost',
            'posts_per_page' => 4,
            'paged'          => $paged,
        );

        $query = new WP_Query( $args );

        if ( $query->have_posts() ) :
            while ( $query->have_posts() ) :
                $query->the_post();
                ?>
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <?php the_excerpt(); ?>
            <?php endwhile; ?>

            <!-- Pagination -->
            <?php
            echo paginate_links(
                array(
					'total'     => $query->max_num_pages,
					'current'   => $paged,
					'format'    => '/page/%#%',
					'prev_text' => __( '&laquo; Previous', 'textdomain' ),
					'next_text' => __( 'Next &raquo;', 'textdomain' ),
                )
            );
            ?>

        <?php else : ?>
            <p><?php esc_html_e( 'No posts found.', 'textdomain' ); ?></p>
        <?php endif; ?>

        <?php wp_reset_postdata(); ?>
    </div>

    <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>

<?php wp_footer(); ?>
