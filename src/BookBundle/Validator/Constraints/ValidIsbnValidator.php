<?php

namespace BookBundle\Validator\Constraints;


use Symfony\Component\Validator\Constraint;
/**
 * Contains the validation for the isbn
 *
 * @package BookBundle\Service
 * @author  Daniela Cruceanu
 * @Annotation
 */
class ValidIsbnValidator extends Constraint
{

    public function validate($value, Constraint $constraint)
    {
        if (!preg_match('/^[0-9]+$/', $value, $matches) || !($this->isValidIsbn10($value))) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('%string%', $value)->addViolation();
        }
    }

    public function isValidIsbn10($value)
    {
        $sum = 0;
        for ($i = 0; $i < $value . length(); $i++) {
            if (is_int($value[$i])) {
                $sum = $sum + $i;
            }
        }

        if ($sum % 11 != 0) {
            return false;
        }

        return true;
    }

}
