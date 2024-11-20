<?php
/*
Template Name: About Us
*/
?>

<?php get_header(); ?>


    <div class="container">
        <div class="content">
        <!-- Hero Section -->
        <section class="hero">
            <h1><?php esc_html_e( 'About Us', 'textdomain' ); ?></h1>
            <p><?php esc_html_e( 'We are a passionate team dedicated to creating amazing websites for our clients.', 'textdomain' ); ?></p>
        </section>

        <!-- Mission Section -->
        <section class="mission">
            <h2><?php esc_html_e( 'Our Mission', 'textdomain' ); ?></h2>
            <p><?php esc_html_e( 'Our mission is to help businesses establish a strong online presence through beautifully crafted and functional websites.', 'textdomain' ); ?></p>
        </section>

        <!-- Team Section -->
        <section class="team">
            <h2><?php esc_html_e( 'Meet Our Team', 'textdomain' ); ?></h2>
            <ul>
                <li><?php esc_html_e( 'John Doe - Lead Developer', 'textdomain' ); ?></li>
                <li><?php esc_html_e( 'Jane Smith - Designer', 'textdomain' ); ?></li>
                <li><?php esc_html_e( 'Alex Johnson - Project Manager', 'textdomain' ); ?></li>
            </ul>
        </section>

        <!-- Services Section -->
        <section class="services">
            <h2><?php esc_html_e( 'What We Do', 'textdomain' ); ?></h2>
            <ul>
                <li><?php esc_html_e( 'Custom Website Development', 'textdomain' ); ?></li>
                <li><?php esc_html_e( 'Responsive Design', 'textdomain' ); ?></li>
                <li><?php esc_html_e( 'E-commerce Solutions', 'textdomain' ); ?></li>
                <li><?php esc_html_e( 'SEO Optimization', 'textdomain' ); ?></li>
            </ul>
        </section>

        <!-- Contact Section -->
        <section class="contact">
            <h2><?php esc_html_e( 'Get In Touch', 'textdomain' ); ?></h2>
            <p><?php esc_html_e( 'Have a project in mind? Let talk!', 'textdomain' ); ?></p>
            <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn">
                <?php esc_html_e( 'Contact Us', 'textdomain' ); ?>
            </a>
        </section>

        <div class="custom-posts-section">
            <h2>ThePost's last three articles</h2>
            <?php echo do_shortcode('[thepost_list count="3"]'); ?>
         </div>



        </div>

        <?php get_sidebar(); ?>

    </div>


<?php get_footer(); ?>

<?php wp_footer(); ?>
