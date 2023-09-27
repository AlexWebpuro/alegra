<?php

namespace Alex\Alegra\Base;

class Enqueue extends BaseController
{
    public function register() {
        add_action('admin_enqueue_scripts', array( $this, 'enqueue'));
    }

	function enqueue() {
		wp_enqueue_script('alegra', $this->plugin_url . '/assets/main.js', array(), '1.0', true );
		wp_enqueue_style('alegra', $this->plugin_url . '/assets/style.css', array(), '1.0', true );
	}
}