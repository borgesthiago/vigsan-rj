<?php
namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CpfType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'attr' => array(
                'class' => 'masked-field',
                'data-mask' => "000.000.000-00",
                'data-mask-reverse' => "true"
            )
        ));
    }
    
    public function getParent()
    {
        return MaskedType::class;
    }
}