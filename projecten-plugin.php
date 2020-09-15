<?php

/**
 * Plugin Name: Projecten-plugin
 * Plugin URI: samtieman.com
 * Description: This plugin will help organise projects on your website
 * Author: Samuel W.R. Tieman
 * Author URI: samtieman.com
 * Version: 0.0.1
 * Text Domain: projecten-plugin
 * Domain Path: languages
 *
 * This is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with your plugin. If not, see <http://www.gnu.org/licenses/>.
 */

// Define the plugin name:
define('PROJECTEN_PLUGIN', __FILE__);

// Include the general definition file:
require_once plugin_dir_path(__FILE__) . 'includes/defs.php';

require_once PROJECTEN_PLUGIN_MODEL_DIR . '/project.php';
register_activation_hook(__FILE__, array('ProjectenPlugin', 'on_activation'));
class ProjectenPlugin
{
    private $project = "";

    public function __construct()
    {
        // Fire a hook before the class is setup.
        do_action('projecten_plugin_pre_init');
        // Load the plugin.
        add_action('init', array($this, 'init'), 1);
        $this->project = new Project;
    }

    /**
     * Loads the plugin into WordPress.
     *
     * @since 1.0.0
     */
    public function init()
    {
        // Run hook once Plugin has been initialized.
        do_action('projecten_plugin_init');
        // Load admin only components.
        if (is_admin()) {
            // Load all admin specific includes
            $this->requireAdmin();
            // Setup admin page
            $this->createAdmin();
        }

        // Load the view shortcodes 
        $this->loadViews();
    }

    public static function on_activation()
    {
        //Creates tables on startup
        Project::createMainTable();
        Project::createStatusTable();
        Project::insertStatusTable();
        ProjectenPlugin::add_plugin_caps();
    }

    public static function get_plugin_roles_and_caps(){

        // Define the desired roles for this plugin:
        return array (
            /* Is always available - Should be on firsth line */
            array('klant',
                'Klant',
                array( 'pp_create') )
        );

    }


    public static function add_plugin_caps() {

        // Include the roles and capabilities definition file:
        require_once plugin_dir_path( __FILE__ ) . 'includes/roles_and_caps_defs.php';

        $role_array = ProjectenPlugin::get_plugin_roles_and_caps();

        // Check for the roles:
        foreach ($role_array as $key => $role_name) {
            // Check specific role
            if( !( $GLOBALS['wp_roles']->is_role( $role_name[PP_ROLE_NAME] )) ){

                // Create role
                $role = add_role(   $role_name[PP_ROLE_NAME],
                                    $role_name[PP_ROLE_ALIAS], array('read' => true, 'level_0' => true));
            } else {
                var_dump($role);
            }
            // else : role exists
        }

        #exit( var_dump( $_GET ). var_dump($role) );

        // Add the capabilities per role
        foreach ($role_array as $key => $role_name) {
            // Create the caps for this role
            foreach ($role_name[PP_ROLE_CAP_ARRAY] as $cap_key => $cap_name) {
                // gets the author role
                $role = get_role( $role_name[PP_ROLE_NAME] );
                // This only works, because it accesses the class instance.
                // would allow the author to edit others' posts for current theme only
                $role->add_cap( $cap_name );
            }
        }
    }

    /**
     * Loads all admin related files into scope.
     *
     * @since 1.0.0
     */

    public function requireAdmin()
    {
        // Admin controller file
        require_once PROJECTEN_PLUGIN_ADMIN_DIR . '/ProjectenPlugin_AdminController.php';
    }

    /**
     * Admin controller functionality
     */
    public function createAdmin()
    {
        ProjectenPlugin_AdminController::prepare();
    }

    public function loadViews()
    {
        include PROJECTEN_PLUGIN_INCLUDES_VIEWS_DIR . '/shortcode.php';
    }
}

// Instantiate the class
$projecten_plugin = new ProjectenPlugin();
