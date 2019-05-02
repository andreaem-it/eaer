<?php
namespace App\EventListener;

use App\Entity\MenuItems;
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

        $reports = new MenuItemModel('Reports', 'Reports', 'admin', [], 'fa fa-file-alt');

        $contacts = new MenuItemModel('Contacts', 'Contacts', 'admin', [], 'fa fa-envelope' );

        $events = new MenuItemModel('Events', 'Events', 'admin', [], 'fa fa-calendar');

        $newsletter = new MenuItemModel('Newsletter', 'Newsletter', 'admin', [], 'fa fa-envelope');

        $settings = new MenuItemModel('Settings', 'Settings', 'admin', [], 'fa fa-cogs');

        $blog
            ->addChild(new MenuItemModel('Articles_List', 'List', 'admin_articles_list', [], 'fa fa-list-ul'))
            ->addChild(new MenuItemModel('Articles_New', 'New', 'admin_articles_new', [], 'fa fa-plus-circle'))
            ->addChild(new MenuItemModel('Articles_Categories', 'Categories', 'admin_articles_categories', [], 'fa fa-star'));

        $media
            ->addChild(new MenuItemModel('Media_List', 'List', 'admin_media_list' , [], 'fa fa-list-ul'))
            ->addChild(new MenuItemModel('Media_Add', 'Add', 'admin_media_add', [], 'fa fa-plus-circle'));

        $aspect
            ->addChild(new MenuItemModel('Menu_list', 'Menu', 'admin_aspect_menu' , [], 'fa fa-list-ul'))
            ->addChild(new MenuItemModel('Slider', 'Slider', 'admin_aspect_slider' , [], 'fa fa-puzzle-piece'));

        $pages
            ->addChild(new MenuItemModel('Pages_Homepage', 'Homepage', 'admin_pages_homepage',[], 'fa fa-file'))
            ->addChild(new MenuItemModel('Pages_Custom', 'Custom', 'admin_pages_custom', [], 'fa fa-list-ul'))
            ->addChild(new MenuItemModel('Pages_Partners', 'Partners', 'admin_pages_partners', [], 'fa fa-hands-helping'));

        $reports
            ->addChild(new MenuItemModel('Reports_List', 'List','admin_reports_list', [], 'fa fa-list'))
            ->addChild(new MenuItemModel('Reports_New', 'New','admin_reports_add', [], 'fa fa-plus-circle'));

        $contacts
            ->addChild(new MenuItemModel('Contacts_List', 'List', 'admin_contacts_list', [], 'fa fa-list-ul'));

        $events
            ->addChild(new MenuItemModel('Events_List', 'List', 'admin_events_list', [], 'fa fa-list-ul'));

        $newsletter
            ->addChild(new MenuItemModel('Newsletter_List', 'List', 'admin_newsletter_list', [], 'fa fa-list-ul'));

        $settings
            ->addChild(new MenuItemModel('Settings_Users', 'Users', 'admin_settings_users', [], 'fa fa-users'))
            ->addChild(new MenuItemModel('Settings_System', 'System', 'admin_settings_system', [], 'fa fa-cog'));

        return $this->activateByRoute($request->get('_route'), [$dash,$blog,$pages,$reports,$media,$aspect,$contacts,$events,$newsletter,$settings]);
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
