<?php
/**
 * Created by lukaszwitczak.
 */

class ViolationSimplifierTest extends \PHPUnit\Framework\TestCase
{
    public function validator_Success()
    {
        $validator = \Symfony\Component\Validator\Validation::createValidator();
        $violations = $validator->validate('Bernhard', array(
            new \Symfony\Component\Validator\Constraints\Length(array('min' => 10)),
            new \Symfony\Component\Validator\Constraints\NotBlank(),
        ));

        //dump($violations);
        /** @var \Symfony\Component\Validator\Constraint $constraint */
        $constraint = $violations[0]->getConstraint();

        //dump($violations);
        $errorCode = $violations[0]->getCode();

        $errorName = $constraint->getErrorName($errorCode);
        //dump($errorName);

        $result = Lukaszwit\ErrorExtractor\ViolationCodifier::codfiyViolations(...$violations);
        //dump($result);

        $result = \Lukaszwit\ErrorExtractor\ViolationSimplifier::simplify(...$violations);
        dump($result);
        dump($result[0]->toArray());

    }

    /**
     * @test
     */
    public function validator_MinConstraint()
    {
        $validator = \Symfony\Component\Validator\Validation::createValidator();
        $violations = $validator->validate('Bernhard', array(
            new \Symfony\Component\Validator\Constraints\Length(array('min' => 10)),
        ));

        $simiplifiedViolations = \Lukaszwit\ErrorExtractor\ViolationSimplifier::simplify(...$violations);
        $this->assertEquals(1, count($simiplifiedViolations));
        /** @var \Lukaszwit\ErrorExtractor\Type\SimpleViolation $simplifiedViolation */
        $simplifiedViolation = $simiplifiedViolations[0];
        $simplifiedViolation = $simplifiedViolation->toArray();
        $this->assertArrayHasKey('message', $simplifiedViolation);
        $this->assertArrayHasKey('messageTemplate', $simplifiedViolation);
        $this->assertArrayHasKey('params', $simplifiedViolation);
        $this->assertArrayHasKey('propertyPath', $simplifiedViolation);
        $this->assertArrayHasKey('constraintParams', $simplifiedViolation);

    }
}
