<?php

namespace App\Form;

use App\Entity\Clients;
use App\Entity\Option;
use App\Entity\Projects;
use App\Entity\TypeProjet;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ProjectType extends AbstractType
{

    public function __construct(private UrlGeneratorInterface $urlGenerator)
    {
        
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code')
            ->add('DateEntree',DateTimeType::class,[
                'date_widget' => 'single_text',
                'time_widget' => 'single_text',
                'days' => range(1,31),
                'years' => range(1970,2100),
            ])
            ->add('DateDelai',DateTimeType::class,[
                'years' => range(1970,2100),
            ])

            ->add('description')
//            ->add('options' , EntityType:: class, [
//                'class' => Option::class,
//                'choice_label' => 'name',
//                'multiple' => true,
//                'required' => false,
//
//            ])
            ->add('options' , SearchableEntityType::class, [
                'class'=> Option::class,
                'multiple' => true,
                'search' => $this->urlGenerator->generate("api_options"),
                'label_property' =>'name'
            ])
            ->add("TypeProjet", EntityType::class, [
                'choice_label' => 'name',
                'class' => TypeProjet::class,
                'required' => false
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
