--TEST--
#[\NoDiscard] effect inheritance: abstract parent declares, concrete child warns
--FILE--
<?php

abstract class Validator
{
    #[\NoDiscard("the validation result must be checked")]
    abstract public function validate(): object;
}

class LenientValidator extends Validator
{
    public function validate(): object { return new stdClass; }
}

(new LenientValidator())->validate();

echo "done\n";

?>
--EXPECTF--
Warning: The return value of method LenientValidator::validate() should either be used or intentionally ignored by casting it as (void), the validation result must be checked in %s on line %d
done
