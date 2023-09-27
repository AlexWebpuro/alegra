<?php

namespace Alex\Alegra\Base;

class SettingsLink extends BaseController
{
    public function register() {
        add_filter("plugin_action_links_$this->plugin", array( $this, 'plugin_settings'));
    }

    public function plugin_settings( $links ) {
        $setting_link = '<a href="admin.php?page=alegra">Settings</a>';
        array_push( $links, $setting_link );
        return $links;
    }
}