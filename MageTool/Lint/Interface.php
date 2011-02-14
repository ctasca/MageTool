<?php
interface MageTool_Lint_Interface
{
    public function run(Varien_Simplexml_Config $config);
    
    public function validate($config);
}