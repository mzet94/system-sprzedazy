<?php
/**
 * User controller.
 */

namespace UserBundle\Controller;

use UserBundle\Entity\User;
use AppBundle\Entity\Detail;
use AppBundle\Form\DetailType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class UserController.
 *
 * @Route("/user")
 */
class UserController extends Controller
{
    /**
     * Index action.
     *
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route(
     *     "/",
     *     name="user_index",
     * )
     * @Method("GET")
     */
    public function indexAction()
    {
        $userManager = $this->get('fos_user.user_manager');
        $users = $userManager->findUsers();

        return $this->render(
            'user/index.html.twig',
            ['users' => $users]
        );
    }

    /**
     * Add user detail action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request HTTP Request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route(
     *     "/add/detail",
     *     name="detail_add",
     * )
     * @Method({"GET", "POST"})
     */
    public function addDetailAction(Request $request)
    {
        $currentUser = $this->container->get('security.token_storage')->getToken()->getUser();
        if (!$currentUser) {
            $this->addFlash('error', 'message.error_view');
        } else {
            $details = new Detail();
            $details->setFosUser($currentUser);
            $form = $this->createForm(DetailType::class, $details);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $this->get('app.repository.detail')->save($details);
                //  $id = $details->getId();
                $this->addFlash('success', 'message.created_successfully');

                return $this->redirectToRoute(
                    'fos_user_profile_show'
                );
            }

            return $this->render(
                'user/detail.html.twig',
                [
                    'detail' => $details,
                    'form' => $form->createView(),
                ]
            );
        }
    }

    /**
     * Change permission admin action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request HTTP Request
     * @param \AppBundle\Entity\User                    $user    User entity
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route(
     *     "/{id}/add/permission",
     *     requirements={"id": "[1-9]\d*"},
     *     name="add_admin",
     * )
     * @Method({"GET", "POST"})
     */
    public function addAdminAction(Request $request, User $user)
    {
        $currentUser = $this->getUser();
        if ($currentUser === $user) {
            $this->addFlash('danger', 'message.cant_remove_role');

            return $this->redirectToRoute('user_index');
        }
        if ($user->hasRole('ROLE_ADMIN')) {
            $this->addFlash('danger', 'message.user_is_admin');

            return $this->redirectToRoute('user_index');
        }
        $userManager = $this->get('fos_user.user_manager');
        $user->addRole('ROLE_ADMIN');
        $userManager->updateUser($user);
        $this->addFlash('success', 'message.update_admin_user');

        return $this->redirectToRoute('user_index');
    }

    /**
     * Change permission user action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request HTTP Request
     * @param \AppBundle\Entity\User                    $user    User entity
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route(
     *     "/{id}/permission/user",
     *     requirements={"id": "[1-9]\d*"},
     *     name="add_user",
     * )
     * @Method({"GET", "POST"})
     */
    public function removeAdminAction(Request $request, User $user)
    {
        $currentUser = $this->getUser();
        if ($currentUser === $user) {
            $this->addFlash('danger', 'message.cant_remove_role');

            return $this->redirectToRoute('user_index');
        }
        if (!$user->hasRole('ROLE_ADMIN')) {
            $this->addFlash('danger', 'message.user_is_user');

             return $this->redirectToRoute('user_index');
        }
        $userManager = $this->get('fos_user.user_manager');
        $user->removeRole('ROLE_ADMIN');
        $userManager->updateUser($user);
        $this->addFlash('success', 'message.update_normal_user');

        return $this->redirectToRoute('user_index');
    }

    /**
     * Delete action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request  HTTP Request
     * @param string                                    $username Username
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route(
     *     "/{username}/delete",
     *     name="user_delete",
     * )
     * @Method({"GET", "POST"})
     */
    public function deleteAction(Request $request, $username)
    {
        $userManager = $this->get('fos_user.user_manager');

        $user = $userManager->findUserByUsername($username);
        $users = $userManager->findUsers();
        if (!$user) {
            $this->addFlash('error', 'message.error_view');
        } else {
            if (count($users) > 1) {
                $form = $this->createForm(FormType::class, $user);
                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid()) {
                    $userManager->deleteUser($user);
                    $this->addFlash('success', 'message.deleted_successfully');

                    return $this->redirectToRoute('user_index');
                }

                return $this->render(
                    'user/delete.html.twig',
                    [
                        'user' => $user,
                        'form' => $form->createView(),
                    ]
                );
            } else {
                $this->addFlash('warning', 'message.cant_delete');

                return $this->redirectToRoute('user_index');
            }
        }
    }
}
