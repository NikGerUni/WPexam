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
        while ( have_posts() ) : the_post(); ?>
            <h1 class="custom-h1"><?php the_title(); ?></h1>
            <div class="post-content">
                <?php the_content(); ?>
            </div>
            <div class="post-meta">
            <p>-------------------------</p>
                <p>Published on: <?php the_date(); ?> by <?php the_author(); ?></p>
                <p>Categories: <?php the_category( ', ' ); ?></p>
                
                <p><?php the_tags(); ?></p>
            </div>
            <div class="custom-code">
            <?php
            // Вземане на стойността на ACF полето
            $custom_code = get_field('custom_code');

            if (!empty($custom_code)) {
                echo '<p><strong>Custom Code:</strong> ' . esc_html($custom_code) . '</p>';
            } else {
                echo '<p>No custom code provided.</p>';
            }
            ?>
        </div>
        <?php endwhile;
    else : ?>
        <p><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'my-theme' ); ?></p>
    <?php endif; ?>
  
    </div>
    <?php 
          get_sidebar(); // Зареждане на страничната лента
    ?>
</div>

<?php get_footer(); ?>

<?php wp_footer(); ?>
