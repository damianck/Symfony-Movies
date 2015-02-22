<?php

namespace Shop\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Shop\MainBundle\Entity\Review;
use Shop\MainBundle\Form\ReviewType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ReviewController
 * @package Shop\MainBundle\Controller
 */
class ReviewController extends Controller
{
    /**
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function createAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $review = new Review(
            $em->getRepository("ShopMainBundle:Movie")-> findOneBy(array('id' => $id )),
            $content = $this->get('request')->request->get('text'),
            $this->getUser()->getUsername()
        );

        $em->persist($review);
        $em->flush();

        return $this->redirect($this->generateUrl('shop_main_movies_details', array( 'id'=> $id)));
    }
}