This is a solution to an exam assignment for a web project for a WordPress site.
It contains only the wp-content folder.
There is one theme—My theme, one child theme—My child theme, and one plugin—My plugin, all developed from scratch. The ACF plugin is external but is used in the project.

The project represents a simple blog site minimally demonstrating the general and bonus requirements of the client, focusing on functionality rather than design. It follows WordPress coding standards.

GitHub: https://github.com/NikGerUni/WPexam.git
Live Demo: https://mag.nikosoft.eu/mag


Details of the solutions for the theme:

The theme has a basic design—header, footer, content, and sidebar—present in all templates.
The header includes the main menu.
The sidebar contains a search widget, a My post link showing the archive of the currently registered user, and a form for entering a year and month to display the archive of posts for that month.
The site has a Custom Home Page that by default displays all posts and demonstrates a Custom Post's AJAX filter by Category.
All requirements of the exam assignment have been met.


Details of the solutions for the plugin:

Registers a Custom Post Type named ThePost.
Has a custom taxonomy attached to ThePost named Categories.
Includes a compilation of a metabox in ThePost titled Custom Option, using custom WP functions.
Has a metabox/field on the dashboard registered with ACF—FieldGroup1/Custom code.
Provides a ThePost Options page with a custom option—a checkbox that shows/hides the sidebar.
Implements AJAX functionality for dynamically displaying custom posts for a specific category.
Registers a shortcode [thepost_list count="3"] for ThePost's last three articles (see aboutus.php).
Includes a filter that manipulates the titles of custom posts by adding the text "The Post: ".
The project uses an activated debugging methodology. The wp-config.php is configured as follows:

define('WP_DEBUG', false);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);
@ini_set('display_errors', 0);
There is a 404.php page.

About bonuses:

The project is uploaded to GitHub: https://github.com/NikGerUni/WPexam.git
The project is hosted on a demo server: https://mag.nikosoft.eu/mag
There is a demo Sass setup for styles.
There is a child theme My Child Theme that changes the background color of the header.
The code in functions.php of My Child Theme is written in OOP style.