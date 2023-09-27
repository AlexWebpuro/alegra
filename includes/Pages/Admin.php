<?php

namespace Alex\Alegra\Pages;
use \Alex\Alegra\Base\BaseController;

class Admin extends BaseController
{
    public function register() {
        add_action('admin_menu', array($this, 'add_admin_page'), 10, 0);
    }

	public function add_admin_page() {
		add_menu_page('alegra','Alegra','manage_options','alegra', array( $this, 'admin_index'),'dashicons-plugins-checked',5 );
	}

	public function admin_index() {
		require_once $this->plugin_path . 'templates/admin.php';
	}
}