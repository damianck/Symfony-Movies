<?php

namespace Shop\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Shop\MainBundle\Entity\Movie;
use Shop\MainBundle\Form\MovieType;
use Symfony\Component\HttpFoundation\Request;

class MovieController extends Controller
{
	public function createAction(Request $request)
	{	
		$movie = new Movie();
		
		$form = $this->createForm(
			new MovieType(),
			$movie
		);
		
		if ($request->isMethod('POST')
		&& $form->handleRequest($request)
		&& $form->isValid()
		) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($movie);
			$em->flush();
		}
		
		return $this->render(
			'ShopMainBundle:Movie:create.html.twig',
			array(
				'form' => $form->createView(),
			)
		);
	}
	
	public function indexAction(Request $request)
	{	
		$em = $this->getDoctrine()->getManager();
		$repository = $em->getRepository("ShopMainBundle:Movie");
		
		$collectionFeeds = $repository->findAll();
		
		
		return $this->render(
			'ShopMainBundle:Movie:index.html.twig',
			array(
				'movies' => $collectionFeeds,
			)
		);
	}

	public function aaa(Request $request)
	{
		$em = $this->getDoctrine()->getManager();
		$repository = $em->getRepository("ShopMainBundle:Movie");

		$collectionFeeds = $repository->findAll();


		return $this->render(
			'ShopMainBundle:Movie:index.html.twig',
			array(
				'movies' => $collectionFeeds,
			)
		);
	}
	
}