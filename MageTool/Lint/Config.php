<?php

class MageTool_Lint_Config
    extends MageTool_Lint_Abstract
{
    /**
     * Required nodes expected in the file
     *
     * @var array
     **/
    protected $_requiredNodes = array(
        'modules',
        'global',
    );

    /**
     * Expected nodes in the file
     *
     * @var array
     **/
    protected $_expectedNodes = array(
        'frontend',
        'adminhtml',
        'default',
        'install',
        'stores',
        'admin',
        'websites',
        'crontab'
    );

    /**
     * Expected class types within a module
     *
     * @var array
     */
    protected $_classTypes = array (
        'Model',
        'Block',
        'Helper'
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
            $this->_requiredNodes();
            $this->_expectedNodes();
            $this->_unexpectedNodes();
            
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
        if (strstr($this->_filePath, 'config.xml')) {
            return true;
        }
        return false;
    }

    /**
     * Validate that the required root nodes are present
     *
     * @return void
     * @author Alistair Stead
     **/
    protected function _requiredNodes()
    {
        $nodes     = array();
        foreach($this->_config as $node)
        {
            $nodes[] = $node->getName();
        }

        //if one of the expected modules is missing, fail
        foreach($this->_requiredNodes as $requiredNode)
        {
            if(!in_array($requiredNode, $nodes))
            {
                $this->getLint()->addMessage(
                    new MageTool_Lint_Message(
                        MageTool_Lint_Message::ERROR,
                        "Required node [{$requiredNode}] missing in file {$this->_filePath}"
                    )
                );
            }
        }
    }

    /**
     * Validate that the expected root nodes are present
     *
     * @return void
     * @author Alistair Stead
     **/
    protected function _expectedNodes()
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
    
    /**
     * Validate that there are no unexpected root nodes
     *
     * @return void
     * @author Alistair Stead
     **/
    protected function _unexpectedNodes()
    {
        $nodes = array();
        foreach($this->_config as $node)
        {
            $nodes[] = $node->getName();
        }
        $allNodes = array_merge($this->_expectedNodes, $this->_requiredNodes);
        foreach ($nodes as $node) {
            if (!in_array($node, $allNodes)) {
                $this->getLint()->addMessage(
                    new MageTool_Lint_Message(
                        MageTool_Lint_Message::WARNING,
                        "Unexpected node [{$node}] in file {$this->_filePath}"
                    )
                );
            }
        }
    }

    /**
     * Validate the modules structure and class files
     *
     * @return void
     * @author Alistair Stead
     **/
    protected function _classFiles()
    {
        foreach ($this->_classTypes as $classType) {
            $typeDir = Mage::getConfig()->getModuleDir('', $moduleName).DS.$classType;
        }

    }
}