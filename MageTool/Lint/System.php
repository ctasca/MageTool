<?php

class MageTool_Lint_System
    extends MageTool_Lint_Abstract
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
        
    }
}