<?php

namespace Alex\Alegra;

use Alex\Alegra\Pages\Admin;

final class Init
{
    public static function get_services() {
        return [
            Pages\Admin::class,
            Base\Enqueue::class
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