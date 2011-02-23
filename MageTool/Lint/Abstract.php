<?php

abstract class MageTool_Lint_Abstract
    implements MageTool_Lint_Interface
{    
    /**
     * Internal reference of the current module being tested
     *
     * @var string
     **/
    protected $_moduleName;
    
    /**
     * Internal reference to the SimpleXMLElement
     *
     * @var SimpleXMLElement
     **/
    protected $_config;
    
    /**
     * Internal reference to the current file being tested
     *
     * @var string
     **/
    protected $_filePath;
    
    /**
     * Internal reference to the parent Lint object
     *
     * @var MageTool_Lint
     **/
    protected $_lint;
    
    public function run($filePaths)
    {
        if (is_array($filePaths)) {
            foreach ($filePaths as $filePath) {
                $this->_run($filePath);
            }
        } else {
            $this->_run($filePaths);
        }
    }
    
    /**
     * undocumented function
     *
     * @return void
     * @author Alistair Stead
     **/
    protected function _run($filePath)
    {
        $this->_filePath = $filePath;
        if (!file_exists($this->_filePath) || !is_readable($this->_filePath)) {
            $this->getLint()->addMessage(
                new MageTool_Lint_Message(
                    "Unable to load::{$this->_filePath}",
                    'red'
                )
            );
            return;
        }
        if (!$this->canValidate($filePath)) {
            return;
        }
        $xml = file_get_contents($filePath);
        $this->validate($xml);
    }
    
    /**
     * Can this lint class validate this file
     *
     * @param string $filePath The path from which the file can be loaded.
     * @return bool
     * @author Alistair Stead
     **/
    public function canValidate($filePath)
    {
        return true;
    }
    
    /**
     * Retrieve the internal Lint object
     *
     * @return MageTool_Lint
     * @author Alistair Stead
     **/
    public function getLint()
    {
        return $this->_lint;
    }
    
    /**
     * Set the internal Lint object
     *
     * @return MageTool_Lint_Interface
     * @author Alistair Stead
     **/
    public function setLint(MageTool_Lint $lint)
    {
        $this->_lint = $lint;
        
        return $this;
    }
}