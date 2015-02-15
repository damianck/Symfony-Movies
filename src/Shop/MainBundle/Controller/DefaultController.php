<?php

namespace Shop\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    function compare($a, $b) {
        $c = $a->getReviewsCount();
        $d = $b->getReviewsCount();
//        if ($c == $d) {
//            return 0;
//        }
        return 1;
    }

    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository("ShopMainBundle:Movie");
        $collectionAllMovies = $repository->findAll();

        $collectionMostPopularMovies = $em->getRepository("ShopMainBundle:Movie")->findBy(   array(), array('numberOfSales' => 'DESC') );
        $collectionMostReviewMovies = $em->getRepository("ShopMainBundle:Movie")->findBy(   array(), array('numberOfReviews' => 'DESC') );


        return $this->render(
            'ShopMainBundle:Default:index.html.twig',
            array(
                'allMovies' => $collectionAllMovies,
                'mostPopularMovies' => $collectionMostPopularMovies,
                'mostReviewMovies' => $collectionMostReviewMovies,
            )
        );
		

    }



}
