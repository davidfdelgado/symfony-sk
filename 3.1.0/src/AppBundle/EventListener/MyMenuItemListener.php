<?php

namespace AppBundle\EventListener;

// ...

use AppBundle\Model\MenuItemModel;
use Avanzu\AdminThemeBundle\Event\SidebarMenuEvent;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;

class MyMenuItemListener {


    /**
     * MyMenuItemListener constructor.
     */
    public function __construct(TokenStorageInterface $token, AuthorizationChecker $authorizationChecker)
    {
        $this->token = $token;
        $this->authorization = $authorizationChecker;
    }

    public function onSetupMenu(SidebarMenuEvent $event) {

        $request = $event->getRequest();

        foreach ($this->getMenu($request) as $item) {
            $event->addItem($item);
        }

    }

    protected function getMenu(Request $request) {
        // Build your menu here by constructing a MenuItemModel array

        $token = $this->token->getToken();
        $key = $token->getProviderKey();
        $authorization = $this->authorization;


        $menuItems = array();

        if($key){
            $menuItems[] = new MenuItemModel('Title', ucfirst($key));

            if($key == "vertrieb"){
                $checkin = new MenuItemModel('ItemId', 'Checkin', 'vb_checkin', array(), 'fa fa-qrcode');
                $checkin->addChild(new MenuItemModel('ChildOneItemId', 'Infos', 'vb_checkin', [], 'fa fa-info'));
                $checkin->addChild(new MenuItemModel('ChildOneItemId2', 'Manuell Einchecken', 'vb_checkin_manuell', [], 'fa fa-info'));
                $checkin->addChild(new MenuItemModel('ChildOneItemId3', 'Übersicht', 'vb_checkin_overview', [], 'fa fa-eye'));


                $vorgaenge = new MenuItemModel('ItemId6', 'Vorgänge', 'vb_checkin', array(), 'fa fa-download');
                $vorgaenge->addChild(new MenuItemModel('ChildOneItemId61', 'alle Vorgänge', 'vb_vorgaenge', [], 'fa fa-circle-o'));

                $rechnungen = new MenuItemModel('ItemId2', 'Rechnungen', 'vb_checkin', array(), 'fa fa-file-o');
                $rechnungen->addChild(new MenuItemModel('ChildOneItemId21', 'alle Rechnungen', 'vb_rechnungen', [], 'fa fa-circle-o'));

                $statistik = new MenuItemModel('ItemId3', 'Statistiken', null, array(), 'fa fa-area-chart');
                $statistik->addChild(new MenuItemModel('ChildOneItemId31', 'Umsatz', 'vb_statistik_umsatz', array(), 'fa fa-area-chart'));

                $tickets = new MenuItemModel('ItemId4', 'Tickets', null, array(), 'fa fa-ticket');
                $tickets->addChild(new MenuItemModel('ChildOneItemId41', 'Auswahl', 'vb_ticket_auswahl', array(), 'fa fa-list'));

                $benutzer = new MenuItemModel('ItemId5', 'Benutzer', null, array(), 'fa fa-users');
                $benutzer->addChild(new MenuItemModel('ChildOneItemId51', 'Übersicht', 'vb_benutzer', array(), 'fa fa-list'));

                if($authorization->isGranted('ROLE_VERTRIEB_ACCOUNT_PARTNER')){
                    $menuItems[] = $checkin;
                }
                if($authorization->isGranted('ROLE_VERTRIEB_ACCOUNT_VERMITTLER')) {
                    $menuItems[] = $vorgaenge;
                    $menuItems[] = $tickets;
                }
                $menuItems[] = $statistik;
                $menuItems[] = $rechnungen;

                if($authorization->isGranted('ROLE_VERTRIEB_ADMIN')) {
                    $menuItems[] = $benutzer;
                }
            }

            if($key == "backend"){
                $pinnwand = new MenuItemModel('ItemId1', 'Pinnwand', 'be_pinnwand', array(), 'fa fa-map-pin');
                $menuItems[] = $pinnwand;

                $vorgaenge = new MenuItemModel('ItemId2', 'Vorgänge', null, array(), 'fa fa-reorder');
                $vorgaenge->addChild(new MenuItemModel('ItemId2Child1', 'Alle', 'be_vorgaenge_alle', [], 'fa fa-circle-thin'));
                $vorgaenge->addChild(new MenuItemModel('ItemId2Child2', 'Rechnungen', 'be_vorgaenge_rechnungen', [], 'fa fa-circle-thin'));
                $vorgaenge->addChild(new MenuItemModel('ItemId2Child3', 'Angebote', 'be_vorgaenge_angebote', [], 'fa fa-circle-thin'));
                $vorgaenge->addChild(new MenuItemModel('ItemId2Child4', 'Anfragen', 'be_vorgaenge_anfragen', [], 'fa fa-circle-thin'));
                $menuItems[] = $vorgaenge;

                $kunden = new MenuItemModel('ItemId3', 'Kundenstamm', null, array(), 'fa fa-user');
                $kunden->addChild(new MenuItemModel('ItemId3Child1', 'Kundenübersicht', 'be_kunden_overview', [], 'fa fa-circle-thin'));
                $kunden->addChild(new MenuItemModel('ItemId3Child2', 'Kunden erstellen', 'be_kunde_erstellen', [], 'fa fa-circle-thin'));
                $menuItems[] = $kunden;

                $artikel = new MenuItemModel('ItemId4', 'Tickets', null, array(), 'fa fa-ticket');
                $artikel->addChild(new MenuItemModel('ItemId4Child1', 'Destinationen', 'artikel_orte', [], 'fa fa-circle-thin'));
                $artikel->addChild(new MenuItemModel('ItemId4Child2', 'KategorieArten', 'kategorie_arten', [], 'fa fa-circle-thin'));
                $artikel->addChild(new MenuItemModel('ItemId4Child3', 'Bausteine', 'shop_bausteine', [], 'fa fa-circle-thin'));
                $menuItems[] = $artikel;
            }

            if($key == "scan"){
                $scan = new MenuItemModel('ItemId', 'Scan', 'sc_index', array(), 'fa fa-qrcode');
                $historie = new MenuItemModel('ItemId2', 'Historie', 'sc_historie', array(), 'fa fa-history');
                $menuItems[] = $scan;
                $menuItems[] = $historie;
            }
        }


        $blog = new MenuItemModel('ItemId', 'Scan', null, array(), 'fa fa-plane');

        // Add some children
        
        // A child with an icon
        $blog->addChild(new MenuItemModel('ChildOneItemId', 'Label', 'avanzu_menu_test'));

        // A child with default circle icon
        $blog->addChild(new MenuItemModel('ChildTwoItemId', 'Logout', 'avanzu_admin_logout'));

        return $this->activateByRoute($request->get('_route'), $menuItems);
    }

    protected function activateByRoute($route, $items) {

        foreach($items as $item) {
            if ($item->hasChildren()) {
                $i = $this->activateByRoute($route, $item->getChildren());

                foreach($i as $ii) {
                    if($ii->isActive()){
                        $item->setIsActive(true);
                    }
                }

            } else {
                if ($item->getRoute() == $route) {
                    $item->setIsActive(true);
                }
            }

        }

        return $items;
    }

}