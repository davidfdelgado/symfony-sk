<?php
namespace AppBundle\Model;
// ...
use Avanzu\AdminThemeBundle\Model\UserInterface as ThemeUser;

class UserModel implements  ThemeUser {
    // ...
    // implement interface methods
    // ...
    public function getAvatar()
    {
        return false;
    }

    public function getUsername()
    {
        // TODO: Implement getUsername() method.
    }

    public function getName()
    {
        // TODO: Implement getName() method.
    }

    public function getMemberSince()
    {
        // TODO: Implement getMemberSince() method.
    }

    public function isOnline()
    {
        // TODO: Implement isOnline() method.
    }

    public function getIdentifier()
    {
        // TODO: Implement getIdentifier() method.
    }

    public function getTitle()
    {
        // TODO: Implement getTitle() method.
    }

}