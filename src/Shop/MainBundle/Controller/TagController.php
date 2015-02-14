<?php

namespace Shop\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Shop\MainBundle\Entity\Tag;
use Shop\MainBundle\Form\TagType;
use Symfony\Component\HttpFoundation\Request;

class TagController extends Controller
{
	public function createAction(Request $request)
	{	
		$tag = new Tag();
		
		$form = $this->createForm(
			new TagType(),
			$tag
		);
		
		if ($request->isMethod('POST')
		&& $form->handleRequest($request)
		&& $form->isValid()
		) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($tag);
			$em->flush();
		}
		
		return $this->render(
			'ShopMainBundle:tag:create.html.twig',
			array(
				'form' => $form->createView(),
			)
		);
	}
}