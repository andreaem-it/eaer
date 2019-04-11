<?php
// src/EventSubscriber/NotificationSubscriber.php
namespace App\EventSubscriber;

use KevinPapst\AdminLTEBundle\Event\NotificationListEvent;
use KevinPapst\AdminLTEBundle\Event\ThemeEvents;
use KevinPapst\AdminLTEBundle\Helper\Constants;
use KevinPapst\AdminLTEBundle\Model\NotificationModel;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class NotificationSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            ThemeEvents::THEME_NOTIFICATIONS => ['onNotifications', 100],
        ];
    }

    public function onNotifications(NotificationListEvent $event)
    {
        return false;
//        $notification = new NotificationModel();
//        $notification
//            ->setId(1)
//            ->setMessage('A demo message')
//            ->setType(Constants::TYPE_SUCCESS)
//            ->setIcon('far fa-envelope')
//        ;
//        $event->addNotification($notification);
    }
}