<?php

namespace spec\MageTool\Command;

use PHPSpec2\ObjectBehavior;

class CacheDisableCommand extends ObjectBehavior
{
    function it_should_be_initializable()
    {
        $this->shouldHaveType('Symfony\Component\Console\Command\Command');
    }
    
    function it_should_return_name_from_getName()
    {
        $this->getName()->shouldReturn('cache:disable');
    }
}
