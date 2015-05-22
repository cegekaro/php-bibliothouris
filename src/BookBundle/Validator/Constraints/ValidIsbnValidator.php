<?php

namespace BookBundle\Validator\Constraints;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Governs the custom validation methods for ISBN
 *
 * @package BookBundle\Validator\Constraints
 * @author  Daniela Cruceanu
 *
 */
class ValidIsbnValidator extends ConstraintValidator
{

    const NUMBER_OF_DIGITS = 10;
    const MULTIPLE_NUMBER = 11;

    public function validate($value, Constraint $constraint)
    {
        if (!preg_match('/^[0-9-]+$/', $value, $matches) || !($this->isValidIsbn10($value))) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('%string%', $value)->addViolation();
        }
    }

    public function isValidIsbn10($value)
    {
        $sum        = 0;
        $nrOfDigits = 0;
        for ($i = 0; $i < strlen($value); $i++) {
            if (is_numeric($value[$i])) {
                $sum = $sum + $value[$i];
                $nrOfDigits++;
            }
        }

        if (($sum % self::MULTIPLE_NUMBER) != 0 || ($nrOfDigits != self::NUMBER_OF_DIGITS)) {
            return false;
        }

        return true;
    }

}
