<?php

namespace Alex\Alegra\Base;
use Alex\Alegra\AlegraAPI;
use Alex\Alegra\AlegraAPI\Alegra;

class Enqueue extends BaseController
{
    public function register() {
        add_action('admin_enqueue_scripts', array( $this, 'enqueue'));
		add_action( 'wp_ajax_alegra_test_connection', function() {
			$alegra = new Alegra;

			$alegra->getCretentials();
			$test = $alegra->testAPIConnection();

			// echo "<pre> $test </pre>";
			echo "$test";
			wp_die();
		});

    }

	function enqueue() {
		wp_enqueue_script('alegra', $this->plugin_url . '/assets/main.js', array(), '1.0', true );
		wp_enqueue_style('alegra', $this->plugin_url . 'assets/style.css', array(), '1.0', 'all' );
	}
}