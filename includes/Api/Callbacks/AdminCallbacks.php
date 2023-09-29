<?php

namespace Alex\Alegra\Api\Callbacks;
use \Alex\Alegra\Base\BaseController;

class AdminCallbacks extends BaseController {
    public function adminDashboard() {
        return require_once "$this->plugin_path/templates/admin.php";
    }

    public function adminSettings() {
        return require_once "$this->plugin_path/templates/settings.php";
    }

    public function alegraOptionsGroup( $input ) {
        return $input;
    }

    public function alegraAdminSection() {
        echo 'Introduce your credentials for connect with Alegra.';
    }

    public function alegraUser() {
        $value = esc_attr( get_option( 'alegra_user') );
        echo "<input type='text' class='regular-text' name='alegra_user' value='$value'></input>";
    }

    public function alegraToken() {
        $value = esc_attr( get_option( 'alegra_pass') );
        echo "<input type='password' class='regular-text' name='alegra_pass' value='$value'></input>";
    }
    
}