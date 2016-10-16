<?php

namespace AppBundle\Controller\Backend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class PinnwandController extends Controller
{
    /**
     * @Route("/pinnwand", name="be_pinnwand")
     */
    public function indexAction()
    {

        $content = "";

        return $this->render('@AppBundle/content.html.twig', [
            'content' => $content, 'statistik' => $jahre
        ]);
    }
}
