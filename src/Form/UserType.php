<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Society;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array(
                    'label' => 'Mot de passe : *',
                    'attr' => [
                        'class'=>'']
                ),
                'required' => true,
                'second_options' => array(
                    'label' => 'Confirmer le mot de passe : *',
                    'attr' => [
                        'class'=>'']
                ),
                'invalid_message' => 'Les mots de passe doivent être identique',
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Saisir votre mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit faire au moins {{ limit }} caractères',
                        'max' => 4096,
                    ]),
                ],
            ))
            /* ->add('society', EntityType::class, [
                'label' => 'Société',
                'class' => Society::class,
                'placeholder' => 'Choisir une société',
                'required' => false,
                'choice_label' => 'name'
            ]) */
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
