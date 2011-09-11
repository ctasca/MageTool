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

        $this->_validFixturePath = dirname(__FILE__) . '/valid/';
        $this->_invalidFixturePath = dirname(__FILE__) . '/invalid/';
        
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
        $this->_stubLint->expects($this->exactly(3))
             ->method('addMessage');
        
        $lint = new MageTool_Lint_Config();
        $lint->setlint($this->_stubLint);
        $lint->setFilePath($testFilePath);
        $lint->run($xml);
    } // validConfigFileShouldNotEnvokeAddMesssage
    
    /**
     * missingRequiredNodesShouldEnvokeAddMessage
     * @author Alistair Stead
     * @test
     */
    public function missingRequiredNodesShouldEnvokeAddMessage()
    {
        $testFilePath = $this->_invalidFixturePath . 'nodes-config.xml';
        $xml = file_get_contents($testFilePath);
        $config = new SimpleXMLElement($xml);
        
        // Configure the stub.
        $this->_stubLint->expects($this->exactly(2))
             ->method('addMessage')
             ->will($this->returnArgument(0));
        
        $lint = new MageTool_Lint_Config();
        $lint->setlint($this->_stubLint);
        $lint->setFilePath($testFilePath);
        $lint->setConfig($config);
        $lint->lintRequiredNodes();
    } // missingRequiredNodesShouldEnvokeAddMessage 
    
    /**
     * missingExpectedNodesShouldEnvokeAddMessage
     * @author Alistair Stead
     * @test
     */
    public function missingExpectedNodesShouldEnvokeAddMessage()
    {
        $testFilePath = $this->_invalidFixturePath . 'nodes-config.xml';
        $xml = file_get_contents($testFilePath);
        $config = new SimpleXMLElement($xml);
        
        // Configure the stub.
        $this->_stubLint->expects($this->exactly(8))
             ->method('addMessage')
             ->will($this->returnArgument(0));
        
        $lint = new MageTool_Lint_Config();
        $lint->setlint($this->_stubLint);
        $lint->setFilePath($testFilePath);
        $lint->setConfig($config);
        $lint->lintExpectedNodes();
    } // missingExpectedNodesShouldEnvokeAddMessage
       
    /**
     * unexpectedNodesShouldEnvokeAddMessage
     * @author Alistair Stead
     * @group unexpected
     * @test
     */
    public function unexpectedNodesShouldEnvokeAddMessage()
    {
        $testFilePath = $this->_invalidFixturePath . 'nodes-config.xml';
        $xml = file_get_contents($testFilePath);
        $config = new SimpleXMLElement($xml);
        
        // Configure the stub.
        $this->_stubLint->expects($this->exactly(3))
             ->method('addMessage')
             ->will($this->returnArgument(0));
        
        $lint = new MageTool_Lint_Config();
        $lint->setlint($this->_stubLint);
        $lint->setFilePath($testFilePath);
        $lint->setConfig($config);
        $lint->lintUnexpectedNodes();
    } // unexpectedNodesShouldEnvokeAddMessage
    
    /**
     * lintModuleStructureShouldEnvokeAddMessage
     * @author Alistair Stead
     * @group lintClassFiles
     * @test
     */
    public function lintModuleStructureShouldEnvokeAddMessage()
    {
        $testFilePath = $this->_invalidFixturePath . 'classfiles-config.xml';
        $xml = file_get_contents($testFilePath);
        $config = new SimpleXMLElement($xml);
        
        // Configure the stub.
        $this->_stubLint->expects($this->exactly(3))
             ->method('addMessage')
             ->will($this->returnArgument(0));
        
        $lint = new MageTool_Lint_Config();
        $lint->setlint($this->_stubLint);
        $lint->setFilePath($testFilePath);
        $lint->setConfig($config);
        $lint->lintModuleStructure();
    } // lintModuleStructureShouldEnvokeAddMessage
    
}