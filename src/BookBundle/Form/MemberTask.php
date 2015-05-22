<?php


namespace BookBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class MemberTask extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('national_number', 'text')
            ->add('birth_date', 'date')
            ->add('last_name', 'text')
            ->add('first_name', 'text')
            ->add('street', 'text')
            ->add('postal_code', 'text')
            ->add('city', 'text')
            ->add('email', 'email')
            ->add('phone', 'text')
            ->add('save', 'submit', array('label' => 'Save'));
    }

    public function getName()
    {
        return "member";
    }
}
