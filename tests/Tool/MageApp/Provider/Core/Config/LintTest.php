<?php

require_once "MageTool/Tool/MageApp/Provider/Core/Config.php";

class Config_LintTest extends PHPUnit_Framework_TestCase 
{

    /**
     * Internal container for the lint object
     *
     * @var MageTool_Tool_MageApp_Provider_Core_Config_Lint
     **/
    protected $_lint;
    
    public function setUp()
    {
        parent::setUp();
        // Initialise Magento
        Mage::app();
        $this->_lint = new MageTool_Tool_MageApp_Provider_Core_Config_Lint;
    }
    
    /**
     * _getConfigShouldReturnConfig
     * @author Alistair Stead
     * @test
     */
    public function _getConfigShouldReturnConfig()
    {
        $_getConfigMethod = self::getMethod('_getConfig');
        $result = $_getConfigMethod->invoke($this->_lint);
        
        var_dump($result);
    } // _getConfigShouldReturnConfig
    

    /**
     * Provide access to protected methods by using reflection
     *
     * @param string $name 
     * @return void
     * @author Alistair Stead
     */
    protected static function getMethod($name)
    {
        $class = new ReflectionClass('MageTool_Tool_MageApp_Provider_Core_Config_Lint');
        $method = $class->getMethod($name);
        $method->setAccessible(true);
      
        return $method;
    }
}