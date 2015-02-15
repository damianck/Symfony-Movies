<?php

namespace Shop\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Shop\MainBundle\Entity\Review;
use Shop\MainBundle\Form\ReviewType;
use Symfony\Component\HttpFoundation\Request;

class ReviewController extends Controller
{
    public function createAction(Request $request)
    {
        $review = new Review();

        $form = $this->createForm(
            new ReviewType(),
            $review
        );

        if ($request->isMethod('POST')
            && $form->handleRequest($request)
            && $form->isValid()
        ) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($review);
            $em->flush();
        }

        return $this->render(
            'ShopMainBundle:Review:create.html.twig',
            array(
                'form' => $form->createView(),
            )
        );
    }
}