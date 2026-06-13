--TEST--
#[\NoDiscard] effect inheritance: interface declares, transitive subclass warns
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

class CachedJsonResponseFactory extends JsonResponseFactory
{
    public function create(): object { return new stdClass; }
}

(new CachedJsonResponseFactory())->create();

echo "done\n";

?>
--EXPECTF--
Warning: The return value of method CachedJsonResponseFactory::create() should either be used or intentionally ignored by casting it as (void), the response must be returned to the caller in %s on line %d
done
