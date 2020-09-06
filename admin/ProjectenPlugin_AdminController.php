<?php
/**
* This Admin controller file provide functionality for the Admin section of the
* My event organiser.
*
* @author Sam Tieman
* @version 0.1
*
* Version history
* 0.1 Sam Tieman Initial version
*/
class ProjectenPlugin_AdminController {

    /**
    * This function will prepare all Admin functionality for the plugin
    */
    static function prepare() {
        // Check that we are in the admin area
        if( is_admin() ) :
            // Add the sidebar Menu structure
            add_action( 'admin_menu', array( 'ProjectenPlugin_AdminController','addMenus' ) );
        endif;
    }

    /**
    * Add the Menu structure to the Admin sidebar
    */
    static function addMenus() {
        add_menu_page(
            // string $page_title The text to be displayed in the title tags
            // of the page when the menu is selected
            __( 'Projecten plugin Admin', 'projecten-plugin'),
            // string $menu_title The text to be used for the menu
            __( 'Projecten plugin', 'projecten-plugin' ),
            // string $capability The capability required for this menu to be displayed to the user.
            'manage_options',
            // string $menu_slug The slug name to refer to this menu by (should be unique for this menu)
            'projecten plugin',
            // callback $function The function to be called to output the content for this page.
            array( 'ProjectenPlugin_AdminController', 'adminMenuPage'),
            // string $icon_url The url to the icon to be used for this menu.
            // * Pass a base64-encoded SVG using a data URI, which will becolored to match the color scheme.
            // This should begin with 'data:image/svg+xml;base64,'.
            // * Pass the name of a Dashicons helper class to use a fonticon, e.g.
            'dashicons-chart-pie'.
            // * Pass 'none' to leave div.wp-menu-image empty so an icon can be added via CSS.
            PROJECTEN_PLUGIN_INCLUDES_IMGS_DIR. '/icon.png'
            // int $position The position in the menu order this one should  appear
        );
        add_submenu_page(
            // string $parent_slug The slug name for the parent menu
            // (or the file name of a standard WordPress admin page)
            'projecten-plugin-admin',
            // string $page_title The text to be displayed in the title tags of the page when the menu is selected
            __( 'Projecten', 'projecten-plugin' ),
            // string $menu_title The text to be used for the menu
            __( 'Projecten', 'projecten-plugin'),
            // string $capability The capability required for this menu to be displayed to the user.
            'manage_options',
            // string $menu_slug The slug name to refer to this menu by (should be unique for this menu)
            'pp_admin_projecten',
            // callback $function The function to be called to output the content for this page.
            array( 'ProjectenPlugin_AdminController', 'adminSubMenuProjecten' )

        );    
    }
    /**
    * The main menu page
    */
    static function adminMenuPage() {
        // Include the view for this menu page.
        include PROJECTEN_PLUGIN_ADMIN_VIEWS_DIR . '/admin_main.php';
    }
    /**
    * The submenu page for the event categories
    */
    static function adminSubMenuProjecten() {
        // include the view for this submenu page.
        include PROJECTEN_PLUGIN_ADMIN_VIEWS_DIR . '/pp_admin_projecten.php';
    }

}
?>