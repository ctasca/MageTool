<?php

use Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

require_once 'PHPUnit/Autoload.php';
require_once 'PHPUnit/Framework/Assert/Functions.php';

/**
 * Console context.
 */
class ConsoleContext extends BehatContext
{
    /**
     * The output from the command
     *
     * @var string
     **/
    var $output;

    /**
     * @When /^I run command "([^"]*)"$/
     */
    public function iRunCommand($commandString)
    {
        $this->output = system('./bin/' . $commandString);
        var_dump($this->output);
    }

    /**
     * @Then /^I should see$/
     */
    public function iShouldSee(PyStringNode $string)
    {
        assertTrue(strstr($string->getRaw(), $this->output));
    }
}
