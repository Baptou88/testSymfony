<?php

namespace App\Form;

use App\Entity\Clients;
use App\Entity\Option;
use App\Entity\Projects;
use App\Entity\ProjectSearch;

use App\Entity\TypeProjet;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ProjectSearchType extends AbstractType
{
    public function __construct(private UrlGeneratorInterface $urlGenerator)
    {

    }
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
            ->add('projects', SearchableEntityType::class,[
                'class'=> Projects::class,
                'required' => false,
                'multiple' => true,
                'search' => $this->urlGenerator->generate("api_projects"),
                'label_property' =>'code'
            ])
            ->add('TypeProjet', EntityType::class, [
                'required' => false,
                'label' => false,
                'class' => TypeProjet::class,
                'choice_label' => 'name',
                'multiple'  => false,

                'placeholder' => 'type'
            ])
            ->add('options', EntityType::class, [
                'required' => false,
                'label' => 'Options',
                'class' => Option::class,
                'choice_label' => 'name',
                'multiple' => true,
                'placeholder' => 'Options',
                'attr' => [
                    //'placeholder' => 'Options'
                ]
            ])
            ->add('clients', EntityType::class,[
                'required' => false,
                'label' => 'Clients',
                'class' => Clients::class,
                'choice_label' => 'name',
                'multiple' => true,
                'placeholder' => 'Clients'
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
