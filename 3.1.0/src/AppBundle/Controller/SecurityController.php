<?php

namespace AppBundle\Controller;

use Doctrine\DBAL\Types\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends Controller
{
    /**
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render(
            'AvanzuAdminThemeBundle:Security:login.html.twig',
            array(
                'last_username' => $lastUsername,
                'error'         => $error,
            )
        );
    }

    /**
     * @Route("/login_check", name="login_check")
     */
    public function loginCheckAction(Request $request)
    {

        // replace this example code with whatever you need

        return new Response('Login Seite');

    }


    /**
     * @Route("/login_forgot", name="login_forgot")
     */
    public function loginForgotAction(Request $request)
    {

        // replace this example code with whatever you need

        $form = $this->createFormBuilder()
            ->add('bn', \Symfony\Component\Form\Extension\Core\Type\TextType::class, ['attr' => ['placeholder' => 'Benutzername'], 'label' => false])
            ->add('resetPassword', SubmitType::class, ['attr'  => ['class' => 'btn btn-primary btn-block'], 'label' => ' Passwort zurücksetzen' ])
            ->getForm();

        $form->handleRequest($request);

        $error = "";

        $em = $this->getDoctrine()->getEntityManager();

        if($request->isMethod('POST')){

            if($form->isValid()){

                $data = $form->getData('bn');

                $user = $em->getRepository('AppBundle\Entity\AgenturUser')->findFullInfosBy($data['bn']);

                if($user) {

                    if($user->getAuStatus() == true && $user->getAuVid()->getAvStatus() == true){

                        // $user->setAuPassword();

                        $mailer = \Swift_Message::newInstance()
                            ->setSubject('Passwort zurück undso')
                            ->setFrom('noreply@sightseeing-kontor.de')
                            ->setTo('david.delgado@gmx.de')
                            ->setBody(
                                $user->setPassword(), 'text/html'
                            )
                        ;

                        $this->get('mailer')->send($mailer);

                    } else {
                        $error['messageKey'] = "Der Account wurde deaktiviert. Bitte wenden Sie sich an Ihren Betreuer.";
                    }
                } else {

                    $error['messageKey'] = "Benutzername nicht gefunden...";

                }
            }

        }

        return $this->render(
            '@AppBundle/Security/forgot.html.twig',
            array(
                'form' => $form->createView(),
                'error' => $error
            )
        );

    }

    /**
     * @Route("/login_denied", name="403")
     */
    public function loginDeniedAction(Request $request)
    {

        // replace this example code with whatever you need

        return $this->render(
            '@AppBundle/Security/denied.html.twig',
            array(
                'error' => array(),
                'last_username' => null
            )
        );

    }


    /**
     * @Route("/405", name="405")
     */
    public function statusCodeAction(Request $request){

        return $this->render(
            '@AppBundle/Security/status_codes.html.twig',
            array(
                'error_code' => 405
            )
        );

    }
}

