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
		
		$this->setSettings();
		$this->setSections();
		$this->setFields();

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

	public function setSettings() {
		$args = array(
			array(
				'option_group' => 'alegra_options_group',
				'option_name' => 'alegra_user',
				'callback' => array( $this->admin_callbacks, 'alegraOptionsGroup' ),
			),
			array(
				'option_group' => 'alegra_options_group',
				'option_name' => 'alegra_pass',
				'callback' => array( $this->admin_callbacks, 'alegraOptionsGroup' ),
			),
		);

		$this->settings->setSettings( $args );
	}

	public function setSections() {
		$args = array(
			array(
				'id' => 'alegra_admin_index',
				'title' => 'Settings',
				'callback' => array( $this->admin_callbacks, 'alegraAdminSection' ),
				'page' => 'alegra',
			),
		);

		$this->settings->setSections( $args );
	}

	public function setFields() {
		$args = array(
			array(
				'id' => 'alegra_user',
				'title' => 'Alegra user',
				'callback' => array( $this->admin_callbacks, 'alegraUser' ),
				'page' => 'alegra',
				'section' => 'alegra_admin_index',
				'args' => array(
					array(
						'label_for' => 'alegra_user',
						'class' => 'alegra',
					)
				)
			),
			array(
				'id' => 'alegra_token',
				'title' => 'Alegra token',
				'callback' => array( $this->admin_callbacks, 'alegraToken' ),
				'page' => 'alegra',
				'section' => 'alegra_admin_index',
				'args' => array(
					array(
						'label_for' => 'alegra_pass',
						'class' => 'alegra',
					)
				)
			),
		);

		$this->settings->setFields( $args );
	}
}