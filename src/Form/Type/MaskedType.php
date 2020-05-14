<?php
namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class MaskedType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $transformer = new \App\Form\DataTransformer\RemoveMaskTransformer();
        $builder->addModelTransformer($transformer);
    }
    
    public function getParent()
    {
        return TextType::class;
    }
}