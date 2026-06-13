--TEST--
#[\NoDiscard] effect inheritance: trait declares, composing class redeclares the method
--DESCRIPTION--
Before effect inheritance a class redeclaring a trait method silently dropped
the contract. It now warns. The reason text lives on the trait declaration,
which is not on the redeclaring class's parent/interface walk, so no reason is
shown -- consistent with the reason text being non-normative.
--FILE--
<?php

trait T
{
    #[\NoDiscard("from the trait")]
    public function tm(): object { return new stdClass; }
}

class Redeclares
{
    use T;
    public function tm(): object { return new stdClass; }
}

(new Redeclares())->tm();

echo "done\n";

?>
--EXPECTF--
Warning: The return value of method Redeclares::tm() should either be used or intentionally ignored by casting it as (void) in %s on line %d
done
