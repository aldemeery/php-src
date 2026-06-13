--TEST--
#[\NoDiscard] effect inheritance: the attribute is not inherited as reflection metadata
--FILE--
<?php

interface ResponseFactory
{
    #[\NoDiscard("the response must be returned to the caller")]
    public function create(): object;
}

class JsonResponseFactory implements ResponseFactory
{
    public function create(): object { return new stdClass; }
}

// The effect is inherited (the call would warn), but the attribute metadata is
// not: getAttributes() reports the attribute only where it was written.
$iface = new ReflectionMethod(ResponseFactory::class, 'create');
$impl  = new ReflectionMethod(JsonResponseFactory::class, 'create');

var_dump(count($iface->getAttributes(\NoDiscard::class)));
var_dump(count($impl->getAttributes(\NoDiscard::class)));

echo "done\n";

?>
--EXPECT--
int(1)
int(0)
done
