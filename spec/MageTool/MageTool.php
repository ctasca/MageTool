<?php

namespace spec\MageTool;

use PHPSpec2\ObjectBehavior;

class MageTool extends ObjectBehavior
{
    function it_should_exist()
    {
        $this->mageTool->shouldNotBe(null);
    }
    
    function it_should_have_a_version()
    {
        $this->mageTool->getVersion()->shouldReturn('2.0.0-dev');
    }
}