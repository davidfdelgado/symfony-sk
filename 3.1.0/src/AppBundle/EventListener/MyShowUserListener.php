<?php
namespace AppBundle\EventListener;

// ...

use Avanzu\AdminThemeBundle\Event\ShowUserEvent;
use Avanzu\AdminThemeBundle\Model\UserModel;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class MyShowUserListener {

    public function __construct(TokenStorage $token) {
        $this->token = $token;

    }

    public function onShowUser(ShowUserEvent $event) {

        $user = $this->token->getToken()->getUser();

        if($user->getAuId()) {

            $avatar = new UserModel();
            $avatar->setIsOnline(1);
            $avatar->setMemberSince($user->getAuCreated());
            $avatar->setUsername($user->getAuId());
            $avatar->setName($user->getAuVorname()." ".$user->getAuNachname());
            $avatar->setTitle('TEST');

            $event->setUser($avatar);
        }

    }

    protected function getUser() {
        return $avatar;
    }

}