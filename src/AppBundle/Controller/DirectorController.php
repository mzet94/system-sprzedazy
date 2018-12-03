<?php
/**
 * Director controller.
 * */
namespace AppBundle\Controller;

use AppBundle\Entity\Director;
use AppBundle\Form\DirectorType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class DirectorController.
 *
 * @Route("/director")
 */
class DirectorController extends Controller
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
     *     name="director_index",
     * )
     * @Route(
     *     "/page/{page}",
     *     requirements={"page": "[1-9]\d*"},
     *     name="director_index_paginated",
     * )
     * @Method("GET")
     */
    public function indexAction($page)
    {
        $directors = $this->get('app.repository.director')->findAllPaginated($page);

        return $this->render(
            'director/index.html.twig',
            ['directors' => $directors]
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
     *     name="director_add",
     * )
     * @Method({"GET", "POST"})
     */
    public function addAction(Request $request)
    {
        $director = new Director();
        $form = $this->createForm(DirectorType::class, $director);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('app.repository.director')->save($director);
            $this->addFlash('success', 'message.created_successfully');

            return $this->redirectToRoute('director_index');
        }

        return $this->render(
            'director/add.html.twig',
            [
                'director' => $director,
                'form' => $form->createView(),
            ]
        );
    }
    /**
     * Delete action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request  HTTP Request
     * @param integer                                   $director Director
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route(
     *     "/{id}/delete",
     *     name="director_delete",
     *     requirements={"page": "[1-9]\d*"},
     * )
     * @Method({"GET", "POST"})
     */
    public function deleteAction(Request $request, Director $director)
    {
        $form = $this->createForm(FormType::class, $director);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('app.repository.director')->delete($director);
            $this->addFlash('success', 'message.deleted_successfully');

            return $this->redirectToRoute('director_index');
        }

        return $this->render(
            'director/delete.html.twig',
            [
                'director' => $director,
                'form' => $form->createView(),
            ]
        );
    }
}
