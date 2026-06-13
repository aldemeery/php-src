--TEST--
#[\NoDiscard] effect inheritance: concrete parent declares, override warns (BC-affecting)
--FILE--
<?php

class Base
{
    #[\NoDiscard("must be checked")]
    public function m(): object { return new stdClass; }
}

class Derived extends Base
{
    public function m(): object { return new stdClass; }
}

// Prior to effect inheritance this override silently dropped the contract.
(new Derived())->m();

echo "done\n";

?>
--EXPECTF--
Warning: The return value of method Derived::m() should either be used or intentionally ignored by casting it as (void), must be checked in %s on line %d
done
