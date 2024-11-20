<?php
/**
 * Template Name: Single Custom Post
 */
?>
<?php get_header(); ?>

<div class="container">
    <div class="content">
    <?php
    if ( have_posts() ) :
        while ( have_posts() ) :
            the_post();
            ?>
            <h1 class="custom-hh1"><?php the_title(); ?></h1>
            <div class="post-content">
                <?php the_content(); ?>
            </div>
            <div class="post-meta">
            <p>---------</p>
                <p>Published on: <?php the_date(); ?> by <?php the_author(); ?></p>
            <!--    <p>Categories: <?php the_category( ', ' ); ?></p>   -->


            
            <div class="taxonomy-terms">
            <h3>Categories:</h3>
            <?php
            // Вземане на термините от таксономията "theposts_category"
            $terms = get_the_terms( get_the_ID(), 'thepost_category' );

            if ( $terms && ! is_wp_error( $terms ) ) :
                echo '<ul>';
                foreach ( $terms as $term ) :
                    echo '<li><a href="' . esc_url( get_term_link( $term ) ) . '">' . esc_html( $term->name ) . '</a></li>';
                endforeach;
                echo '</ul>';
            else :
                echo '<p>No categories assigned.</p>';
            endif;

            $custom_option = get_post_meta( get_the_ID(), '_thepost_custom_option', true );
            if ( ! empty( $custom_option ) ) {
                echo '<p><strong>Custom Option:</strong> ' . esc_html( $custom_option ) . '</p>';
            }
            ?>

        </div>



                <p><?php the_tags(); ?></p>
            </div>
            <?php
        endwhile;
    else :
        ?>
        <p><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'mytheme' ); ?></p>
    <?php endif; ?>
  
    </div>

    <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>

<?php wp_footer(); ?>
