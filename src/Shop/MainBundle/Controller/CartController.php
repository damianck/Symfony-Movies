<?php

namespace Shop\MainBundle\Controller;


use Doctrine\Common\Collections\ArrayCollection;
use Shop\MainBundle\Entity\Cart;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Validator\Constraints\Null;

class CartController extends Controller
{
    protected function getCartForCurrentUser()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $repository = $em->getRepository("ShopMainBundle:Cart");

        $cart = $repository ->findOneBy(
            array( 'userId' => $this->getUser()->getId())
        );



        if(is_null($cart)  )
        {
            $cart = new Cart($this->getUser()->getId());
            $em->persist($cart);
        }

        return $cart;

    }


    public function indexAction()
    {
        $tmp = $this->getUser();
        $userId = $tmp->getId();

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository("ShopMainBundle:Cart");
        $cart = $repository-> findOneBy(array('userId' => $userId ));

        $repo= $em->getRepository("ShopMainBundle:Movie");

        $totalCost = 0;
        $result = [];

        if($cart !== NULL) {
        foreach ($cart->getMoviesId() as &$item) {
            $movie = $repo->findOneBy(array('id' => $item));
            $totalCost += $movie->getPrice();
            array_push($result,$movie);
        }
    }

        return $this->render(
            'ShopMainBundle:Cart:index.html.twig',
            array(
                'cart' => $result,
                'totalCost' =>$totalCost,

            )
        );
    }

    public function addToCartAction( $id)
    {

        $em = $this->getDoctrine()->getEntityManager();
        $cart = $this->getCartForCurrentUser();


        foreach($cart->getMoviesId() as &$item)
        {
            if($item == $id)
            {
                return $this->render(
                    'ShopMainBundle:Cart:addToCart.html.twig',
                    array(
                        'id' => $id,
                        'status' => 'existInCart',
                    )
                );
            }
        }
        $orders = $em->getRepository("ShopMainBundle:Order")->findBy(array('userId' =>$this->getUser()->getId()));
        foreach($orders as &$item)
        {
            foreach($item->getMovies() as &$movie)
            {
                if ($movie->getId() == $id) {
                    return $this->render(
                        'ShopMainBundle:Cart:addToCart.html.twig',
                        array(
                            'id' => $id,
                            'status' => 'bought',
                        )
                    );
                }
            }
        }
        


        $cart->addMovieId($id);
        $em->persist($cart);
        $em->flush();

        return $this->render(
            'ShopMainBundle:Cart:addToCart.html.twig',
            array(
                'id' => $id,
                'status' => 'added',
            )
        );
    }

    public function removeFromCartAction( $id)
    {

        $em = $this->getDoctrine()->getEntityManager();
        $cart = $this->getCartForCurrentUser();


        $cart->removeMovieId($id);
        $em->persist($cart);
        $em->flush();

        return $this->render(
            'ShopMainBundle:Cart:removeFromCart.html.twig',
            array(
                'id' => $id,
                'exist' => false
            )
        );
    }
}