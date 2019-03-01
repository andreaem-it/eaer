<?php
namespace App\Model;

use KevinPapst\AdminLTEBundle\Model\MenuItemInterface;

class MenuItemModel implements MenuItemInterface {
    // ...
    // implement interface methods
    // ...
    /**
     * @return string
     */
    public function getIdentifier()
    {
        // TODO: Implement getIdentifier() method.
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        // TODO: Implement getLabel() method.
    }

    /**
     * @return string
     */
    public function getRoute()
    {
        // TODO: Implement getRoute() method.
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        // TODO: Implement isActive() method.
    }

    /**
     * @param bool $isActive
     */
    public function setIsActive($isActive)
    {
        // TODO: Implement setIsActive() method.
    }

    /**
     * @return bool
     */
    public function hasChildren()
    {
        // TODO: Implement hasChildren() method.
    }

    /**
     * @return array
     */
    public function getChildren()
    {
        // TODO: Implement getChildren() method.
    }

    /**
     * @param MenuItemInterface $child
     */
    public function addChild(MenuItemInterface $child)
    {
        // TODO: Implement addChild() method.
    }

    /**
     * @param MenuItemInterface $child
     */
    public function removeChild(MenuItemInterface $child)
    {
        // TODO: Implement removeChild() method.
    }

    /**
     * @return string
     */
    public function getIcon()
    {
        // TODO: Implement getIcon() method.
    }

    /**
     * @return string
     */
    public function getBadge()
    {
        // TODO: Implement getBadge() method.
    }

    /**
     * @return string
     */
    public function getBadgeColor()
    {
        // TODO: Implement getBadgeColor() method.
    }

    /**
     * @return MenuItemInterface
     */
    public function getParent()
    {
        // TODO: Implement getParent() method.
    }

    /**
     * @return bool
     */
    public function hasParent()
    {
        // TODO: Implement hasParent() method.
    }

    /**
     * @param MenuItemInterface $parent
     */
    public function setParent(MenuItemInterface $parent = null)
    {
        // TODO: Implement setParent() method.
    }

    /**
     * @return MenuItemInterface|null
     */
    public function getActiveChild()
    {
        // TODO: Implement getActiveChild() method.
    }
}