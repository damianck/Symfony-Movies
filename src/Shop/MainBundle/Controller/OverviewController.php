<?php

namespace Shop\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class OverviewController extends Controller
{
    public function feedsAction()
    {
		$path = sprintf(
			'%s/var/movie.json',
			$this->get('kernel')->getRootDir()
		);
		
		$json = file_get_contents($path);

		$movies = json_decode($json);
		
        return $this->render(
			'movies.html.twig',
			array(
				'feeds' => $movies,
				'name' => 'Shop',
				'xyz' => array('a', 'b', 'c'),
				'collection' => array('a' => 'foo', 'b' => 'bar'),
			)
		);
    }
}
