<?php

namespace Shop\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository("ShopMainBundle:Movie");
        $collectionAllMovies = $repository->findAll();

        $collectionMostPopularMovies = $em->getRepository("ShopMainBundle:Movie")->findBy(   array(), array('numberOfSales' => 'DESC') );

        $collectionMostReviewMovies = $repository->findAll();

        $collectionCategories = $em->getRepository("ShopMainBundle:Category")->findAll();

        uasort($collectionMostReviewMovies, function($a, $b){
            if ($a->getReviewsCount() == $b->getReviewsCount()) {
                return 0;
            }
            return ($a->getReviewsCount() > $b->getReviewsCount()) ? -1 : 1;
        });


        return $this->render(
            'ShopMainBundle:Default:index.html.twig',
            array(
                'allMovies' => $collectionAllMovies,
                'mostPopularMovies' => $collectionMostPopularMovies,
                'mostReviewMovies' => $collectionMostReviewMovies,
                'collectionCategories' => $collectionCategories
            )
        );
		

    }



}
