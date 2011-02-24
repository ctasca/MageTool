<?php
/**
* 
*/
class MageTool_Lint_Message
{
    const VALID = 'VALID';
    const ERROR = 'ERROR';
    const WARNING = 'WARNING';
    const NOTICE = 'NOTICE';
    const STRICT = 'STRICT';
    const ADVICE = 'ADVICE';
    
    /**
     * The level of severity the message should be reported as
     *
     * @var string
     **/
    protected $_level;
    
    /**
     * The message to be reported to the user
     *
     * @var string
     **/
    protected $_message;
    
    /**
     * Arrany that maps the level of severity to output colour
     *
     * @var array
     **/
    protected $_colours = array(
        self::VALID => 'green',
        self::ERROR => 'red',
        self::WARNING => 'orange',
        self::NOTICE => 'white',
        self::STRICT => 'blue',
        self::ADVICE => 'yellow'
    );
    
    function __construct($level, $message)
    {
        $this->_level = $level;
        $this->_message = $message;
    }
    
    /**
     * Magic method invoked when the object is cast to a string
     *
     * @return void
     * @author Alistair Stead
     **/
    public function __toString()
    {
        return $this->getLevel() . ': ' . $this->getMessage();
    }
    
    /**
     * Return the message level
     *
     * @return string
     * @author Alistair Stead
     **/
    public function getLevel()
    {
        return $this->_message;
    }
    
    /**
     * Return the message string
     *
     * @return void
     * @author Alistair Stead
     **/
    public function getMessage()
    {
        return $this->_message;
    }
    
    /**
     * Write the message output to the response object
     *
     * @return void
     * @author Alistair Stead
     **/
    public function write($response)
    {
        $response->appendContent(
            $this->getLevel() . ': ' . $this->getMessage(),
            array('color' => array($this->_colours[$this->getLevel()]))
        );
    }
}
