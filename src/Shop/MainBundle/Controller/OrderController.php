<?php

namespace Shop\MainBundle\Controller;

use Shop\MainBundle\Form\OrderType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class OrderController extends Controller
{
	public function createAction(Request $request)
	{
		$order = new Order();



		$form = $this->createForm(
			new OrderType(),
			$order
		);

		if ($request->isMethod('POST')
			&& $form->handleRequest($request)
			&& $form->isValid()
		) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($order);
			$em->flush();
		}

		return $this->render(
			'ShopMainBundle:Order:create.html.twig',
			array(
				'form' => $form->createView(),
			)
		);
	}

	public function indexAction(Request $request)
	{
		$em = $this->getDoctrine()->getManager();
		$repository = $em->getRepository("ShopMainBundle:Order");

		$collectionMovies = $repository->findAll();


		return $this->render(
			'ShopMainBundle:Movie:index.html.twig',
			array(
				'movies' => $collectionMovies,
			)
		);
	}
}
