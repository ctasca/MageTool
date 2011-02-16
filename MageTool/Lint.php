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
     * Internal array to which lint messages will be stored
     *
     * @var array
     **/
    protected $_messages;
    
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
        $this->_messages = array();
    }
    
    /**
     * undocumented function
     *
     * @return void
     * @author Alistair Stead
     **/
    public function run($response)
    {
        foreach ($this->getLints() as $lint) {
            try {
                $lint->run($this->getXmlConfigPaths());
            } catch (MageTool_Lint_Exception $e) {
                $response->appendContent(
                    "{$e->getMessage()}",
                    array('color' => array('red'))
                );
            }     
        }
        $this->_processMessages($response);
    }
    
    /**
     * undocumented function
     *
     * @return void
     * @author Alistair Stead
     **/
    protected function _processMessages($response)
    {
        foreach ($this->_messages as $message) {
            $message->write($response);
        }
    }
    
    /**
     * Add Messages from the lint running
     *
     * @return void
     * @author Alistair Stead
     **/
    public function addMessage(MageTool_Lint_Message $message)
    {
        $this->_messages[] = $message;
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
    public function addLints(array $lints)
    {
        foreach ($lints as $lint) {
            $lint->setLint($this);
        }
        $this->_lints = array_merge($this->_lints, $lints);
        
        return $this;
    }
    
    /**
     * undocumented function
     *
     * @return void
     * @author Alistair Stead
     **/
    public function addLint(MageTool_Lint_Interface $lint)
    {
        $this->_lints[] = $lint->setLint($this);
        
        return $this;
    }
    
    /**
     * undocumented function
     *
     * @return MageTool_Lint
     * @author Alistair Stead
     **/
    public function clearLints()
    {
        $this->_lints = array();
        
        return $this;
    }
    
    /**
     * Retrieve a set of lint files that implement the lint interface
     *
     * @return array
     * @author Alistair Stead
     **/
    public function getLints()
    {        
        return $this->_lints;
    }
    
    /**
     * undocumented function
     *
     * @return array
     * @author Alistair Stead
     **/
    public function getXmlConfigPaths()
    {
        $filePaths = array();
        $config = $this->_getBaseConfig();
        $modules = $config->loadModules()->getNode('modules')->children();
        foreach ($modules as $modName => $module) {
            if ($module->is('active')) {
                // Find all configuration within the module
                $configFiles = glob($config->getModuleDir('etc', $modName).DS.'*.xml');
                while ($filePath = next($configFiles)) {
                    $filePaths[] = $filePath;
                }
            }
        }
        
        return $filePaths;
    }
}