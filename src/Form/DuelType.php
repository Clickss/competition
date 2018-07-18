<?php

namespace App\Form;

use App\Entity\Duel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DuelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder        
            ->add('typeduel')        
            ->add('equipe1')
            ->add('equipe2')
            ->add('horaire')
            ->add('score_equipe1')
            ->add('score_equipe2')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Duel::class,
        ]);
    }
}
