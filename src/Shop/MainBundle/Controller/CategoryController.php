<?php

namespace Shop\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Shop\MainBundle\Entity\Category;
use Shop\MainBundle\Form\CategoryType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class CategoryController
 * @package Shop\MainBundle\Controller
 */
class CategoryController extends Controller
{
	/**
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\Response
     */
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

	/**
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\Response
     */
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

	/**
	 * @param Request $request
	 * @param $id
	 * @return \Symfony\Component\HttpFoundation\Response
     */
	public function deleteAction(Request $request,$id)
	{
		$em = $this->getDoctrine()->getManager();
		$repository = $em->getRepository("ShopMainBundle:Category");

		$cat = $repository->find($id);

		if (!$cat) {
			throw $this->createNotFoundException('No category found for id '.$id);
		}
		//$em->remove($id);
		$em->remove($cat);
		$em->flush();

		//	return $this->redirect($this->generateUrl('ShopMainBundle:Movie:index.html.twig'));

		$categories = $repository->findAll();

		return $this->render(
			'ShopMainBundle:Category:index.html.twig',
			array(
				'movies' => $categories,
			)
		);

	}

	/**
	 * @param Request $request
	 * @param $id
	 * @return \Symfony\Component\HttpFoundation\Response
     */
	public function editAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository("ShopMainBundle:Category");

        $categories = $repository->find($id);
        $category = $em->getRepository("ShopMainBundle:Category")->find($id);
        $actors = $em->getRepository("ShopMainBundle:Actor")->find($id);

        return $this->render(
            'ShopMainBundle:Category:edit.html.twig',
            array(
                'category' => $categories,
            )
        );
    }
}