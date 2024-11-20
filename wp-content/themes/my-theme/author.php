

<?php get_header(); ?>

<div class="container">
    <div class="content">
    <div class="author-archive">
    <h1>Posts by <?php echo get_the_author(); ?></h1>

    <div class="author-info">
        <?php
        // Информация за автора
        $author_id = get_the_author_meta('ID');
        echo get_avatar($author_id, 96); // Аватар на автора
        ?>
        
        <h2><?php the_author(); ?></h2>
        
        <?php if (get_the_author_meta('description')) : ?>
            <p><?php the_author_meta('description'); ?></p>
        <?php endif; ?>
    </div>

    <?php if (have_posts()) : ?>
        <ul class="author-posts-list">
            <?php while (have_posts()) : the_post(); ?>
                <li>
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <div class="post-meta">
                        <span>Published on: <?php echo get_the_date(); ?></span>
                    </div>
                    <div class="post-excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                </li>
            <?php endwhile; ?>
        </ul>

        

    <?php else : ?>
        <p><?php esc_html_e('No posts found by this author.', 'my-theme'); ?></p>
    <?php endif; 
    
    
    wp_reset_postdata(); ?>
       
 
            
    </div>
    </div>

    <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>

<?php wp_footer(); ?>


