<?php
class MageTool_Lint
{
    /**
     * Internal member variable that will hold the lint objects
     *
     * @var array
     **/
    protected $_lints;
    
    /**
     * XML Config object
     *
     * @var string
     **/
    protected $_config;
    
    /**
     * Public constructor
     *
     * @return void
     * @author Alistair Stead
     **/
    public function __construct()
    {
        $this->_lints = array();
    }
    
    /**
     * undocumented function
     *
     * @return void
     * @author Alistair Stead
     **/
    public function run($response)
    {
        foreach ($this->getLints() as $lintClass => $includePath) {
            try {
                include_once $includePath;
                $lint = new $lintClass;
                $lint->run($this->_getBaseConfig());
            } catch (MageTool_Lint_Exception $e) {
                $response->appendContent(
                    "{$e->getMessage()}",
                    array('color' => array('yellow'))
                );
            }     
        }
    }
    
    /**
     * Retrieve the config data
     *
     * @return void
     * @author Alistair Stead
     **/
    protected function _getBaseConfig()
    {
        if (is_null($this->_config)) {
            $this->_config = Mage::getModel('core/config');
        }
        return $this->_config->loadBase();
    }
    
    /**
     * undocumented function
     *
     * @return void
     * @author Alistair Stead
     **/
    public function setLints(array $lints)
    {
    }
    
    /**
     * undocumented function
     *
     * @return void
     * @author Alistair Stead
     **/
    public function addLint(MageTool_Lint_Interface $lint)
    {
    }
    
    /**
     * Retrieve a set of lint files that implement the lint interface
     *
     * @return array
     * @author Alistair Stead
     **/
    public function getLints($path = null)
    {
        // TODO search local file path and the supplied path for files that implement lint
        $lints = array(
          'MageTool_Lint_Xml' => 'MageTool/Lint/Xml.php',
          'MageTool_Lint_Config' => 'MageTool/Lint/Config.php',
          'MageTool_Lint_System' => 'MageTool/Lint/System.php',
          'MageTool_Lint_Adminhtml' => 'MageTool/Lint/Adminhtml.php',
          'MageTool_Lint_Api' => 'MageTool/Lint/Api.php'  
        );
        
        return $lints;
    }
}