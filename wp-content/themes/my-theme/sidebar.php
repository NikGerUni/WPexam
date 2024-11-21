<?php
/**
 * Sidebar template with custom "My Posts" link and date archive form.
 */
?>

<div class="sidebar">
    <!-- Custom "My Posts" link -->
    <div class="myposts">
        <a href="<?php echo esc_url( add_query_arg( 'author_name', wp_get_current_user()->user_nicename, home_url( '/' ) ) ); ?>">
            <?php esc_html_e( 'My Posts', 'textdomain' ); ?>
        </a>
    </div>

    <!-- Dynamic Sidebar -->
    <?php if ( is_active_sidebar( 'main-sidebar' ) ) : ?>
        <?php dynamic_sidebar( 'main-sidebar' ); ?>
    <?php else : ?>
        <p><?php esc_html_e( 'Add widgets to the sidebar.', 'textdomain' ); ?></p>
    <?php endif; ?>

    <!-- Date Archive Form -->
    <div class="date-archive-form">
        <form action="<?php echo   home_url( '/' )  ; ?>" method="get" onsubmit="return goToArchive();">
            <div>
                <label for="year"><?php esc_html_e( 'Year:', 'textdomain' ); ?></label>
                <input 
                    type="number" 
                    id="year" 
                    name="year" 
                    min="2023" 
                    max="<?php echo esc_attr( date( 'Y' ) ); ?>" 
                    required 
                />
            </div>
            <div>
                <label for="month"><?php esc_html_e( 'Month:', 'textdomain' ); ?></label>
                <select id="month" name="month" required>
                    <option value="01"><?php esc_html_e( 'January', 'textdomain' ); ?></option>
                    <option value="02"><?php esc_html_e( 'February', 'textdomain' ); ?></option>
                    <option value="03"><?php esc_html_e( 'March', 'textdomain' ); ?></option>
                    <option value="04"><?php esc_html_e( 'April', 'textdomain' ); ?></option>
                    <option value="05"><?php esc_html_e( 'May', 'textdomain' ); ?></option>
                    <option value="06"><?php esc_html_e( 'June', 'textdomain' ); ?></option>
                    <option value="07"><?php esc_html_e( 'July', 'textdomain' ); ?></option>
                    <option value="08"><?php esc_html_e( 'August', 'textdomain' ); ?></option>
                    <option value="09"><?php esc_html_e( 'September', 'textdomain' ); ?></option>
                    <option value="10"><?php esc_html_e( 'October', 'textdomain' ); ?></option>
                    <option value="11"><?php esc_html_e( 'November', 'textdomain' ); ?></option>
                    <option value="12"><?php esc_html_e( 'December', 'textdomain' ); ?></option>
                </select>
            </div>
            <button type="submit"><?php esc_html_e( 'View Posts', 'textdomain' ); ?></button>
        </form>
    </div>




</div>
