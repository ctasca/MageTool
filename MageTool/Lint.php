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
     * File path pattern to filter the config to be tested
     *
     * @var string
     **/
    protected $_pathFilter;
    
    /**
     * Specific file path to be tested
     *
     * @var string
     **/
    protected $_filePath;
    
    /**
     * Public constructor
     *
     * @return void
     * @author Alistair Stead
     **/
    public function __construct($filePath = null)
    {
        $this->_filePath = $filePath;
        $this->_lints = array();
        $this->_messages = array();
    }
    
    /**
     * undocumented function
     *
     * @return void
     * @author Alistair Stead
     **/
    public function run()
    {
        foreach ($this->getLints() as $lint) {
            foreach ($this->getXmlConfigPaths() as $filePath) {
                $xml = file_get_contents($filePath);
                $lint->setFilePath($filePath);
                $lint->run($xml);
            }
                
        }
    }
    
    /**
     * Set a _pathFilter that can be used to reduce the number of files that will be tested. Or
     * you may set an explicit file to be tested.
     *
     * @return void
     * @author Alistair Stead
     **/
    public function setPathFilter($path)
    {
        $this->_pathFilter = $path;
    }
    
    /**
     * Add Messages from the lint run
     *
     * @return MageTool_Lint
     * @author Alistair Stead
     **/
    public function addMessage(MageTool_Lint_Message $message)
    {
        $this->_messages[] = $message;
        
        return $this;
    }
    
    /**
     * Return the messages array with the selected message level
     *
     * @return array
     * @author Alistair Stead
     **/
    public function getMessages($level = null)
    {
        return $this->_messages;
    }
    
    /**
     * undocumented function
     *
     * @return int
     * @author Alistair Stead
     **/
    public function countErrors()
    {
        $num = 0;
        foreach ($this->getMessages() as $message) {
            if ($message->getLevel() === MageTool_Lint_Message::ERROR) {
                $num++;
            }
        }
        
        return $num;
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
    public function addLints($lints)
    {
        if (is_array($lints)) {
            foreach ($lints as $lint) {
                $this->addLint($lint);
            }
        }
        if (is_object($lints) && ($lints instanceof MageTool_Lint_Interface)) {
            $this->addLint($lints);
        }
        if (is_string($lints) && file_exists($lints)) {
            $phpContent = file_get_contents($lints);
            $fileTokens = token_get_all($phpContent);
            $classToken = false;
            foreach ($fileTokens as $token) {
                if (is_array($token)) {
                    var_dump($token);
                    if ($token[0] == T_CLASS) {
                        $classToken = true;
                    } else if ($classToken && $token[0] == T_STRING) {
                        include_once $lints;
                        $this->addLint(new $token[1]);
                        $class_token = false;
                    }
                }       
            }
            
        }   
        
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
        $this->_lints[get_class($lint)] = $lint->setLint($this);
        
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
        if ($this->_filePath) {
            if (!file_exists($this->_filePath)) {
                throw new MageTool_Lint_Exception("XML file not found: {$this->_filePath}");
            }
            $filePaths[] = $this->_filePath;
            return $filePaths;
        }
        $config = $this->_getBaseConfig();
        $modules = $config->loadModules()->getNode('modules')->children();
        foreach ($modules as $modName => $module) {
            if ($module->is('active')) {
                // Find all configuration within the module
                $configFiles = glob($config->getModuleDir('etc', $modName).DS.'*.xml');
                while ($filePath = next($configFiles)) {
                    // If the $_pathFilter is set and it is matched in the $filePath
                    if (is_null($this->_pathFilter)) {
                        $filePaths[] = $filePath;
                    } else if (strstr($filePath, $this->_pathFilter)) {
                        $filePaths[] = $filePath;
                    }
                }
            }
        }
        
        return $filePaths;
    }
}