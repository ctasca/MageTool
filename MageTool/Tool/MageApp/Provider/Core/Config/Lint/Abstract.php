<?php

abstract class MageTool_Tool_MageApp_Provider_Core_Config_Lint_Abstract
    implements MageTool_Tool_MageApp_Provider_Core_Config_Lint_Interface
{
    public function run()
    {
        $this->validate();
    }
}