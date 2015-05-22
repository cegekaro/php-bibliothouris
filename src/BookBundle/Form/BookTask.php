<?php


namespace BookBundle\Form;


use Doctrine\Common\Collections\ArrayCollection;
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
            ->add('publisher', 'text')
            ->add('pages', 'number')
            ->add('categories', 'entity', array(
                'class' => 'BookBundle\Entity\Category',
                'property' => 'name',
                'multiple' => true,
                'expanded' => true
            ))
            ->add('publication_date', 'date')
            ->add('save', 'submit', array('label' => 'Save'));
    }

    public function getName()
    {
        return "book";
    }
}
