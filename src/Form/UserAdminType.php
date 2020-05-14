<?php

namespace App\Form;

use App\Entity\Setor;
use App\Enum\CargoEnum;
use App\Enum\RolesEnum;
use App\Enum\StatusEnum;
use App\Entity\UserAdmin;
use App\Form\Type\CelularType;
use App\Form\Type\TelefoneType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UserAdminType extends AbstractType
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
                'login',
                null,
                [
                    'label' => 'Login',
                    'required' => true
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
            ->add(
                'nome',
                TextType::class, [
                    'label' => "Nome *",
                    'required' => true,
                ]
            )
            ->add(
                'status',
                ChoiceType::class, 
                [
                    'label'=>'Status *',
                    'choices' => array_flip(StatusEnum::getStatus()),
                    'placeholder' => 'Selecione'
                ]
            )
            ->add('logradouro')
            ->add(
                'numero',
                null,
                [
                    'label' => 'Número',
                    'required' => false
                ]
            )
            ->add('complemento')
            ->add('bairro')
            ->add('cidade')
            ->add('uf')
            ->add('cep')
            ->add(
                'telefone',
                TelefoneType::class,
                [
                    'required' => false
                ]
            )
            ->add(
                'celular',
                CelularType::class,
                [
                    'required' => false
                ]
            )
            ->add(
                'email', 
                EmailType::class, 
                [
                    'label' => 'E-mail *',
                    'required' => true,
                ]
            )
            ->add(
                'cargo',
                ChoiceType::class,
                [
                    'label'=>'Cargo *',
                    'choices' => array_flip(CargoEnum::getCargo()),
                    'placeholder' => 'Selecione'
                ]
            )
        ;
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $form = $event->getForm();            
            if ($this->security->isGranted('ROLE_ADMIN')) {
                $form
                ->add(
                    'roles',
                ChoiceType::class,
                [
                    'choices' => RolesEnum::getRoles(),
                    'multiple' => true,
                    'label' => 'Nível'
                ]
                );
            } else  {
                $form->add(
                    'roles',
                    HiddenType::class,
                    [
                        'label' => false,
                        'mapped' => false
                    ]

                );
            }
            }
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserAdmin::class,
        ]);
    }
}
