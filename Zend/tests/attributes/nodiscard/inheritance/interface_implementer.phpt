--TEST--
#[\NoDiscard] effect inheritance: interface declares, direct implementer warns
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

(new JsonResponseFactory())->create();

echo "done\n";

?>
--EXPECTF--
Warning: The return value of method JsonResponseFactory::create() should either be used or intentionally ignored by casting it as (void), the response must be returned to the caller in %s on line %d
done
