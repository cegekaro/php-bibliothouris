<?php


namespace BookBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class BookTask extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', 'text')
            ->add('authorLastName', 'text')
            ->add('authorFirstName', 'text')
            ->add('isbn', 'text')
            ->add('save', 'submit', array('label' => 'Save'));
    }

    public function getName()
    {
        return "book";
    }
}
