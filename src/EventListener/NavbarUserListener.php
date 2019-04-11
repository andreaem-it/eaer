<?php
// src/EventListener/NavbarUserListener.php
namespace App\EventListener;

use KevinPapst\AdminLTEBundle\Event\ShowUserEvent;
use KevinPapst\AdminLTEBundle\Model\NavBarUserLink;
use KevinPapst\AdminLTEBundle\Model\UserModel;

class NavbarUserListener
{
    public function onShowUser(ShowUserEvent $event)
    {
        $user = $this->getUser();
        $event->setUser($user);

        $event->setShowProfileLink(false);

    }

    protected function getUser()
    {
        // retrieve your concrete user model or entity
        // see above in NavbarUserSubscriber for a full example
        return new UserModel();
    }

}