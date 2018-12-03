<?php
/**
 * Transaction controller.
 */
namespace AppBundle\Controller;

use AppBundle\Entity\Spectacle;

use AppBundle\Entity\Transaction;
use AppBundle\Entity\Status;
use AppBundle\Form\TransactionType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class TransactionController.
 *
 * @Route("/transaction")
 */
class TransactionController extends Controller
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
     *     name="transaction_index",
     * )
     * @Route(
     *     "/page/{page}",
     *     requirements={"page": "[1-9]\d*"},
     *     name="transaction_index_paginated",
     * )
     * @Method("GET")
     */
    public function indexAction($page)
    {
        $transactions = $this->get('app.repository.transaction')->findAllPaginated($page);

        return $this->render(
            'transaction/index.html.twig',
            ['transactions' => $transactions]
        );
    }

    /**
     * Index by user action.
     *
     * @param integer $page Current page number
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route(
     *     "/index/",
     *     defaults={"page": 1},
     *     name="my_transaction",
     * )
     * @Route(
     *     "/index/page/{page}",
     *     requirements={"page": "[1-9]\d*"},
     *     name="my_transaction_paginated",
     * )
     * @Method("GET")
     */
    public function indexByUserAction($page)
    {
        $userId = $this->getUser()->getId();
        $transactions = $this->get('app.repository.transaction')->findByUserPaginated($userId, $page);

        return $this->render(
            'transaction/index_user.html.twig',
            [
                'transactions' => $transactions,
                'userId' => $userId,
            ]
        );
    }

    /**
     * View after transaction action.
     *
     * @param integer $transaction Transaction
     *
     * @return \Symfony\Component\HttpFoundation\Response Response
     *
     * @Route(
     *     "/confirmation/{transaction}",
     *     name="transaction_accept"
     * )
     */
    public function confirmationAction(Transaction $transaction)
    {
        $currentUser = $this->container->get('security.token_storage')->getToken()->getUser();
        if (!$currentUser) {
            $this->addFlash('error', 'message.error.not.allow');
        } else {
            $this->addFlash('success', 'message.order_created_successfully');
            $transaction = $this->get('app.repository.transaction')->findOneById($transaction);
            $spectacle = $transaction->getSpectacle();
            $tickets = $transaction->getNumberOfTickets();
            $price = $transaction->getSingleTicketPrice();
            $money = $tickets * $price;
            if (!$transaction) {
                $this->addFlash('error', 'message.error.not.allow');
            } else {
                return $this->render(
                    'transaction/confirmation.html.twig',
                    [
                        'transaction' => $transaction,
                        'spectacle' => $spectacle,
                        'money' => $money,
                    ]
                );
            }
        }
    }

    /**
     * View after transaction action.
     *
     * @param integer $transaction Transaction
     *
     * @return \Symfony\Component\HttpFoundation\Response Response
     *
     * @Route(
     *     "/view/{transaction}",
     *     name="transaction_view"
     * )
     */
    public function viewAction(Transaction $transaction)
    {
        $currentUser = $this->container->get('security.token_storage')->getToken()->getUser();
        if (!$currentUser) {
            $this->addFlash('error', 'message.error.not.allow');
        } else {
            $transaction = $this->get('app.repository.transaction')->findOneById($transaction);
            $spectacle = $transaction->getSpectacle();
            $tickets = $transaction->getNumberOfTickets();
            $price = $transaction->getSingleTicketPrice();
            $money = $tickets * $price;
            if (!$transaction) {
                $this->addFlash('error', 'message.error.not.allow');
            } else {
                return $this->render(
                    'transaction/view.html.twig',
                    [
                        'transaction' => $transaction,
                        'spectacle' => $spectacle,
                        'money' => $money,
                        'user' => $currentUser,
                    ]
                );
            }
        }
    }

    /**
     * Add action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request   HTTP Request
     * @param integer                                   $spectacle Spectacle
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route(
     *     "/{spectacle}/add",
     *     name="transaction_add",
     * )
     * @Method({"GET", "POST"})
     */
    public function addAction(Request $request, Spectacle $spectacle)
    {
        $currentUser = $this->container->get('security.token_storage')->getToken()->getUser();
        $spectacleId = $this->get('app.repository.spectacle')->findOneById($spectacle);
        $transaction = new Transaction();
        $status = $this->get('app.repository.status')->findOneById(5);
        $transaction->setUser($currentUser);
        $transaction->setStatus($status);
        $transaction->setSpectacle($spectacle);
        $price = $this->get('app.repository.spectacle')->findOneById($spectacle)->getPrice();
        $seats = $this->get('app.repository.spectacle')->findOneById($spectacle)->getSeats();
        $transaction->setSingleTicketPrice($price);
        $form = $this->createForm(TransactionType::class, $transaction);
        $form->remove('status');
        $form->handleRequest($request);
        $amount = $transaction->getNumberOfTickets();
        if ($amount <= $seats) {
            if ($form->isSubmitted() && $form->isValid()) {
                //   $transaction->setTransactionDetails($detail);
                $this->get('app.repository.transaction')->save($transaction);
                $newSeats = $seats - $amount;
                $spectacle->setSeats($newSeats);
                $this->get('app.repository.spectacle')->save($spectacle);
                $idT = $transaction->getId();

                return $this->redirectToRoute(
                    'transaction_accept',
                    array('transaction' => $idT)
                );
            }
        } else {
            $this->addFlash('warning', 'message.order_error');
        }

        return $this->render(
            'transaction/add.html.twig',
            [
                'spectacle' => $spectacleId,
                'transaction' => $transaction,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * Edit status action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request     HTTP Request
     * @param integer                                   $transaction Transaction
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route(
     *     "/{id}/status",
     *     name="status_edit",
     *     requirements={"page": "[1-9]\d*"},
     * )
     * @Method({"GET", "POST"})
     */
    public function editStatusAction(Request $request, Transaction $transaction)
    {
        $form = $this->createForm(TransactionType::class, $transaction);
        $form->remove('collection');
        $form->remove('numberOfTickets');
        $form->remove('paymentmethod');
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('app.repository.transaction')->save($transaction);
            $this->addFlash('success', 'message.created_successfully_change');

            return $this->redirectToRoute('transaction_index');
        }

        return $this->render(
            'transaction/edit.html.twig',
            [
                'transaction' => $transaction,
                'form' => $form->createView(),
            ]
        );
    }
}
