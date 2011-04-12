<?php

abstract class MageTool_Lint_Abstract
    implements MageTool_Lint_Interface
{
    /**
     * Internal reference of the current module being tested
     *
     * @var string
     **/
    protected $_moduleName;

    /**
     * Internal reference to the SimpleXMLElement
     *
     * @var SimpleXMLElement
     **/
    protected $_config;

    /**
     * Internal reference to the current file being tested
     *
     * @var string
     **/
    protected $_filePath;

    /**
     * Internal reference to the parent Lint object
     *
     * @var MageTool_Lint
     **/
    protected $_lint;

    /**
     * Run the lint tests against the supplied string
     *
     * @param string $xml Configuration file string
     * @return void
     * @author Alistair Stead
     */
    public function run($xml)
    {
        if (!$this->canValidate()) {
            return;
        }
        $this->validate($xml);
    }

    /**
     * undocumented function
     *
     * @return void
     * @author Alistair Stead
     **/
    public function validate($xml)
    {
        $this->_config = new SimpleXMLElement($xml);
        foreach(get_class_methods($this) as $method)
        {
            if(strpos($method, 'lint') ===0)
            { 
                try {
                    call_user_func_array(array($this, $method), array());
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
        }
    }

    /**
     * Can this lint class validate this file
     *
     * @return bool
     * @author Alistair Stead
     **/
    public function canValidate()
    {
        return true;
    }

    /**
     * undocumented function
     *
     * @return void
     * @author Alistair Stead
     **/
    public function setFilePath($filePath)
    {
        $this->_filePath = $filePath;
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