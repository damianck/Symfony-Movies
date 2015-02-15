<?php

namespace Shop\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
//		$this->get('session')->set('my_name', $name);


        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository("ShopMainBundle:Movie");

        $collectionAllMovies = $repository->findAll();
        $collectionMostPopularMovies = $repository->findAll();
        $collectionMostReviewMovies = $repository->findAll();

        return $this->render(
            'ShopMainBundle:Default:index.html.twig',
            array(
                'allMovies' => $collectionAllMovies,
                'mostPopularMovies' => $collectionMostPopularMovies,
                'mostReviewMovies' => $collectionMostReviewMovies,
            )
        );
		
//        return $this->render('ShopMainBundle:Default:index.html.twig');
    }
}
