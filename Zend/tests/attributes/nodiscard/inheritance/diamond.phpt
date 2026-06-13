--TEST--
#[\NoDiscard] effect inheritance: two parallel interfaces both declare, warning fires
--DESCRIPTION--
The warning firing is normative. The reason text shown is drawn from one of the
contributing declarations and is deliberately not asserted precisely here.
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
    public function record(): object { return new stdClass; }
}

(new ComplianceLogger())->record();

echo "done\n";

?>
--EXPECTF--
Warning: The return value of method ComplianceLogger::record() should either be used or intentionally ignored by casting it as (void)%s in %s on line %d
done
