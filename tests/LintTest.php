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
        $lints = array(
          'MageTool_Lint_Xml' => 'MageTool/Lint/Xml.php',
          'MageTool_Lint_Config' => 'MageTool/Lint/Config.php',
          'MageTool_Lint_System' => 'MageTool/Lint/System.php',
          'MageTool_Lint_Adminhtml' => 'MageTool/Lint/Adminhtml.php',
          'MageTool_Lint_Api' => 'MageTool/Lint/Api.php'
        );
        $lintObjects = array();
        foreach ($lints as $lintClass => $includePath) {
            include_once $includePath;
            $lintTest = new $lintClass;
            $lintObjects[] = $lintTest;
        }
        $this->_lint->addLints($lintObjects);
        $result = $this->_lint->getLints();

        $this->assertTrue(is_array($result), 'No lints array has been returned');
        $this->assertEquals(5, count($result), 'An unexpected number of lints has been found');

        foreach ($lints as $class => $path) {
            $this->assertFileExists($path, 'Path not found on the include path');
        }
    } // getLintsShouldReturnArrayClassAndPath
    
    /**
     * getXmlConfigPathsShouldReturnSingleItemWhenFilePathIsSet
     * @author Alistair Stead
     * @test
     */
    public function getXmlConfigPathsShouldReturnSingleItemWhenFilePathIsSet()
    {
        $testFilePath = dirname(__FILE__) . DS . 'Lint' . DS . 'valid' . DS . 'config.xml';
        $lint = new MageTool_Lint($testFilePath);
        $this->assertTrue( is_array($lint->getXmlConfigPaths()), 'Array not returned' );
        $this->assertEquals(1, count($lint->getXmlConfigPaths()), 'Number of array items is not what was expected');
    } // getXmlConfigPathsShouldReturnSingleItemWhenFilePathIsSet

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