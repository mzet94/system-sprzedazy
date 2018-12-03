<?php
/**
 * Location controller.
 */
namespace AppBundle\Controller;

use AppBundle\Entity\Location;
use AppBundle\Form\LocationType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class LocationController.
 *
 * @Route("/location")
 */
class LocationController extends Controller
{
    /**
     * Index action.
     *
     * @param integer $page Current page number
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route(
     *     "/",
     *     defaults={"page": 1},
     *     name="location_index",
     * )
     * @Route(
     *     "/page/{page}",
     *     requirements={"page": "[1-9]\d*"},
     *     name="location_index_paginated",
     * )
     * @Method("GET")
     */
    public function indexAction($page)
    {
        $locations = $this->get('app.repository.location')->findAllPaginated($page);

        return $this->render(
            'location/index.html.twig',
            ['locations' => $locations]
        );
    }
    /**
     * Add action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request HTTP Request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route(
     *     "/add",
     *     name="location_add",
     * )
     * @Method({"GET", "POST"})
     */
    public function addAction(Request $request)
    {
        $location = new Location();
        $form = $this->createForm(LocationType::class, $location);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('app.repository.location')->save($location);
            $this->addFlash('success', 'message.created_successfully');

            return $this->redirectToRoute('location_index');
        }

        return $this->render(
            'location/add.html.twig',
            [
                'location' => $location,
                'form' => $form->createView(),
            ]
        );
    }
    /**
     * Delete action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request  HTTP Request
     * @param integer                                   $location Location
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route(
     *     "/{id}/delete",
     *     name="location_delete",
     *     requirements={"page": "[1-9]\d*"},
     * )
     * @Method({"GET", "POST"})
     */
    public function deleteAction(Request $request, Location $location)
    {
        $form = $this->createForm(FormType::class, $location);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('app.repository.location')->delete($location);
            $this->addFlash('success', 'message.deleted_successfully');

            return $this->redirectToRoute('location_index');
        }

        return $this->render(
            'location/delete.html.twig',
            [
                'location' => $location,
                'form' => $form->createView(),
            ]
        );
    }
}
