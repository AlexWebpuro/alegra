<?php

namespace Alex\Alegra\Api;

class SettingsApi
{
    public $admin_pages = array();
    public $admin_subpages = array();
    public $subpages = array();

    public function register() {
        if( ! empty( $this->admin_pages ) ) {
            add_action( 'admin_menu', array( $this, 'addAdminMenu') );
        }
    }

    public function AddPages( array $pages ) {
        $this->admin_pages = $pages;
        return $this;
    }

    public function withSubPage( string $title = null ) {
        if( empty( $this->admin_pages) ) {
            return $this;
        }

        $admin_page = $this->admin_pages[0];

        $subpages = array(
            array(
                'parent_slug'   => $admin_page['menu_slug'],
                'page_title'    => $admin_page['page_title'],
				'menu_title'    => ( $title ) ? $title : $admin_page['menu_title'],
				'capability'    => $admin_page['capability'],
				'menu_slug'     => $admin_page['menu_slug'],
				'callback'      => $admin_page['callback'],
            ),
        );

        $this->admin_subpages = $subpages;

        // dd( $subpages );

        return $this;

    }

    public function addSubPages( array $pages ) {
        $this->admin_subpages = array_merge( $this->admin_subpages, $pages);

        return $this;
    }

    public function addAdminMenu() {
        foreach( $this->admin_pages as $page ) {
            add_menu_page( 
                $page['page_title'],
                $page['menu_title'],
                $page['capability'],
                $page['menu_slug'],
                $page['callback'],
                $page['icon_url'],
                $page['position']
            );
        }
        // dd( $this->admin_subpages );
        foreach( $this->admin_subpages as $page ) {
            add_submenu_page( 
                $page['parent_slug'],
                $page['page_title'],
                $page['menu_title'],
                $page['capability'],
                $page['menu_slug'],
                $page['callback'],
            );
        }
    }
}