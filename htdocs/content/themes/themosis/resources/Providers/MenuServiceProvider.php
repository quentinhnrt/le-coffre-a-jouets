<?php

namespace Theme\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Log1x\Navi\Navi;
use Themosis\Support\Facades\Action;

class MenuServiceProvider extends \Illuminate\Support\ServiceProvider
{

    protected $menus;

    private int $curr_id = -1;

    public function register()
    {
        Action::add('wp', function () {
            $this->menus = $this->getMenus();
            $this->curr_id = $this->getCurrentPageId();
        });
    }

    private function getMenus()
    {
        $menusKeys = array_keys(Config::get('menus'));

        $menus = [];

        foreach ($menusKeys as $menuKey) {
            $menus[str_replace('-', '_', $menuKey)] = $this->getMenuDatas($menuKey);
        }

        return (object) $menus;
    }

    private function getCurrentPageId()
    {
        global $wp_query;

        return $wp_query->get_queried_object_id();
    }

    private function getMenuDatas($menu)
    {
        $menuItems = (new Navi())->build($menu);
        $menuDatas = $menuItems->get();

        return (object) [
            'datas' => $menuDatas,
            'itemCount' => $menuItems->isEmpty() ? 0 : count($menuItems->toArray()),
            'items' => $menuItems->isEmpty() ? [] : $menuItems->toArray(),
        ];
    }

    public function boot()
    {
        View::composer('*', function ($view) {
            $view->with('menus', $this->menus)->with('curr_id', $this->curr_id);
        });
    }

}
