<?php
/**
 * Custom form handler for FOSUserBundle
 */
namespace AppBundle\Form\Handler;

use FOS\UserBundle\Form\Handler\RegistrationFormHandler as BaseHandler;
use FOS\UserBundle\Model\UserInterface;

/**
 * Class RegistrationFormHandler.
 *
 */
class RegistrationFormHandler extends BaseHandler
{
    /**
     * BuildForm
     *
     * @param UserInterface $user
     * @param string        $confirmation
     */
    protected function onSuccess(UserInterface $user, $confirmation)
    {
        $user->setRoles(['ROLE_USER']);
        parent::onSuccess($user, $confirmation);
    }
}
