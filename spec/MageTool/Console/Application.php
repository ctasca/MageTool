<?php

namespace spec\MageTool\Console;

use PHPSpec2\ObjectBehavior;

class Application extends ObjectBehavior
{
    function it_should_exist()
    {
        $this->object->shouldNotBe(null);
    }
}