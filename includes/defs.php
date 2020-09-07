<?php

/**
 * Definitions needed in the plugin
 *
 * @author
 * @version 0.1
 *
 * Version history
 * 0.1 Initial version
 */

//@TODO: Give better description of defs 
// De versie moet gelijk zijn met het versie nummer in de my-eventorganiser.php header
define('PROJECTEN_PLUGIN_VERSION', '0.0.1');
// Minimum required Wordpress version for this plugin
define('PROJECTEN_PLUGIN_REQUIRED_WP_VERSION', '4.0');

define('PROJECTEN_PLUGIN_PLUGIN_BASENAME', plugin_basename(PROJECTEN_PLUGIN));
define('MY_PROJECTEN_PLUGIN_PLUGIN_NAME', trim(dirname(PROJECTEN_PLUGIN_PLUGIN_BASENAME), '/'));
// Folder structure
define('PROJECTEN_PLUGIN_DIR', untrailingslashit(dirname(PROJECTEN_PLUGIN)));

define('PROJECTEN_PLUGIN_INCLUDES_DIR', PROJECTEN_PLUGIN_DIR . '/includes');
define('PROJECTEN_PLUGIN_MODEL_DIR', PROJECTEN_PLUGIN_INCLUDES_DIR . '/model');
define('PROJECTEN_PLUGIN_ADMIN_DIR', PROJECTEN_PLUGIN_DIR . '/admin');
define('PROJECTEN_PLUGIN_ADMIN_VIEWS_DIR', PROJECTEN_PLUGIN_ADMIN_DIR . '/views');
define('PROJECTEN_PLUGIN_INCLUDES_IMGS_DIR', PROJECTEN_PLUGIN_INCLUDES_DIR . '/img');
define('PROJECTEN_PLUGIN_INCLUDES_VIEWS_DIR', PROJECTEN_PLUGIN_INCLUDES_DIR . '/view');
