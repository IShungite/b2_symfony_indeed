<?php

namespace App\Form;

use App\Entity\ContractType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class ContractTypeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', ChoiceType::class, [
                'choices'  => [
                    'Temps plein' => 'Temps plein',
                    'Temps partiel' => 'Temps partiel',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ContractType::class,
        ]);
    }
}
