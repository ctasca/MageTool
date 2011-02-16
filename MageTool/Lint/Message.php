<?php
/**
* 
*/
class MageTool_Lint_Message
{
    /**
     * The colour the message will be rendered in
     *
     * @var string
     **/
    protected $_colour;
    
    /**
     * The message to be reported to the user
     *
     * @var string
     **/
    protected $_message;
    
    function __construct($message, $colour = 'white')
    {
        $this->_message = $message;
        $this->_colour = $colour;
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
            $this->_message,
            array('color' => array($this->_colour))
        );
    }
}
