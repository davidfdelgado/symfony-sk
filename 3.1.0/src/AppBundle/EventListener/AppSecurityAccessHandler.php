<?php

namespace AppBundle\EventListener;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Http\Authorization\AccessDeniedHandlerInterface;

/**
 * Created by PhpStorm.
 * User: ddelgado
 * Date: 25.06.16
 * Time: 15:55
 */
class AppSecurityAccessHandler implements AccessDeniedHandlerInterface
{
        function handle(Request $request, AccessDeniedException $accessDeniedException){
                $request->redirectToRoute('asd');
        }

}