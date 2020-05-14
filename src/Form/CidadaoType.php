<?php

namespace App\Form;

use App\Enum\SexoEnum;
use App\Entity\Cidadao;
use App\Entity\Unidade;
use App\Enum\RaioXEnum;
use App\Enum\EvolucaoEnum;
use App\Form\Type\CpfType;
use App\Entity\Comorbidade;
use App\Enum\InternacaoEnum;
use App\Enum\VentilacaoEnum;
use App\Enum\ResultadoExameEnum;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class CidadaoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'nome',
                TextType::class, [
                    'label' => "Nome *",
                    'required' => true,
                ]
            )
            ->add(
                'cpf'
            )
            ->add(
                'dataNotificacao',
                DateType::class, 
                [
                    'label' => 'Data Notificação',
                    'widget' => 'single_text',
                    'format' => 'yyyy-MM-dd',
                ]
            )
            ->add('sivep')
            ->add(
                'idade',
                NumberType::class, [
                    'label' => "Idade (anos)",
                    'required' => true,
                ]
            )
            ->add(
                'sexo',
                ChoiceType::class, 
                [
                    'label'=>'Sexo *',
                    'choices' => array_flip(SexoEnum::getTipo()),
                    'placeholder' => 'Selecione'
                ]
            )
            ->add(
                'dataInicioSintoma',
                DateType::class, 
                [
                    'label' => 'Início do Sintoma',
                    'widget' => 'single_text',
                    'format' => 'yyyy-MM-dd',
                ]
            )
            ->add(
                'internacaoUti',
                ChoiceType::class, 
                [
                    'label' => 'Internação UTI?',
                    'choices' => array_flip(InternacaoEnum::getTipo()),
                    'placeholder' => 'Selecione',                
                ]
            )
            ->add(
                'usoSuporteVentilatorio',
                ChoiceType::class, 
                [
                    'label'=>'Ventilação *',
                    'choices' => array_flip(VentilacaoEnum::getTipo()),
                    'placeholder' => 'Selecione'
                ]
            )
            ->add(
                'raioX',
                ChoiceType::class, 
                [
                    'label'=>'Raio X *',
                    'choices' => array_flip(RaioXEnum::getTipo()),
                    'placeholder' => 'Selecione'
                ]
            )
            ->add(
                'resultadoExame',
                ChoiceType::class, 
                [
                    'label'=>'Resultado Exame *',
                    'choices' => array_flip(ResultadoExameEnum::getTipo()),
                    'required' => false,
                ]
            )
            ->add(
                'evolucao',
                ChoiceType::class, 
                [
                    'label'=>'Evolução *',
                    'choices' => array_flip(EvolucaoEnum::getTipo()),
                    'required' => false,
                ]
            )
            ->add(
                'dataEvolucao',
                DateType::class, 
                [
                    'label' => 'Data Evolução',
                    'widget' => 'single_text',
                    'format' => 'yyyy-MM-dd',
                    'required' => false,
                ]
            )
            ->add(
                'unidade',
                EntityType::class,
                [
                    'class' => Unidade::class,
                    'choice_label' => 'nome',
                    'placeholder' => 'Selecione *'

                ]
            )
            ->add(
                'observacao',
                CKEditorType::class, [
                    'label' => 'Observação',
                    'config' => [
                        'uiColor' => '#ffffff',
                    ],
                ]
            )
            ->add('telefone')
            ->add('bairro')
            ->add(
                'comorbidade',
                EntityType::class,
                [
                    'class' => Comorbidade::class,
                    'choice_label' => 'nome',
                    'multiple' => true,
                    'required' => false

                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cidadao::class,
        ]);
    }
}
