<?php

namespace Shop\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
//		$this->get('session')->set('my_name', $name);
		
        return $this->render('ShopMainBundle:Default:index.html.twig');
    }
}
