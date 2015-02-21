<?php
/**
 * Created by PhpStorm.
 * User: Marcin
 * Date: 2015-02-20
 * Time: 22:56
 */

namespace Shop\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Shop\MainBundle\Controller\MovieController;

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

    public function cartAction()
    {
        $tmp = $this->getUser();
        $cart = $tmp->getCart();

        $totalCost = 0;

        foreach( $cart as &$movie)
        {
            $totalCost += $movie->getPrice();
        }



        return $this->render(
            'ShopMainBundle:User:cart.html.twig',
            array(
                'totalCost' => $totalCost,

            )
        );
    }

    public function addToCartAction( $id)
    {

        
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository("ShopMainBundle:Movie");
        $movie = $repository-> find($id);

        $this->getUser()->addToCart($movie);

        return $this->render(
            'ShopMainBundle:User:addToCart.html.twig',
            array(
                'id' => $id,

            )
        );


    }


}