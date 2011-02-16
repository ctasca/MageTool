<?php

class MageTool_Lint_Adminhtml
    extends MageTool_Lint_Abstract
{
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
     * @param string $filePath The path from which the file can be loaded.
     * @return bool
     * @author Alistair Stead
     **/
    public function canValidate($filePath)
    {
        if (!strstr($filePath, 'adminhtml.xml')) {
            return false;
        }
        return true;
    }
}