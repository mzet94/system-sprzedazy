<?php
/**
 * Default controller.
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * class DefaultController
 */
class DefaultController extends Controller
{
    /**
     * Index
     *
     * @Route("/default")
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP Response
     *
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Default:index.html.twig');
    }
}
