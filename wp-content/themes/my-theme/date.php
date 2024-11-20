

<?php get_header(); ?>

<div class="container">
    <div class="content">
    
    <div class="date-archive">
    <h1>
        <?php
        
        if (is_day()) {
            echo 'Archive for ' . get_the_date();
        } elseif (is_month()) {
            echo 'Archive for ' . get_the_date('F Y');
        } elseif (is_year()) {
            echo 'Archive for ' . get_the_date('Y');
        } else {
            echo 'Date Archive';
        }
        ?>
    </h1>

    <?php if (have_posts()) : ?>
        <ul class="date-archive-list">
            <?php while (have_posts()) : the_post(); ?>
                <li>
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    <span class="post-date"><?php the_date(); ?></span>
                </li>
            <?php endwhile; ?>
        </ul>

        <?php
        // Добавяне на странициране
        the_posts_pagination(array(
            'mid_size' => 2,
            'prev_text' => __('&laquo; Previous', 'my-theme'),
            'next_text' => __('Next &raquo;', 'my-theme'),
        ));
        ?>

    <?php else : ?>
        <p><?php esc_html_e('No posts found for this date.', 'my-theme'); ?></p>
    <?php endif; ?>
    </div>


    <?php wp_reset_postdata(); ?>
            
    </div>
    
    <?php get_sidebar(); ?>

</div>

    <?php get_footer(); ?>

    <?php wp_footer(); ?>


