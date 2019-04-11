<?php
// src/EventListener/NotificationListListener.php
namespace App\EventListener;

use KevinPapst\AdminLTEBundle\Event\NotificationListEvent;
use KevinPapst\AdminLTEBundle\Model\NotificationModel;

class NotificationListListener
{
    public function onListNotifications(NotificationListEvent $event)
    {
        foreach($this->getNotifications() as $Notification) {
            $event->addNotification($Notification);
        }
    }

    protected function getNotifications()
    {
        // see above in NotificationSubscriber for a full example
        return [new NotificationModel()];
    }
}