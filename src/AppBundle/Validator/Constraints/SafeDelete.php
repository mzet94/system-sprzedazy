<?php
/**
 * SafeDelete.
 */

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Class SafeDeleteValidator
 *
 * @Annotation
 */
class SafeDelete extends Constraint
{
    /**
     * Message
     */
    public $message = 'Rekord powiązany z innymi danymi w bazie. Nie można go usunąć.';

    /**
     * Field
     */
    public $field;

    /**
     * Get Targets.
     *
     * @return Symfony\Component\Validator\Constraint
     */
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
