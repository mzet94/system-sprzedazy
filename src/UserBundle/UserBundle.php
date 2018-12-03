<?php
/**
 * User bundle
 */
namespace UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class UserBundle
 */
class UserBundle extends Bundle
{
    /**
     * get Parent
     *
     * @return Bundle
     */
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
