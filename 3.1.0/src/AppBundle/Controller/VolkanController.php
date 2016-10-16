<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class VolkanController extends Controller
{
    public function indexAction($name, Request $request)
    {
        
        return $this->render('', array('name' => $name));
    }
    
    
}
