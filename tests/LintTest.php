<?php

require_once "MageTool/Tool/MageApp/Provider/Core/Config.php";
require_once 'MageTool/Lint.php';

class LintTest extends PHPUnit_Framework_TestCase 
{

    /**
     * Internal container for the lint object
     *
     * @var MageTool_Lint
     **/
    protected $_lint;
    
    public function setUp()
    {
        parent::setUp();
        // Initialise Magento
        Mage::app();
        $this->_lint = new MageTool_Lint;
    }
    
    /**
     * _getConfigShouldReturnConfig
     * @author Alistair Stead
     * @test
     */
    public function _getConfigShouldReturnConfig()
    {
        $_getConfigMethod = self::getMethod('_getBaseConfig');
        $result = $_getConfigMethod->invoke($this->_lint);
        
        $this->assertInstanceOf('Varien_Simplexml_Config', $result);
    } // _getConfigShouldReturnConfig
    
    /**
     * getLintsShouldReturnArrayClassAndPath
     * @author Alistair Stead
     * @test
     */
    public function getLintsShouldReturnArrayClassAndPath()
    {
        $lints = $this->_lint->getLints();
        
        $this->assertTrue(is_array($lints), 'No lints array has been returned');
        $this->assertEquals(5, count($lints), 'An unexpected number of lints has been found');
        
        foreach ($lints as $class => $path) {
            $this->assertFileExists($path, 'Path not found on the include path');
        }
    } // getLintsShouldReturnArrayClassAndPath
    
    /**
     * runShouldCallEachLintClassRunMethod
     * @author Alistair Stead
     * @test
     */
    public function runShouldCallEachLintClassRunMethod()
    {
        // Create a stub for the SomeClass class.
        $stub = $this->getMock('Zend_Tool_Framework_Response');

        // Configure the stub.
        $stub->expects($this->any())
             ->method('appendContent')
             ->will($this->returnArgument(0));
             
        $this->_lint->run($stub);
    } // runShouldCallEachLintClassRunMethod
    
    
    /**
     * Provide access to protected methods by using reflection
     *
     * @param string $name 
     * @return void
     * @author Alistair Stead
     */
    protected static function getMethod($name)
    {
        $class = new ReflectionClass('MageTool_Lint');
        $method = $class->getMethod($name);
        $method->setAccessible(true);
      
        return $method;
    }
}