<?php

namespace App\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class RemoveMaskTransformer implements DataTransformerInterface
{

    /**
     * Transforms an masked field
     *
     * @param  string|null $field
     * @return string
     */
    public function transform($field)
    {
        if (null === $field) {
            return null;
        }

        return preg_replace('/[^0-9]/', '', $field);
    }

    /**
     * Transforms a string (number) to an object (issue).
     *
     * @param  string $field
     * @return Issue|null
     * @throws TransformationFailedException if object (issue) is not found.
     */
    public function reverseTransform($field)
    {
        if (null === $field) {
            return null;
        }
        
        return preg_replace('/[^0-9]/', '', $field);
    }
}