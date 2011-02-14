<?php

abstract class MageTool_Lint_Abstract
    implements MageTool_Lint_Interface
{
    public function run(Varien_Simplexml_Config $config)
    {
        $this->validate($config);
    }
}