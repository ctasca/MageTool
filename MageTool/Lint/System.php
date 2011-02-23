<?php

class MageTool_Lint_System
    extends MageTool_Lint_Abstract
{    
    /**
     * undocumented class variable
     *
     * @var string
     **/
    protected $_expectedRootNodes = array(
        'tabs',
        'sections',
    );
    
    /**
     * Validate the XML config is correctly structured
     *
     * @return void
     * @author Alistair Stead
     **/
    public function validate($xml)
    {
        
    }
    
    /**
     * Can this lint class validate this file
     * 
     * Can validate system.xml
     *
     * @param string $filePath The path from which the file can be loaded.
     * @return bool
     * @author Alistair Stead
     **/
    public function canValidate($filePath)
    {
        if (!strstr($filePath, 'system.xml')) {
            return false;
        }
        return true;
    }
}