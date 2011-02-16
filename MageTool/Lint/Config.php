<?php

class MageTool_Lint_Config
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
        try {            
            $config = new SimpleXMLElement($xml);
            var_dump($config);
            
        } catch (Exception $e) {
            $this->getLint()->addMessage(
                new MageTool_Lint_Message(
                    $e->getMessage(),
                    'red'
                )
            );
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
        if (!strstr($filePath, 'config.xml')) {
            return false;
        }
        return true;
    }
}