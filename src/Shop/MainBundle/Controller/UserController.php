<?php
/**
 * Created by PhpStorm.
 * User: Marcin
 * Date: 2015-02-20
 * Time: 22:56
 */

namespace Shop\MainBundle\Controller;

use Doctrine\Common\Collections\Criteria;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    public function indexAction()
    {
        $tmp = $this->getUser();
        $userId = $tmp->getId();

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository("ShopMainBundle:Order");
        $collectionAllOrders = $repository-> findBy(array('userId' => $userId ));



        return $this->render(
            'ShopMainBundle:User:index.html.twig',
            array(
               'orders' => $collectionAllOrders,

            )
        );
    }
}