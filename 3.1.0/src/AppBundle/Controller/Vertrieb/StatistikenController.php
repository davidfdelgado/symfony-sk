<?php

namespace AppBundle\Controller\Vertrieb;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StatistikenController extends Controller
{

    /**
     * @Route("/vertrieb/statistiken/", name="vb_statistiken")
     */
    public function indexAction()
    {
        $name = "2";
        return $this->render('', array('name' => $name));

    }

}
