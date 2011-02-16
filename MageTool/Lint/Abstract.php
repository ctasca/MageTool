<?php

abstract class MageTool_Lint_Abstract
    implements MageTool_Lint_Interface
{
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
                if (!$this->canValidate($filePath)) {
                    continue;
                }
                $xml = file_get_contents($filePath);
                $this->validate($xml);
            }
        } else {
            if ($this->canValidate($filePath)) {
                $xml = file_get_contents($filePaths);
                $this->validate($xml);
            }
        }
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