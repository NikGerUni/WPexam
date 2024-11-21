<?php
// Enqueue parent theme styles
function my_child_theme_enqueue_styles() {
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    
    // Enqueue child theme styles
    wp_enqueue_style( 'child-style', get_stylesheet_uri(), array( 'parent-style' ), null );

    // Enqueue compiled-style.css if used in parent theme
    wp_enqueue_style( 'compiled-style', get_template_directory_uri() . '/css/compiled-style.css', array( 'parent-style' ), null );

}
add_action('wp_enqueue_scripts', 'my_child_theme_enqueue_styles');
