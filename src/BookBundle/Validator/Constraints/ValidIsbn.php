<?php

namespace BookBundle\Validator\Constraints;


use Symfony\Component\Validator\Constraint;

/**
 * Simple validator
 *
 * @package BookBundle\Validator\Constraints
 * @author  Daniela Cruceanu
 * @Annotation
 */
class ValidIsbn extends Constraint
{
    public $message = 'Please insert a valid ISBN10';
}
