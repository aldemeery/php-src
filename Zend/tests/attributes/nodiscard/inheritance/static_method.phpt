--TEST--
#[\NoDiscard] effect inheritance: static method override warns
--FILE--
<?php

class Base
{
    #[\NoDiscard("the created value must be used")]
    public static function make(): object { return new stdClass; }
}

class Derived extends Base
{
    public static function make(): object { return new stdClass; }
}

Derived::make();

echo "done\n";

?>
--EXPECTF--
Warning: The return value of method Derived::make() should either be used or intentionally ignored by casting it as (void), the created value must be used in %s on line %d
done
