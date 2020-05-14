<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class CpfValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (isset($value)) {
            if (!$this->validateCpf($value)) {
                $this->context->buildViolation($constraint->message)
                    ->setParameter('{{ value }}', $value === null ? 'VAZIO' : $value)
                    ->addViolation();
            }
        }
    }
    private function validateCpf($cpf)
    {
        $document = new \Bissolli\ValidadorCpfCnpj\CPF($cpf);

        return $document->isValid();
    }
}