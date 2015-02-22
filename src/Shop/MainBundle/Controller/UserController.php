<?php

namespace Shop\MainBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Shop\MainBundle\Entity\Cart;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{

    public function getCartCount($userId)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository("ShopMainBundle:Cart");
        $tmpCart = $repository-> findBy(array('userId' => $userId ));

        $repo= $em->getRepository("ShopMainBundle:Movie");

        $cartCount = 0;

        foreach( $tmpCart as &$item)
        {
            $movies = $repo-> findBy(array('id' => $item->getMovies()));
            foreach($movies as &$movie )
            {
                $cartCount++;
            }
        }
        return $cartCount;
    }

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