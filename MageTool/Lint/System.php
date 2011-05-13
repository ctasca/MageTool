<?php

class MageTool_Lint_System
    extends MageTool_Lint_Abstract
{    
    /**
     * undocumented class variable
     *
     * @var string
     **/
    protected $_expectedNodes = array(
        'tabs',
        'sections',
    );
    
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
    
    /**
     * Validate that the expected root nodes are present
     *
     * @return void
     * @author Alistair Stead
     **/
    public function lintExpectedNodes()
    {
        $nodes = array();
        foreach($this->_config as $node)
        {
            $nodes[] = $node->getName();
        }

        //if one of the expected modules is missing, fail
        foreach($this->_expectedNodes as $expectedNode)
        {
            if(!in_array($expectedNode, $nodes))
            {
                $this->getLint()->addMessage(
                    new MageTool_Lint_Message(
                        MageTool_Lint_Message::ADVICE,
                        "Optional node [{$expectedNode}] missing in file {$this->_filePath}"
                    )
                );
            }
        }
    }
}