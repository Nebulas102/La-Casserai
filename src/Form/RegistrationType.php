<?php

namespace App\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username');
        $builder->add('email');
        $builder->add('tel_nr');
        $builder->add('mobile_nr');
        $builder->add('first_name');
        $builder->add('insertion_name');
        $builder->add('last_name');
        $builder->add('address');
        $builder->add('zip');
        $builder->add('city');
        $builder->add('country');
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }
    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}
