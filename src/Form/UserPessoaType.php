<?php

namespace App\Form;

use App\Entity\Pessoa;
use App\Enum\RolesEnum;
use App\Entity\UserPessoa;
use App\Form\Type\CpfType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UserPessoaType extends AbstractType
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'cpf',
                CpfType::class,
                [
                    'required' => true,
                    'attr' => [
                        'readonly' => true
                    ]
                ]
            )
            ->add(
                'password',
                RepeatedType::class, 
                [
                    'type' => PasswordType::class,
                    'label' => false,
                    'first_options'  => [
                        'label' => 'Senha',
                        'required' => true
                    ],
                    'second_options' => [
                        'label' => 'Repetir Senha',
                        'required' => true
                    ],
                ]
            )
        ;
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) 
            {
                $form = $event->getForm();
                if ($this->security->isGranted('ROLE_ADMIN')) {
                    $form
                        ->add(
                            'cpf',
                            CpfType::class,
                            [
                                'required' => true,
                            ]
                        )                        
                        ->add(
                            'roles',
                            ChoiceType::class,
                            [
                                'choices' => RolesEnum::getRoles(),
                                'multiple' => true,
                                'label' => 'Nível',
                                'required' => true
                            ]
                        )
                    ;
                }
            }
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserPessoa::class,
        ]);
    }
}
