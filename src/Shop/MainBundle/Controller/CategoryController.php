<?php

namespace Shop\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Shop\MainBundle\Entity\Category;
use Shop\MainBundle\Form\CategoryType;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends Controller
{
	public function createAction(Request $request)
	{	
		$category = new Category();
		
		$form = $this->createForm(
			new CategoryType(),
			$category
		);
		
		if ($request->isMethod('POST')
		&& $form->handleRequest($request)
		&& $form->isValid()
		) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($category);
			$em->flush();
		}
		
		return $this->render(
			'ShopMainBundle:Category:create.html.twig',
			array(
				'form' => $form->createView(),
			)
		);
	}

	public function indexAction(Request $request)
	{
		$em = $this->getDoctrine()->getManager();
		$repository = $em->getRepository("ShopMainBundle:Category");

		$collectionCategories = $repository->findAll();


		return $this->render(
			'ShopMainBundle:Category:index.html.twig',
			array(
				'movies' => $collectionCategories,
			)
		);
	}
}