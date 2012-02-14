<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;

use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

require_once 'mink/autoload.php';

/**
 * Features context.
 */
class FeatureContext extends Behat\Mink\Behat\Context\MinkContext
{

    /**
     * @When /^I use the command "([^"]*)"$/
     */
    public function iUseTheCommand($command)
    {
        $this->output = shell_exec($command);
    }

    /**
     * @Then /^I should see$/
     */
    public function iShouldSee(PyStringNode $expected)
    {
        var_dump($this->output);
        var_dump($expected->__toString());
        assertContains($expected->__toString(), $this->output);
    }

}
