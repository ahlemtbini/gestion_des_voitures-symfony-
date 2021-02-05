<?php

namespace App\Form;

use App\Entity\Contrat;
use App\Entity\Client;
use App\Entity\Facture;

use App\Entity\Voiture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ContratType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date_depart',DateTimeType::class)
            ->add('date_retour',DateTimeType::class,array('attr' => array('min' => 'date_depart')))
            ->add('km_depart',IntegerType::class)
            ->add('km_retour',IntegerType::class)

            ->add('voiture',EntityType::class,[
                'class'=>Voiture::class,
                'choice_label'=>'matricule'
            ])
            ->add('client',EntityType::class,[
                'class'=>Client::class,
                'choice_label'=>'id'
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contrat::class,
        ]);
    }
}
