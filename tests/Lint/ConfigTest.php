<?php

require_once "MageTool/Tool/MageApp/Provider/Core/Config.php";
require_once 'MageTool/Lint.php';

class Lint_ConfigTest extends PHPUnit_Framework_TestCase 
{
    
    /**
     * Path to the valid fixture files
     *
     * @var string
     **/
    protected $_validFixturePath;
    
    /**
     * Path to the invalid fixture files
     *
     * @var string
     **/
    protected $_invalidFixturePath;
    
    /**
     * Stub response test double
     *
     * @var MageTool_Lint
     **/
    protected $_stubLint;
    
    public function setUp()
    {
        parent::setUp();
        // Initialise Magento
        Mage::app();
        $this->_validFixturePath = dirname(__FILE__) . DS . 'valid' . DS;
        $this->_invalidFixturePath = dirname(__FILE__) . DS . 'invalid' . DS;
        
        // Create a stub for the SomeClass class.
        $this->_stubLint = $this->getMock('MageTool_Lint');
    }
    
    /**
     * validConfigFileShouldNotEnvokeAddMesssage
     * @author Alistair Stead
     * @test
     */
    public function validConfigFileShouldNotEnvokeAddMesssage()
    {
        $testFilePath = $this->_validFixturePath . 'config.xml';
        $xml = file_get_contents($testFilePath);
        
        // Configure the stub.
        $this->_stubLint->expects($this->exactly(0))
             ->method('addMessage');
        
        $lint = new MageTool_Lint_Config();
        $lint->setlint($this->_stubLint);
        $lint->run($xml);
    } // validConfigFileShouldNotEnvokeAddMesssage
    
    /**
     * missingRequiredNodesShouldEnvokeAddMessages
     * @author Alistair Stead
     * 
     */
    public function missingRequiredNodesShouldEnvokeAddMessages()
    {
        $testFilePath = $this->_invalidFixturePath . 'nodes-config.xml';
        $xml = file_get_contents($testFilePath);
        
        // Configure the stub.
        $this->_stubLint->expects($this->exactly(13))
             ->method('addMessage')
             ->will($this->returnArgument(0));
        
        $lint = new MageTool_Lint_Config();
        $lint->setlint($this->_stubLint);
        $lint->run($xml);
        
        // $this->assertEquals(2, count($messages[MageTool_Lint_Message::ERROR]), 'Unexpected ERROR messages returned');
        // $this->assertEquals(8, count($messages[MageTool_Lint_Message::ADVICE]), 'Unexpected ADVICE messages returned');
        // $this->assertEquals(3, count($messages[MageTool_Lint_Message::WARNING]), 'Unexpected WARNING messages returned');
    } // missingRequiredNodesShouldEnvokeAddMessages    
    
}