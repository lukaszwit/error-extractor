<?php
/**
 * Created by lukaszwitczak.
 */

namespace Lukaszwit\ErrorExtractor\Type;

use Symfony\Component\Validator\ConstraintViolation;

class SimpleViolation
{
    /** @var string */
    private $pluralTemplate;
    /** @var  string */
    private $errorName;
    /** @var ConstraintViolation */
    private $violation;

    public function __construct($errorName, ConstraintViolation $violation, $pluralTemplate)
    {
        $this->errorName = $errorName;
        $this->violation = $violation;
        $this->pluralTemplate = $pluralTemplate;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->violation->getMessage();
    }

    /**
     * @return mixed
     */
    public function getPluralTemplate()
    {
        return $this->pluralTemplate;
    }

    /**
     * @return mixed
     */
    public function getTemplateParameters()
    {
        return $this->violation->getParameters();
    }

    /**
     * @return mixed
     */
    public function getPropertyPath()
    {
        return $this->violation->getPropertyPath();
    }

    /**
     * @return mixed
     */
    public function getInvalidValue()
    {
        return $this->violation->getInvalidValue();
    }

    public function getConstraintParams(): array
    {
        $params = [];
        $constraint = $this->violation->getConstraint();
        if (isset($constraint->min)) {
            $params['min'] = $constraint->min;
        }

        if (isset($constraint->max)) {
            $params['max'] = $constraint->max;
        }

        return $params;
    }

    public function toArray()
    {
        return [
            'message'         => $this->violation->getMessage(),
            'messageTemplate' => $this->violation->getMessageTemplate(),
            'params'          => $this->violation->getParameters(),
            'propertyPath'    => $this->violation->getPropertyPath(),
            'constraintParams'=> $this->getConstraintParams(),
        ];
    }
}
