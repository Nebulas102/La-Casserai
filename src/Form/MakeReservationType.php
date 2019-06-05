<?php

namespace App\Form;

use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
class MakeReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('checkinDate', DateType::class ,['widget' => 'single_text', 'attr' => ['class' => 'js-datepicker form', 'min' => date('Y-m-d')]])
            ->add('checkoutDate', DateType::class ,['widget' => 'single_text', 'attr' => ['class' => 'js-datepicker form', 'min' => date('Y-m-d')]])
            ->add('save', SubmitType::class, ['label' => 'Start Booking'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
