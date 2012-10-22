<?php

namespace spec\MageTool;

use PHPSpec2\ObjectBehavior;

class MageTool extends ObjectBehavior
{
    function it_should_be_initializable()
    {
        $this->shouldHaveType('MageTool\MageTool');
    }

    function it_should_have_a_version()
    {
        // $this->shouldHaveProperty('VERSION')->shouldEqual('@package_version@');
    }
}