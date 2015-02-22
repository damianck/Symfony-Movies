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

	public function editAction(Request $request,$id)
	{
		$em = $this->getDoctrine()->getManager();
		$repository = $em->getRepository("ShopMainBundle:Movie");

		$movie = $repository->find($id);
		$category = $em->getRepository("ShopMainBundle:Category")->findAll();
		$actors = $em->getRepository("ShopMainBundle:Actor")->findAll();

		return $this->render(
			'ShopMainBundle:Movie:edit.html.twig',
			array(
				'movies' => $movie,
				'category' => $category,
				'actors' => $actors,
			)
		);
	}

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
