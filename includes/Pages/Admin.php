<?php

namespace Alex\Alegra\Pages;
use \Alex\Alegra\Base\BaseController;
use \Alex\Alegra\Api\SettingsApi;

class Admin extends BaseController
{
	public $settings;
	public $pages;

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
	}

    public function register() {
		$this->settings->AddPages( $this->pages )->register();
    }
}