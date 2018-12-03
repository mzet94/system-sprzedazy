<?php
/**
 * Spectacle controller.
 */
namespace AppBundle\Controller;

use AppBundle\Entity\Spectacle;
use AppBundle\Form\SpectacleType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class SpectacleController.
 *
 * @Route("/spectacle")
 */
class SpectacleController extends Controller
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
     *     name="spectacle_index",
     * )
     * @Route(
     *     "/page/{page}",
     *     requirements={"page": "[1-9]\d*"},
     *     name="spectacle_index_paginated",
     * )
     * @Method("GET")
     */
    public function indexAction($page)
    {
        $spectacles = $this->get('app.repository.spectacle')->findAllPaginated($page);

        return $this->render(
            'spectacle/index.html.twig',
            ['spectacles' => $spectacles]
        );
    }

    /**
     * Index by play action.
     *
     * @param integer $page Current page number
     * @param integer $play Play
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route(
     *     "/play/{play}",
     *     defaults={"page": 1},
     *     name="spectacle_index_play",
     * )
     * @Route(
     *     "/play/{play}/page/{page}",
     *     requirements={"page": "[1-9]\d*"},
     *     name="spectacle_index_play_paginated",
     * )
     * @Method("GET")
     */
    public function indexByPlayAction($page, $play)
    {
        $spectacles = $this->get('app.repository.spectacle')->findByPlayPaginated($play, $page);

        return $this->render(
            'spectacle/index.html.twig',
            [
                'spectacles' => $spectacles,
                'playId' => $play,
            ]
        );
    }
    /**
     * Index by location action.
     *
     * @param integer $page     Current page number
     * @param string  $location Location
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route(
     *     "/location/{location}",
     *     defaults={"page": 1},
     *     name="spectacle_index_location",
     * )
     * @Route(
     *     "/location/{location}/page/{page}",
     *     requirements={"page": "[1-9]\d*"},
     *     name="spectacle_index_location_paginated",
     * )
     * @Method("GET")
     */
    public function indexByLocationAction($page, $location)
    {
        $spectacles = $this->get('app.repository.spectacle')->findByLocationPaginated($location, $page);

        return $this->render(
            'spectacle/index.html.twig',
            [
                'spectacles' => $spectacles,
                'locationId' => $location,
            ]
        );
    }
    /**
     * Index by director action.
     *
     * @param integer $page     Current page number
     * @param integer $director Director
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route(
     *     "/director/{director}",
     *     defaults={"page": 1},
     *     name="spectacle_index_director",
     * )
     * @Route(
     *     "/director/{director}/page/{page}",
     *     requirements={"page": "[1-9]\d*"},
     *     name="spectacle_index_play_paginated",
     * )
     * @Method("GET")
     */
    public function indexByDirectorAction($page, $director)
    {
        $spectacles = $this->get('app.repository.spectacle')->findByDirectorPaginated($director, $page);

        return $this->render(
            'spectacle/index.html.twig',
            [
               'spectacles' => $spectacles,
               'directorId' => $director,
            ]
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
     *     name="spectacle_add",
     * )
     * @Method({"GET", "POST"})
     */
    public function addAction(Request $request)
    {
        $spectacle = new Spectacle();
        $form = $this->createForm(SpectacleType::class, $spectacle);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('app.repository.spectacle')->save($spectacle);
            $this->addFlash('success', 'message.created_successfully');

            return $this->redirectToRoute('spectacle_index');
        }

        return $this->render(
            'spectacle/add.html.twig',
            [
                'spectacle' => $spectacle,
                'form' => $form->createView(),
            ]
        );
    }
    /**
     * Edit action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request   HTTP Request
     * @param integer                                   $spectacle Spectacle
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route(
     *     "/{id}/edit",
     *     name="spectacle_edit",
     *     requirements={"page": "[1-9]\d*"},
     * )
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Spectacle $spectacle)
    {
        $form = $this->createForm(SpectacleType::class, $spectacle);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('app.repository.spectacle')->save($spectacle);
            $this->addFlash('success', 'message.created_successfully');

            return $this->redirectToRoute('spectacle_index');
        }

        return $this->render(
            'spectacle/edit.html.twig',
            [
                'spectacle' => $spectacle,
                'form' => $form->createView(),
            ]
        );
    }
    /**
     * Delete action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request   HTTP Request
     * @param integer                                   $spectacle Spectacle
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route(
     *     "/{id}/delete",
     *     name="spectacle_delete",
     *     requirements={"page": "[1-9]\d*"},
     * )
     * @Method({"GET", "POST"})
     */
    public function deleteAction(Request $request, Spectacle $spectacle)
    {
        $form = $this->createForm(FormType::class, $spectacle);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('app.repository.spectacle')->delete($spectacle);
            $this->addFlash('success', 'message.deleted_successfully');

            return $this->redirectToRoute('spectacle_index');
        }

        return $this->render(
            'spectacle/delete.html.twig',
            [
                'spectacle' => $spectacle,
                'form' => $form->createView(),
            ]
        );
    }
}
