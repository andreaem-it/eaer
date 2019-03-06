<?php
namespace App\EventListener;

use KevinPapst\AdminLTEBundle\Event\SidebarMenuEvent;
use KevinPapst\AdminLTEBundle\Model\MenuItemModel;
use Symfony\Component\HttpFoundation\Request;

class MenuBuilderListener
{
    public function onSetupMenu(SidebarMenuEvent $event)
    {
        $request = $event->getRequest();

        foreach ($this->getMenu($request) as $item) {
            $event->addItem($item);
        }
    }

    protected function getMenu(Request $request)
    {
        $dash = new MenuItemModel('Dashboard', 'Dashboard', 'admin' , [], 'fa fa-tachometer-alt');

        $blog = new MenuItemModel('Articles', 'Articles', 'item_symfony_route', [], 'fa fa-newspaper');

        $media = new MenuItemModel('Media', 'Media', 'item_symfony_route', [],'fa fa-images');

        $aspect = new MenuItemModel('Aspect', 'Aspect', 'admin', [], 'fa fa-paint-brush');

        $pages = new MenuItemModel('Pages', 'Pages', 'admin', [], 'fa fa-file');

        $settings = new MenuItemModel('Settings', 'Settings', 'admin', [], 'fa fa-cogs');

        $blog
            ->addChild(new MenuItemModel('Articles_List', 'List', 'admin_articles_list', [], 'fa fa-list-ul'))
            ->addChild(new MenuItemModel('Articles_New', 'New', 'admin_articles_new', [], 'fa fa-plus-circle'))
            ->addChild(new MenuItemModel('Articles_Categories', 'Categories', 'admin_articles_categories', [], 'fa fa-star'));

        $media
            ->addChild(new MenuItemModel('Media_List', 'List', 'admin_media_list' , [], 'fa fa-list-ul'));

        $aspect
            ->addChild(new MenuItemModel('Menu_list', 'Menu', 'admin_aspect_menu' , [], 'fa fa-list-ul'));

        $pages
            ->addChild(new MenuItemModel('Pages_Partners', 'Partners', 'admin_pages_partners', [], 'fa fa-hands-helping'));

        $settings
            ->addChild(new MenuItemModel('Settings_Users', 'Users', 'admin_settings_users', [], 'fa fa-users'));

        return $this->activateByRoute($request->get('_route'), [$dash,$blog,$pages,$media,$aspect,$settings]);
    }

    /**
     * @param string $route
     * @param MenuItemModel[] $items
     * @return MenuItemModel[]
     */
    protected function activateByRoute($route, $items)
    {
        foreach($items as $item) {
            if($item->hasChildren()) {
                $this->activateByRoute($route, $item->getChildren());
            } elseif($item->getRoute() == $route) {
                $item->setIsActive(true);
            }
        }

        return $items;
    }
}
