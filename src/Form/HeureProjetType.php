<?php

namespace App\Form;

use App\Entity\HeureProjet;
use App\Entity\Projects;
use App\Entity\Users;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HeureProjetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Date')
            ->add('duree')
            ->add('isHidden')
            ->add('Employe',EntityType::class ,[
                "class" => Users::class,
                "choice_label" => 'username'
            ])
            ->add('project', EntityType::class ,[
                "class" => Projects::class,
                "choice_label" => 'code'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => HeureProjet::class,
        ]);
    }
}
