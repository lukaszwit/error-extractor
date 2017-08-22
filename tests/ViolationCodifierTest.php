<?php
/**
 * Created by lukaszwitczak.
 */

namespace Lukaszwit\ErrorExtractor;


class ViolationCodifierTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function getErrorName()
    {
        $validator = \Symfony\Component\Validator\Validation::createValidator();
        $violations = $validator->validate(
            'Bernhard',
            [
                new \Symfony\Component\Validator\Constraints\Length(['min' => 10]),
            ]
        );
        $violation = $violations[0];
        $errorName = ViolationCodifier::getErrorName($violation);
        $this->assertEquals('TOO_SHORT_ERROR', $errorName);
    }

    /**
     * @test
     */
    public function codifyViolations()
    {
        $validator = \Symfony\Component\Validator\Validation::createValidator();
        $violations = $validator->validate(
            'Bernhard',
            [
                new \Symfony\Component\Validator\Constraints\Length(['min' => 10]),
            ]
        );
        $result = ViolationCodifier::codfiyViolations(...$violations);
        $this->assertEquals('TOO_SHORT_ERROR', key($result));
    }
}
