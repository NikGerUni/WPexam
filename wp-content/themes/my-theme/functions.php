<?php
// Регистриране на меню
function simple_theme_setup() {
    register_nav_menus(
        array(
			'main-menu' => __( 'Main Menu', 'my-theme' ),
        )
    );
    add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'simple_theme_setup' );

// Зареждане на стилове и скриптове
function simple_theme_enqueue_styles() {
    wp_enqueue_style( 'main-style', get_stylesheet_uri() );
    wp_enqueue_style( 'custom-style', get_template_directory_uri() . '/custom.css', array( 'main-style' ), null );
    wp_enqueue_script( 'main-script', get_template_directory_uri() . '/main.js', array(), null, true );
}
add_action( 'wp_enqueue_scripts', 'simple_theme_enqueue_styles' );


// Регистрация на странична лента (Sidebar)
function simple_theme_register_sidebar() {
    register_sidebar(
        array(
			'name'          => __( 'Main Sidebar', 'my-theme' ), // Име на страничната лента
			'id'            => 'main-sidebar', // Уникален идентификатор
			'description'   => __( 'This is the main sidebar for the theme.', 'my-theme' ), // Описание
			'before_widget' => '<div id="%1$s" class="widget %2$s">', // HTML преди всеки widget
			'after_widget'  => '</div>', // HTML след всеки widget
			'before_title'  => '<h3 class="widget-title">', // HTML преди заглавието на widget
			'after_title'   => '</h3>', // HTML след заглавието на widget
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
