<?php get_header(); ?>

      <div class="container">
    <div class="content">
      <?php
        if ( have_posts() ) :
            while ( have_posts() ) :
                the_post();
                the_title( '<h1>', '</h1>' );
                the_content();
          endwhile;
      else :
          echo '<p>No content found</p>';
      endif;
        ?>
    </div>

    <div class="sidebar">
      <?php if ( is_active_sidebar( 'main-sidebar' ) ) : ?>
            <?php dynamic_sidebar( 'main-sidebar' ); ?>
      <?php else : ?>
        <p>Add widgets to the sidebar</p>
      <?php endif; ?>
    </div>
  </div>

    <?php get_footer(); ?>

    <?php wp_footer(); ?>
