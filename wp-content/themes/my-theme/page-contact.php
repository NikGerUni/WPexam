<?php
/*
Template Name: Contact Page
*/
?>

<?php get_header(); ?>

<div class="container">
    <div class="content">
    <h1 style="text-align: center;">Contact Us</h1>

        <form class="contact-form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="POST">
            <input type="hidden" name="action" value="handle_contact_form">
            <label for="name">Your Name</label>
            <input type="text" id="name" name="name" required placeholder="Enter your name">
            
            <label for="email">Your Email</label>
            <input type="email" id="email" name="email" required placeholder="Enter your email">
            
            <label for="message">Your Message</label>
            <textarea id="message" name="message" rows="5" required placeholder="Write your message here"></textarea>
            
            <button type="submit">Send Message</button>
        </form>
    </div>
    <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>

<?php wp_footer(); ?>

