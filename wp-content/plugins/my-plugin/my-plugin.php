<?php
/*
Plugin Name: My Plugin
Description: My first plugin.
Version: 1.0
Author: Nikosoft
*/


function create_custom_post_type() {
    $labels = array(
        'name'                  => __( 'ThePost', 'mytheme' ),
        'singular_name'         => __( 'ThePost', 'mytheme' ),
        'menu_name'             => __( 'ThePost', 'mytheme' ),
        'name_admin_bar'        => __( 'ThePost', 'mytheme' ),
        'add_new'               => __( 'Add New', 'mytheme' ),
        'add_new_item'          => __( 'Add New ThePost', 'mytheme' ),
        'new_item'              => __( 'New ThePost', 'mytheme' ),
        'edit_item'             => __( 'Edit ThePost', 'mytheme' ),
        'view_item'             => __( 'View ThePost', 'mytheme' ),
        'all_items'             => __( 'All ThePost', 'mytheme' ),
        'search_items'          => __( 'Search ThePost', 'mytheme' ),
        'not_found'             => __( 'No thepost found.', 'mytheme' ),
        'not_found_in_trash'    => __( 'No thepost found in Trash.', 'mytheme' ),
        'featured_image'        => __( 'ThePost Image', 'mytheme' ),
        'set_featured_image'    => __( 'Set thepost image', 'mytheme' ),
        'remove_featured_image' => __( 'Remove thepost image', 'mytheme' ),
        'use_featured_image'    => __( 'Use as thepost image', 'mytheme' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'thepost' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
    );

    register_post_type( 'thepost', $args );
}

add_action( 'init', 'create_custom_post_type' );

// Регистрация на персонализирана таксономия
function register_thepost_taxonomy() {
    $labels = array(
        'name'              => 'Categories',
        'singular_name'     => 'Category',
        'search_items'      => 'Search Categories',
        'all_items'         => 'All Categories',
        'parent_item'       => 'Parent Category',
        'parent_item_colon' => 'Parent Category:',
        'edit_item'         => 'Edit Category',
        'update_item'       => 'Update Category',
        'add_new_item'      => 'Add New Category',
        'new_item_name'     => 'New Category Name',
        'menu_name'         => 'Categories',
    );

    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true, // True for categories, false for tags
        'public'            => true,
        'show_ui'           => true,
        'show_in_menu'      => true,
        'show_in_rest'      => true, // Enable Gutenberg
        'show_admin_column' => true,
        'rewrite'           => array('slug' => 'thepost-category'),
    );

    register_taxonomy('thepost_category', 'thepost', $args);
}

add_action('init', 'register_thepost_taxonomy');


// Добавяне на метабокс
function add_thepost_meta_box() {
    add_meta_box(
        'thepost_meta_box',           // ID на метабокса
        'Custom Option',               // Заглавие
        'render_thepost_meta_box',    // Callback функция за съдържанието
        'thepost',                    // Custom Post Type
        'normal',                      // Позиция
        'default'                      // Приоритет
    );
}

// Callback за съдържанието на метабокса
function render_thepost_meta_box($post) {
    // Вземане на запазената стойност
    $custom_value = get_post_meta($post->ID, '_thepost_custom_option', true);

    // Nonce за защита
    wp_nonce_field('thepost_meta_box_nonce', 'thepost_meta_box_nonce_field');

    // HTML за метабокса
    echo '<label for="thepost_custom_option">Enter your custom value:</label>';
    echo '<input type="text" id="thepost_custom_option" name="thepost_custom_option" value="' . esc_attr($custom_value) . '" style="width:100%;"/>';
}

// Запазване на стойността на метабокса
function save_thepost_meta_box($post_id) {
    // Проверка за валидност
    if (!isset($_POST['thepost_meta_box_nonce_field']) ||
        !wp_verify_nonce($_POST['thepost_meta_box_nonce_field'], 'thepost_meta_box_nonce')) {
        return;
    }

    // Проверка за автозапис
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Проверка за права
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Запазване на стойността
    if (isset($_POST['thepost_custom_option'])) {
        update_post_meta($post_id, '_thepost_custom_option', sanitize_text_field($_POST['thepost_custom_option']));
    }
}

// Хук за регистриране на CPT, таксономия и метабокс

add_action('add_meta_boxes', 'add_thepost_meta_box');
add_action('save_post', 'save_thepost_meta_box');

// -------------------------------------------------------------------

// Регистрация на настройките
function thepost_register_settings() {
    register_setting('thepost_settings_group', 'thepost_sidebar_option');
}
add_action('admin_init', 'thepost_register_settings');

