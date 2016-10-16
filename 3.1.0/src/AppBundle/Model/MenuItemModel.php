<?php
namespace AppBundle\Model;
// ...
use Avanzu\AdminThemeBundle\Model\MenuItemInterface as ThemeMenuItem;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Routing\Route;

class MenuItemModel implements ThemeMenuItem {

    private $identifier = null;
    private $route = null;
    private $active = false;
    private $route_args = array();
    private $badge = null;
    private $badge_color = null;
    private $children = null;
    private $icon = null;
    private $label = null;

    /**
     * MenuItemModel constructor.
     */
    public function __construct($identifier = null, $label = null, $route_name = null, array $route_args = array(), $icon = null, $badge = null, $badge_color = null)
    {
        $this->identifier = $identifier;
        $this->route = $route_name;
        $this->route_args = $route_args;
        $this->badge = $badge;
        $this->badge_color = $badge_color;
        $this->icon = $icon;
        $this->label = $label;
        $this->children = New ArrayCollection();
    }

    public function getIdentifier()
    {
        return $this->identifier;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function getRoute()
    {
        return $this->route;
    }

    public function getRouteArgs()
    {
        return $this->route_args;
    }

    public function isActive()
    {
        return $this->active;
    }

    public function setIsActive($isActive)
    {
        $this->active = $isActive;
    }

    public function hasChildren()
    {
        if($this->children->count() > 0 ) return true;

        return false;
    }

    public function getChildren()
    {
        return $this->children;
    }

    public function addChild(ThemeMenuItem $child)
    {
        $this->children->add($child);
    }

    public function removeChild(ThemeMenuItem $child)
    {
        // TODO: Implement removeChild() method.
    }

    public function getIcon()
    {
        return $this->icon;
    }

    public function getBadge()
    {
        return $this->badge;
    }

    public function getBadgeColor()
    {
        return $this->badge_color;
    }

    public function getParent()
    {
        // TODO: Implement getParent() method.
    }

    public function hasParent()
    {
        // TODO: Implement hasParent() method.
    }

    public function setParent(ThemeMenuItem $parent = null)
    {
        // TODO: Implement setParent() method.
    }

    public function getActiveChild()
    {
        // TODO: Implement getActiveChild() method.
    }

}