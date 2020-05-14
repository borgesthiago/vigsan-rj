<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class CnpjValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (isset($value)) {
            if (!$this->validateCnpj($value)) {
                $this->context->buildViolation($constraint->message)
                    ->setParameter('{{ value }}',$value)
                    ->addViolation();
            }
        }
    }
    private function validateCnpj($cnpj)
    {
        $document = new \Bissolli\ValidadorCpfCnpj\CNPJ($cnpj);

        return $document->isValid();
    }
}