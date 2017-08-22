<?php
/**
 * Created by lukaszwitczak.
 */

namespace Lukaszwit\ErrorExtractor;


use Lukaszwit\ErrorExtractor\Type\SimpleViolation;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Validator\ConstraintViolation;

class ViolationSimplifier
{
    public static function simplify(ConstraintViolation ...$violations): array
    {
        $simpleViolations = [];
        foreach ($violations as $violation) {
            $errorName = ViolationCodifier::getErrorName($violation);

            $tr = new Translator('en');
            $pluralMessageTemplate = $tr->transChoice($violation->getMessageTemplate(), $violation->getInvalidValue());

            $simpleViolations[] = new SimpleViolation(
                $errorName, $violation, $pluralMessageTemplate
            );
        }

        return $simpleViolations;
    }
}
