<?php
/**
 * SecurityController.php
 * avanzu-admin
 * Date: 23.02.14
 */

namespace AppBundle\Controller;


use AppBundle\Form\AgenturUserType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ProfileController extends Controller
{

    /**
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function userAction($userid, Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('AppBundle:AgenturUser')->find($userid);

        $form 	=	$this->createForm(AgenturUserType::class, $user);
        $form->handleRequest($request);

        if ($request->isMethod('POST')) {
            
            

            if ($form->isValid())
            {
                $data = $form->getData();

                // $message['info'][] = print_r($data);

                $em->persist($data);
                $em->flush();
            }
        }

        return $this->render('AvanzuAdminThemeBundle:default:form.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/profile", name="profile")
     */
    public function profileAction(){

        $user   =   $this->getUser();

        $seiteninfo = array();
        $seiteninfo['subtitle'] = "Profilübersicht";
        $seiteninfo['title'] = " ";
        $date = new \DateTime();
        $date->setTimestamp($this->get('session')->getMetadataBag()->getLastUsed());
        dump($date);

        return $this->render('@AppBundle/profile.html.twig', array('seiteninfo' => $seiteninfo, 'profile' => $user));

    }




}