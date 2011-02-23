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
     * Write the message output to the response object
     *
     * @return void
     * @author Alistair Stead
     **/
    public function write($response)
    {
        $response->appendContent(
            $this->_level . ' :: ' . $this->_message,
            array('color' => array($this->_colours[$this->_level]))
        );
    }
}
