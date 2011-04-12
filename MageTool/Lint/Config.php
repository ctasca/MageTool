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
        'model',
        'block',
        'helper'
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
    public function lintRequiredNodes()
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
                        "Required node [{$requiredNode}] missing in file {$this->_filePath}",
                        debug_backtrace()
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
                        "Optional node [{$expectedNode}] missing in file {$this->_filePath}",
                        debug_backtrace()
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
    public function lintUnexpectedNodes()
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
                        "Unexpected node [{$node}] in file {$this->_filePath}",
                        debug_backtrace()
                    )
                );
            }
        }
    }

    /**
     * Validate the modules structure and class files exist
     *
     * @return void
     * @author Alistair Stead
     **/
    public function lintClassFilesExist()
    {
        foreach ($this->_classTypes as $classType) {
            $typeDir = Mage::getConfig()->getModuleDir('', $moduleName).DS.$classType;
        }

    }

    /**
    * Classes in configs should be one of four types,
    * Models, Controllers, Blocks, Helpers
    * 
    * @author Alan Storm
    * @author Alistair Stead
    */
    public function lintClassType($config)
    {
        $nodes = $this->_config->xPath('//class');
        $errors = array();
        foreach($nodes as $node)
        {
            $className = (string) $node;
            if(strpos($className, '/') === false && strpos($className, '_') !== false)
            {
                $parts = preg_split('{_}', $className, 4);
                if(array_key_exists(2, $parts) && !in_array(strToLower($parts[2]), $this->_classTypes))
                {
                    $errors[] = "Invaid Type [$parts[2]] detected in class [$className]";
                }
            }
        }
    }

    /**
    * Tests that all classes are cased properly.
    *
    * This helps avoid __autoload problems when working
    * locally on a case insensative system
    * 
    * @author Alan Storm
    * @author Alistair Stead
    */
    public function lintClassCase($config)
    {
        $classNodes = $this->_config->xPath('//class');
        foreach($classNodes as $node)
        {
            $className = (string) $node;
            if(strpos($className, '/') !== false)
            {
                // URI based class references e.g. core/model_app
                // TODO add link to documentation to message
                if($className != strToLower($className))
                {
                    $this->getLint()->addMessage(
                        new MageTool_Lint_Message(
                            MageTool_Lint_Message::ERROR,
                            "URI [{$className}] must be all lowercase, this cause problems on case sensative systems",
                            debug_backtrace()
                        )
                    );
                }
            }
            else if(strpos($className, '_') !== false)
            {
                // Class name convension is correct
                // TODO add link to documentation to message
                $parts = preg_split('{_}',$className,4);
                foreach($parts as $part)
                {
                    if(ucwords($part) != $part)
                    {
                        $this->getLint()->addMessage(
                            new MageTool_Lint_Message(
                                MageTool_Lint_Message::ERROR,
                                "Class [{$className}] does not have proper casing. Each_Word_Must_Be_Leading_Cased.",
                                debug_backtrace()
                            )
                        );
                    }
                }
            }
            else
            {
                // Class name is anything but what it should be
                // TODO add link to documentation to message
                $this->getLint()->addMessage(
                    new MageTool_Lint_Message(
                        MageTool_Lint_Message::ERROR,
                        "Class [{$className}] doesn't loook like a class",
                        debug_backtrace()
                    )
                );
            }
        }
    }
}