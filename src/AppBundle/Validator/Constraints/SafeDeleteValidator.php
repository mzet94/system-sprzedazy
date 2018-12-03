<?php
/**
 * SafeDelete Validator.
 */

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\PropertyAccess\PropertyAccess;

/**
 * Class SafeDeleteValidator
 *
 * @Annotation
 */
class SafeDeleteValidator extends ConstraintValidator
{
    /**
     * Validate.
     *
     * @param int        $value      Value
     * @param Constraint $constraint Constraint
     */
    public function validate($value, Constraint $constraint)
    {
        $accessor = PropertyAccess::createPropertyAccessor();

        $relatedFields = $accessor->getValue($value, $constraint->field);
        $counted = $relatedFields->count();


        if ($counted) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}
