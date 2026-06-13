--TEST--
#[\NoDiscard] effect inheritance: reason resolved through an intermediate abstract class
--FILE--
<?php

interface Source
{
    #[\NoDiscard("the source reason")]
    public function g(): object;
}

abstract class Middle implements Source {}

class Concrete extends Middle
{
    public function g(): object { return new stdClass; }
}

// Concrete has no own attribute and Middle does not redeclare g(); the walk
// passes through Middle (no attribute) and finds the interface declaration.
(new Concrete())->g();

echo "done\n";

?>
--EXPECTF--
Warning: The return value of method Concrete::g() should either be used or intentionally ignored by casting it as (void), the source reason in %s on line %d
done
