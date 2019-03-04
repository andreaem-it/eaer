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

        $blog
            ->addChild(new MenuItemModel('Articles_List', 'List', 'admin_articles_list', [], 'fa fa-list-ul'))
            ->addChild(new MenuItemModel('Articles_New', 'New', 'admin_articles_new', [], 'fa fa-plus-circle'))
            ->addChild(new MenuItemModel('Articles_Categories', 'Categories', 'admin_articles_categories', [], 'fa fa-star'));

        return $this->activateByRoute($request->get('_route'), [$dash,$blog]);
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
