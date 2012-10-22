<?php

use Behat\Behat\Context\BehatContext;

class FeatureContext extends BehatContext
{
    public function __construct()
    {
        $this->useContext('console', new ConsoleContext(array()));
    }
}
