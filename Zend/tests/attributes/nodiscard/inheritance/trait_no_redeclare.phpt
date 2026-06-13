--TEST--
#[\NoDiscard] effect inheritance: trait declares, composing class does not redeclare
--FILE--
<?php

trait T
{
    #[\NoDiscard("from the trait")]
    public function tm(): object { return new stdClass; }
}

class UsesTrait
{
    use T;
}

(new UsesTrait())->tm();

echo "done\n";

?>
--EXPECTF--
Warning: The return value of method UsesTrait::tm() should either be used or intentionally ignored by casting it as (void), from the trait in %s on line %d
done
