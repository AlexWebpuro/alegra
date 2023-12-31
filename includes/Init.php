<?php

namespace Alex\Alegra;

use Alex\Alegra\Pages\Admin;
use Alex\Alegra\AlegraAPI\Alegra;

final class Init
{
    public static function get_services() {
        return [
            Pages\Admin::class,
            Base\Enqueue::class,
            Base\SettingsLink::class,
            AlegraAPI\Alegra::class,
            AlegraAPI\Customer::class
        ];
    }

    public static function register_services() {
        foreach( self::get_services() as $class ) {
            $service = self::instantiate( $class );

            if( method_exists($service, 'register') ) {
                $service->register();
            }
        }
    }

    private static function instantiate( $class ) {
        $service = new $class();
        return $service;
    }
}