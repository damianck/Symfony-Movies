<?php

namespace Shop\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Shop\MainBundle\Entity\Movie;
use Shop\MainBundle\Form\MovieType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class MovieController
 * @package Shop\MainBundle\Controller
 */
class MovieController extends Controller
{
	/**
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\Response
     */
	public function createAction(Request $request)
	{
		$movie = new Movie();
		$movie->setNumberOfSales(0);

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

	/**
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\Response
     */
	public function indexAction(Request $request)
	{
		$em = $this->getDoctrine()->getManager();
		$repository = $em->getRepository("ShopMainBundle:Movie");

		$collectionMovies = $repository->findAll();


		return $this->render(
			'ShopMainBundle:Movie:index.html.twig',
			array(
				'movies' => $collectionMovies,
			)
		);
	}

	/**
	 * @param $id
	 * @return \Symfony\Component\HttpFoundation\Response
     */
	public function detailsAction($id)
	{
		$em = $this->getDoctrine()->getManager();
		$repository = $em->getRepository("ShopMainBundle:Movie");


		$movie = $repository->find($id);


		if (!$movie) {
			throw $this->createNotFoundException('Unable to find movie entity.');
		}

		$category = $movie->getCategories();
		$actors = $movie->getActors();

		return $this->render(
			'ShopMainBundle:Movie:details.html.twig',
			array(
				'movie' => $movie,
				'category' => $category,
				'actors' => $actors,
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
		$repository = $em->getRepository("ShopMainBundle:Movie");

		$movie = $repository->find($id);
		$category = $em->getRepository("ShopMainBundle:Category")->findAll();
		$actors = $em->getRepository("ShopMainBundle:Actor")->findAll();

		$moviex = new Movie();
		$moviex->setNumberOfSales(0);

		$form = $this->createForm(
			new MovieType(),
			$moviex
		);

		if ($request->isMethod('POST')
			&& $form->handleRequest($request)
			&& $form->isValid()
		) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($moviex);
			$em->flush();
		}


		return $this->render(
			'ShopMainBundle:Movie:edit.html.twig',
			array(
				'movies' => $movie,
				'category' => $category,
				'actors' => $actors,
				'form' => $form->createView(),
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
		$repository = $em->getRepository("ShopMainBundle:Movie");

		$movie = $repository->find($id);

		if (!$movie) {
			throw $this->createNotFoundException('No movie found for id '.$id);
		}
		//$em->remove($id);
		$em->remove($movie);
		$em->flush();

	//	return $this->redirect($this->generateUrl('ShopMainBundle:Movie:index.html.twig'));

		$movies = $repository->findAll();

		return $this->render(
			'ShopMainBundle:Movie:index.html.twig',
			array(
				'movies' => $movies,
			)
		);

	}

}
