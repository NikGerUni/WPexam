<?php
class MyChildTheme {
    public function __construct() {
        // Hook into WordPress to enqueue styles
        add_action('wp_enqueue_scripts', [$this, 'my_child_theme_enqueue_styles']);
    }

    public function my_child_theme_enqueue_styles() {
        // Enqueue parent theme styles
        wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');

        // Enqueue compiled-style.css if used in parent theme
        wp_enqueue_style('compiled-style', get_template_directory_uri() . '/css/compiled-style.css', ['parent-style'], null);

        // Enqueue child theme styles
        wp_enqueue_style('child-style', get_stylesheet_uri(), ['parent-style'], null);
      
    }
}    

// Initialize the class
new MyChildTheme();
