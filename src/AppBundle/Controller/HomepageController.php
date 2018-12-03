<?php
/**
 * Homepage controller.
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class DefaultController.
 *
 * @Route("/home")
 */
class HomepageController extends Controller
{
    /**
     * Index action.
     *
     * @Route(
     *     "/",
     *     name="homepage_index",
     * )
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP Response
     */
    public function indexAction()
    {
        return $this->render('homepage/index.html.twig');
    }
}
