--TEST--
#[\NoDiscard] effect inheritance: using or (void)-casting the inherited result does not warn
--FILE--
<?php

interface Source
{
    #[\NoDiscard("use it")]
    public function g(): object;
}

class Impl implements Source
{
    public function g(): object { return new stdClass; }
}

$obj = new Impl();

$used = $obj->g();          // assigned: no warning
(void) $obj->g();           // explicitly discarded: no warning
var_dump($used instanceof stdClass);

echo "done\n";

?>
--EXPECT--
bool(true)
done
