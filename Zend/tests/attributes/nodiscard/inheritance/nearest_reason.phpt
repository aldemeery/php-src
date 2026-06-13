--TEST--
#[\NoDiscard] effect inheritance: nearest declaration's reason is surfaced
--FILE--
<?php

class Base
{
    #[\NoDiscard("base reason")]
    public function m(): object { return new stdClass; }
}

class Specialized extends Base
{
    #[\NoDiscard("specialized reason")]
    public function m(): object { return new stdClass; }
}

// The subclass's own reason is the nearest declaration and is the one shown.
(new Specialized())->m();

echo "done\n";

?>
--EXPECTF--
Warning: The return value of method Specialized::m() should either be used or intentionally ignored by casting it as (void), specialized reason in %s on line %d
done
