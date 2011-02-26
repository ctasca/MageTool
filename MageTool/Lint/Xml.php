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
}