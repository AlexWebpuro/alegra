<?php

namespace Alex\Alegra\Base;

class Enqueue
{
    public function register() {
        add_action('admin_enqueue_scripts', array( $this, 'enqueue'));
    }

	function enqueue() {
		wp_enqueue_script('alegra', PLUGIN_URL . '/assets/main.js', array(), '1.0', true );
		wp_enqueue_style('alegra', PLUGIN_URL . '/assets/style.css', array(), '1.0', true );
	}
}