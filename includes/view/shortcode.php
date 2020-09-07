<?php
function load_main_view($atts, $content = NULL)
{
    // Include the main view
    include PROJECTEN_PLUGIN_INCLUDES_VIEWS_DIR .   '/pp_main_view.php';
}

add_shortcode('pp_main_view',    'load_main_view');
