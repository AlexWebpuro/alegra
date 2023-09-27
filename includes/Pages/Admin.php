<?php

namespace Alex\Alegra\Pages;
use \Alex\Alegra\Base\BaseController;
use \Alex\Alegra\Api\SettingsApi;

class Admin extends BaseController
{
	public $settings;
	public $pages = array();
	public $subpages = array();

	public function __construct()
	{
		$this->settings = new SettingsApi();
		$this->pages = $pages = array(
			array(
				'page_title' => 'alegra',
				'menu_title' => 'Alegra',
				'capability' => 'manage_options',
				'menu_slug' => 'alegra',
				'callback' => function() {
					echo '<h1>Alex</h1>';
				},
				'icon_url' => 'dashicons-plugins-checked',
				'position' => 5 
			),
		);

		$this->subpages =  array(
            array(
                'parent_slug' => 'alegra',
                'page_title' => 'Settings',
				'menu_title' => 'Settings',
				'capability' => 'manage_options',
				'menu_slug' => 'alegra-settings',
				'callback' => function() {
					echo '<h1>Other tab for my plugin!</h1>';
				},
            ),
        );
		// dd( $this->subpages );
	}

    public function register() {
		$this->settings->AddPages( $this->pages )->withSubPage( 'Dashboard' )->addSubPages( $this->subpages )->register();
    }
}