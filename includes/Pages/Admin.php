<?php

namespace Alex\Alegra\Pages;

use \Alex\Alegra\Api\SettingsApi;
use \Alex\Alegra\Base\BaseController;
use \Alex\Alegra\Api\Callbacks\AdminCallbacks;


class Admin extends BaseController
{
	public $settings;
	public $admin_callbacks;
	public $pages = array();
	public $subpages = array();

	// public function __construct()
	// {
	// }

    public function register() {
		$this->settings = new SettingsApi();
		$this->admin_callbacks = new AdminCallbacks();

		$this->setPages();
		$this->setSubpages();
		$this->settings->AddPages( $this->pages )
			->withSubPage( 'Dashboard' )
			->addSubPages( $this->subpages )
			->register();
    }

	public function setPages() {
		$this->pages = $pages = array(
			array(
				'page_title' => 'alegra',
				'menu_title' => 'Alegra',
				'capability' => 'manage_options',
				'menu_slug' => 'alegra',
				'callback' => array( $this->admin_callbacks, 'adminDashboard'),
				'icon_url' => 'dashicons-plugins-checked',
				'position' => 5 
			),
		);
	}

	public function setSubpages() {
		$this->subpages =  array(
            array(
                'parent_slug' => 'alegra',
                'page_title' => 'Settings',
				'menu_title' => 'Settings',
				'capability' => 'manage_options',
				'menu_slug' => 'alegra-settings',
				'callback' => array( $this->admin_callbacks, 'adminSettings' ),
            ),
        );
	}
}