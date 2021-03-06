
## Installing

```bash
composer require 'lukaszwit/error-extractor'
```

## Usage

```php
$validator = \Symfony\Component\Validator\Validation::createValidator();
$violations = $validator->validate('Bernhard', array(
    new \Symfony\Component\Validator\Constraints\Length(array('min' => 10)),
));

$simpleViolations = \Lukaszwit\ErrorExtractor\ViolationSimplifier::simplify(...$violations);

```

## Running tests

To run test without code coverage:
```bash
vendor/bin/phpunit --no-coverage
```

To run test with code coverage:
```bash
phpdbg -qrr ./vendor/bin/phpunit
```
