<?php
 
class MageTool_Lint_Xml
    extends MageTool_Lint_Abstract
{
    /**
     * Validate the XML config is correctly structured
     *
     * @param string $xml The file contents from the configuration file
     * @return void
     * @author Alistair Stead
     **/
    public function validate($xml)
    { 
        try {            
            $this->_config = new SimpleXMLElement($xml);
        } catch (Exception $e) {
            $this->getLint()->addMessage(
                new MageTool_Lint_Message(
                    MageTool_Lint_Message::ERROR,
                    $e->getMessage() . ' ' . $this->_filePath
                )
            );
        }
    }
    
    /**
     * Can this lint class validate this file
     * 
     * Can validate all files with the exception of WSDL files
     *
     * @param string $filePath The path from which the file can be loaded.
     * @return bool
     * @author Alistair Stead
     **/
    public function canValidate($filePath)
    {
        if (!strstr($filePath, 'wsdl.xml') && !strstr($filePath, 'wsdl2.xml')) {
            return true;
        }
        return false;
    }
}