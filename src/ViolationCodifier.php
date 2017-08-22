<?php
/**
 * Created by lukaszwitczak.
 */

namespace Lukaszwit\ErrorExtractor;

use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationList;

class ViolationCodifier
{
    public static function codfiyViolations(ConstraintViolation ...$violations): array
    {
        $codifiedViolations = [];
        foreach ($violations as $violation) {
            $errorName = self::getErrorName($violation);
            $codifiedViolations[$errorName] = $violation;
        }

        return $codifiedViolations;
    }

    /**
     * @param $violation
     * @return string
     */
    public static function getErrorName(ConstraintViolation $violation): string
    {
        $errorCode = $violation->getCode();
        /** @var \Symfony\Component\Validator\Constraint $constraint */
        $constraint = $violation->getConstraint();
        $errorName = $constraint::getErrorName($errorCode);

        return $errorName;
    }

}
