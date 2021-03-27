<?php

namespace App\Form;

use App\Entity\Clients;
use App\Entity\Option;
use App\Entity\Projects;
use App\Entity\TypeProjet;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code')
            ->add('DateEntree',DateTimeType::class,[
                'date_widget' => 'single_text',
                'time_widget' => 'single_text',
                'days' => range(1,15)
            ])
            ->add('DateDelai')
            ->add('Type')
            ->add('description')
            ->add('options' , EntityType:: class, [
                'class' => Option::class,
                'choice_label' => 'name',
                'multiple' => true,
                'required' => false
            ])

            ->add("TypeProjet", EntityType::class, [
                'choice_label' => 'name',
                'class' => TypeProjet::class
            ])
            ->add("Clients", EntityType::class, [
                'choice_label' => 'name',
                'class' => Clients::class,
                'multiple' => false,
                'required' => false,
                

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Projects::class,
            'translation_domain' => 'forms'
        ]);
    }
}
