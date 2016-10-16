<?php

namespace AppBundle\Controller\Vertrieb;

use AppBundle\Form\AgenturVertriebType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class VBRegisterController extends Controller
{
    /**
     * @Route("/register", name="vb_register")
     */
    public function registerAction(Request $request)
    {



        $form = $this->createForm(AgenturVertriebType::class);

        $form->handleRequest($request);

        if($request->isMethod('POST')){
            if($form->isValid()){
                dump(123);
            }
        }

        $error = array();

        return $this->render(
            '@AppBundle/Security/register.html.twig',
            array(
                'form' => $form->createView(),
                'error' => $error
            ));
    }
}
