--TEST--
#[\NoDiscard] effect inheritance: inherited shared method subjected to an interface is separated, not mutated
--DESCRIPTION--
C inherits P::m without overriding it (a shared function pointer) and newly
implements interface I which declares m() as #[\NoDiscard]. The subclass must
warn, but the parent P -- which does not implement I -- must NOT warn. This
verifies the shared zend_function is separated before the flag is set.
--FILE--
<?php

class P
{
    public function m(): object { return new stdClass; }
}

interface I
{
    #[\NoDiscard("required by I")]
    public function m(): object;
}

class C extends P implements I {}

echo "C (implements I) warns:\n";
(new C())->m();

echo "P (does not implement I) does not warn:\n";
(new P())->m();

echo "done\n";

?>
--EXPECTF--
C (implements I) warns:

Warning: The return value of method P::m() should either be used or intentionally ignored by casting it as (void) in %s on line %d
P (does not implement I) does not warn:
done
