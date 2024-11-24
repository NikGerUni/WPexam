<?php

function simple_theme_setup() {
    register_nav_menus(
        array(
			'main-menu' => __( 'Main Menu', 'my-theme' ),
        )
    );
    add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'simple_theme_setup' );

function simple_theme_enqueue_styles() {
    wp_enqueue_style( 'main-style', get_stylesheet_uri() );
    wp_enqueue_style( 'custom-style', get_template_directory_uri() . '/css/compiled-style.css', array( 'main-style' ), null );
    wp_enqueue_script( 'main-script', get_template_directory_uri() . '/main.js', array(), null, true );
}
add_action( 'wp_enqueue_scripts', 'simple_theme_enqueue_styles' );

function simple_theme_register_sidebar() {
    register_sidebar(
        array(
			'name'          => __( 'Main Sidebar', 'my-theme' ), 
			'id'            => 'main-sidebar', 
			'description'   => __( 'This is the main sidebar for the theme.', 'my-theme' ), 
			'before_widget' => '<div id="%1$s" class="widget %2$s">', 
			'after_widget'  => '</div>', 
			'before_title'  => '<h3 class="widget-title">', 
			'after_title'   => '</h3>', 
        )
    );
}
add_action( 'widgets_init', 'simple_theme_register_sidebar' );

add_filter(
    'redirect_canonical',
    function ( $redirect_url ) {
        if ( strpos( $redirect_url, '/?paged=' ) !== false ) {
            $redirect_url = str_replace( '/?paged=', '/page/', $redirect_url );
        }
        return $redirect_url;
    }
);

function handle_contact_form() {
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = sanitize_text_field($_POST['name']);
        $email = sanitize_email($_POST['email']);
        $message = sanitize_textarea_field($_POST['message']);
        
        wp_redirect(home_url('/'));
        exit;
    }
}
add_action('admin_post_handle_contact_form', 'handle_contact_form');
add_action('admin_post_nopriv_handle_contact_form', 'handle_contact_form');

