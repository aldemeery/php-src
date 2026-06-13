--TEST--
#[\NoDiscard] effect inheritance: leaf consolidates the reason from parallel interfaces
--FILE--
<?php

interface Logger
{
    #[\NoDiscard("the log handle must be propagated")]
    public function record(): object;
}

interface Auditor
{
    #[\NoDiscard("compliance failure must be checked")]
    public function record(): object;
}

class ComplianceLogger implements Logger, Auditor
{
    #[\NoDiscard("required for both audit and log propagation")]
    public function record(): object { return new stdClass; }
}

// The leaf's own declaration is the nearest and fixes the reason deterministically.
(new ComplianceLogger())->record();

echo "done\n";

?>
--EXPECTF--
Warning: The return value of method ComplianceLogger::record() should either be used or intentionally ignored by casting it as (void), required for both audit and log propagation in %s on line %d
done
