<?php

namespace App\Form;

use App\Entity\Facture;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

use App\Entity\Contrat;

use App\Entity\Client;

class FactureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date_de_facture',DateTimeType::class)
            
            ->add('payee')
            ->add('client',EntityType::class,[
                'class'=>Client::class,
                'choice_label'=>'Npermis'
            ])
            ->add('contrat',EntityType::class,[
                'class'=>Contrat::class,
                'choice_label'=>'id'
            ])
        ;
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Facture::class,
        ]);
    }
}
