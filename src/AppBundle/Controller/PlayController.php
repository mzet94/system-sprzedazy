<?php
/**
 * Play controller.
 */
namespace AppBundle\Controller;

use AppBundle\Entity\Play;
use AppBundle\Form\PlayType;
use AppBundle\Form\PlayRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class PlayController.
 *
 * @Route("/play")
 */
class PlayController extends Controller
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
     *     name="play_index",
     * )
     * @Route(
     *     "/page/{page}",
     *     requirements={"page": "[1-9]\d*"},
     *     name="play_index_paginated",
     * )
     * @Method("GET")
     */
    public function indexAction($page)
    {
        $plays = $this->get('app.repository.play')->findAllPaginated($page);

        return $this->render(
            'play/index.html.twig',
            ['plays' => $plays]
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
     *     name="play_add",
     * )
     * @Method({"GET", "POST"})
     */
    public function addAction(Request $request)
    {
        $play = new Play();
        $form = $this->createForm(PlayType::class, $play);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('app.repository.play')->save($play);
            $this->addFlash('success', 'message.created_successfully');

            return $this->redirectToRoute('play_index');
        }

        return $this->render(
            'play/add.html.twig',
            [
                'play' => $play,
                'form' => $form->createView(),
            ]
        );
    }
    /**
     * Delete action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request HTTP Request
     * @param integer                                   $play    Play
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route(
     *     "/{id}/delete",
     *     name="play_delete",
     *     requirements={"page": "[1-9]\d*"},
     * )
     * @Method({"GET", "POST"})
     */
    public function deleteAction(Request $request, Play $play)
    {
        $form = $this->createForm(FormType::class, $play);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('app.repository.play')->delete($play);
            $this->addFlash('success', 'message.deleted_successfully');

            return $this->redirectToRoute('play_index');
        }

        return $this->render(
            'play/delete.html.twig',
            [
                'play' => $play,
                'form' => $form->createView(),
            ]
        );
    }
}
