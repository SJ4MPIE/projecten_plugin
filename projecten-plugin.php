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

    }

}

// Instantiate the class
$projecten_plugin = new ProjectenPlugin();


?>