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
     * The file in which the message was reported
     *
     * @var string
     **/
    protected $_filePath;
    
    /**
     * undocumented class variable
     *
     * @var string
     **/
    protected $_backTrace;
    
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
    
    function __construct($level, $message, $filePath = null, $backTrace = null)
    {
        $this->_level = $level;
        $this->_message = $message;
        $this->_filePath = $filePath;
        $this->_backTrace = $backTrace;
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
        return $this->_level;
    }
    
    /**
     * Return the message string
     *
     * @return string
     * @author Alistair Stead
     **/
    public function getMessage()
    {
        return $this->_message;
    }
    
    /**
     * Return the path to the file where the error was reported
     *
     * @return string
     * @author Alistair Stead
     **/
    public function getFilePath()
    {
        return $this->_filePath;
    }
    
    /**
     * undocumented function
     *
     * @return string
     * @author Alistair Stead
     **/
    public function getColour()
    {
        return $this->_colours[$this->getLevel()];
    }
}
