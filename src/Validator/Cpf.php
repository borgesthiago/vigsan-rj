<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Cpf extends Constraint
{
    /*
     * Any public properties become valid options for the annotation.
     * Then, use these in your validator class.
     */
    public $message = 'O cpf "{{ value }}" não é válido.';

    public function validatedBy()
    {
        return get_class($this).'Validator';
    }
}