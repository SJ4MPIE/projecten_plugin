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
define ( 'PROJECTEN_PLUGIN', __FILE__ );

// Include the general definition file:
require_once plugin_dir_path( __FILE__ ) . 'includes/defs.php';

class ProjectenPlugin {
    public function __construct() {
        // Fire a hook before the class is setup.
        do_action( 'projecten_plugin_pre_init' );
        // Load the plugin.
        add_action( 'init', array( $this, 'init' ), 1 );
    }

    /**
    * Loads the plugin into WordPress.
    *
    * @since 1.0.0
    */
    public function init() {
        // Run hook once Plugin has been initialized.
        do_action( 'projecten_plugin_init' );
        // Load admin only components.
        if (is_admin()) {
            // Load all admin specific includes
            $this->requireAdmin();
            // Setup admin page
            $this->createAdmin();
        }
    }
    /**
    * Loads all admin related files into scope.
    *
    * @since 1.0.0
    */

    public function requireAdmin() {
        // Admin controller file
        require_once PROJECTEN_PLUGIN_ADMIN_DIR.'/ProjectenPlugin_AdminController.php';
    }

    /**
    * Admin controller functionality
    */
    public function createAdmin(){
        ProjectenPlugin_AdminController::prepare();
    }

}

// Instantiate the class
$projecten_plugin = new ProjectenPlugin();


?>