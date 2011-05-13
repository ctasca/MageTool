<?php
interface MageTool_Lint_Interface
{
    public function run($xml);
    
    public function validate($xml);
    
    /**
     * Can this lint class validate this file
     *
     * @return bool
     * @author Alistair Stead
     **/
    public function canValidate();
}