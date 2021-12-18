<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Society;
use App\Repository\UserRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class SocietyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $this->societyId = $options['data']->getId();

        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'placeholder' => 'ex: Jean'
                ]
            ])
            ->add('address', TextType::class, [
                'label' => 'Adresse',
                'attr' => [
                    'placeholder' => 'ex: 18 rue de la joie'
                ]
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville',
                'attr' => [
                    'placeholder' => 'ex: Paris'
                ]
            ])
            ->add('postalCode', TextType::class, [
                'label' => 'Code Postal',
                'attr' => [
                    'placeholder' => 'ex: 75000'
                ]
            ])
            ->add('siret', IntegerType::class, [
                'label' => 'Siret',
                'attr' => [
                    'placeholder' => 'ex: 1435456878'
                ]
            ])
            ->add('manager', EntityType::class, [
                'label' => 'Gérant',
                'class' => User::class,
                'placeholder' => 'Choisir un gérant',
                'required' => false,
                'choice_label' => 'email',
                'query_builder' => function (UserRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->join('u.society','s')
                        ->where('u.society = :societyId')
                        ->setParameter('societyId', $this->societyId)
                        ->orderBy('u.email','ASC');
                },
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Society::class,
        ]);
    }
}
