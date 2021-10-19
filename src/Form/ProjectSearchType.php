<?php

namespace App\Form;

use App\Entity\Option;
use App\Entity\ProjectSearch;

use App\Entity\TypeProjet;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('type', IntegerType::class, [
//                'required' => false,
//                'label' => false,
//                'attr' => [
//                    'placeholder' => 'type'
//                ]
//            ])
            ->add('TypeProjet', EntityType::class, [
                'required' => false,
                'label' => false,
                'class' => TypeProjet::class,
                'choice_label' => 'name',
                'multiple'  => false,
                'attr' => [
                    'placeholder' => 'type'
                ]
            ])
            ->add('options', EntityType::class, [
                'required' => false,
                'label' => 'false',
                'class' => Option::class,
                'choice_label' => 'name',
                'multiple' => true,
                'attr' => [
                    'placeholder' => 'Options'
                ]
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProjectSearch::class,
            'method' => 'GET',
            'csrf_protection' => false,
            'translation_domain' => 'forms'
        ]);
    }
    public function getBlockPrefix(): string
    {
        return '';
    }
}