// Добавяне на административна страница
function thepost_add_admin_page() {
    add_menu_page(
        'ThePost Settings',            // Заглавие на страницата
        'ThePost Options',             // Име в менюто
        'manage_options',               // Права за достъп
        'thepost_settings',            // Slug на страницата
        'thepost_settings_page',       // Callback функция
        'dashicons-admin-generic',      // Икона в менюто
        80                              // Позиция в менюто
    );
}
add_action('admin_menu', 'thepost_add_admin_page');

// Callback функция за съдържанието на административната страница
function thepost_settings_page() {
    ?>
    <div class="wrap">
        <h1>ThePost Settings</h1>
        <form method="post" action="options.php">
            <?php settings_fields('thepost_settings_group'); ?>
            <?php do_settings_sections('thepost_settings_group'); ?>
            
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Show Sidebar</th>
                    <td>
                        <input type="checkbox" name="thepost_sidebar_option" value="1" <?php checked(1, get_option('thepost_sidebar_option'), true); ?> />
                        <label for="thepost_sidebar_option">Check to display the sidebar</label>
                    </td>
                </tr>
            </table>
            
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// Добавяне на CSS за скриване на sidebar
function thepost_toggle_sidebar_visibility() {
    $show_sidebar = get_option('thepost_sidebar_option'); // Проверка на опцията

    // Ако опцията е изключена, добавя CSS за скриване на sidebar
    if (!$show_sidebar) {
        echo '<style>
            .sidebar {
                display: none !important;
            }
        </style>';
    }
}
add_action('wp_head', 'thepost_toggle_sidebar_visibility');

// Филтър за манипулиране на заглавието
function thepost_custom_title($title, $post_id) {
    // Проверка дали е "thepost" и дали не сме в администраторския панел
    if (get_post_type($post_id) === 'thepost' && !is_admin()) {
        $custom_prefix = 'ThePost: ';
        return $custom_prefix . $title;
    }

    return $title;
}
add_filter('the_title', 'thepost_custom_title', 10, 2);

// Регистрация на кратък код
function thepost_shortcode($atts) {
    // Задаване на атрибути по подразбиране
    $atts = shortcode_atts(array(
        'count' => 5, // Брой публикации по подразбиране
    ), $atts, 'thepost_list');

    // WP_Query за извличане на публикации от Custom Post Type
    $query = new WP_Query(array(
        'post_type'      => 'thepost',
        'posts_per_page' => intval($atts['count']),
    ));

    // Генериране на HTML
    if ($query->have_posts()) {
        $output = '<ul class="thepost-list">';
        while ($query->have_posts()) {
            $query->the_post();
            $output .= '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
        }
        $output .= '</ul>';
    } else {
        $output = '<p>No posts found.</p>';
    }

    wp_reset_postdata();

    return $output;
}
add_shortcode('thepost_list', 'thepost_shortcode');

// Кратък код - създава падащо меню за категориите и да зареди публикациите с AJAX:
function thepost_ajax_filter_shortcode() {
    // Вземане на всички категории за таксономията "thepost_category"
    $categories = get_terms(array(
        'taxonomy' => 'thepost_category',
        'hide_empty' => true,
    ));

    ob_start();
    ?>
    <div id="thepost-ajax-filter">
        <label for="thepost-category">Filter by Category:</label>
        <select id="thepost-category">
            <option value="all">All Categories</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?php echo esc_attr($category->slug); ?>">
                    <?php echo esc_html($category->name); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <div id="thepost-results">
            <!-- Публикациите ще се зареждат тук -->
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('thepost_ajax_filter', 'thepost_ajax_filter_shortcode');


// Обработва избора в падащото меню и изпраща заявката към WordPress:
function thepost_enqueue_scripts() {
    // Регистрация на JavaScript файл
    wp_enqueue_script('thepost-ajax-script', plugins_url('thepost-ajax.js', __FILE__), array('jquery'), null, true);

    // Локализиране на AJAX URL
    wp_localize_script('thepost-ajax-script', 'thepost_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
    ));
}
add_action('wp_enqueue_scripts', 'thepost_enqueue_scripts');

//Обработва AJAX заявката и връща публикациите:

function thepost_ajax_filter() {
    $category = $_POST['category'];

    $args = array(
        'post_type' => 'thepost',
        'posts_per_page' => -1,
    );

    if ($category !== 'all') {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'thepost_category',
                'field' => 'slug',
                'terms' => $category,
            ),
        );
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            echo '<div class="thepost-item">';
            echo '<h2><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
            echo '</div>';
        }
    } else {
        echo '<p>No posts found.</p>';
    }

    wp_die();
}
add_action('wp_ajax_thepost_filter', 'thepost_ajax_filter');
add_action('wp_ajax_nopriv_thepost_filter', 'thepost_ajax_filter');







