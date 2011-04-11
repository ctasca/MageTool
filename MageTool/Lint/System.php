<?php

class MageTool_Lint_System
    extends MageTool_Lint_Config
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
        try {
            $this->_config = new SimpleXMLElement($xml);
            $this->_expectedNodes();
            
        } catch (Exception $e) {
            $this->getLint()->addMessage(
                new MageTool_Lint_Message(
                    MageTool_Lint_Message::ERROR,
                    $e->getMessage(),
                    $this->_filePath
                )
            );
        }
    }
    
    /**
     * Can this lint class validate this file
     * 
     * Can only validate config.xml
     *
     * @return bool
     * @author Alistair Stead
     **/
    public function canValidate()
    {
        if (strstr($this->_filePath, 'system.xml')) {
            return true;
        }
        return false;
    }
}