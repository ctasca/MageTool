<?php
class MageTool_Tool_MageApp_Provider_Core_Config_Lint
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
        $this->_config = Mage::getConfig();
        foreach ($this->_lints as $lint) {
            try {
                $lint->run($this->_config);
            } catch (Exception $e) {
                $response->appendContent(
                    "{$e->getMessage()}",
                    array('color' => array('white'))
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
    protected function _getConfig()
    {
        if (is_null($this->_config)) {
            $this->_config = Mage::getModel('core/config')->loadBase()->loadModules()->getNode();
        }
        return $this->_config;
    }
    
    /**
     * Retrieve a set of lint files that implement the lint interface
     *
     * @return array
     * @author Alistair Stead
     **/
    protected function _getLints($path = null)
    {
        // TODO search local file path and the supplied path for files that implement lint
    }
}