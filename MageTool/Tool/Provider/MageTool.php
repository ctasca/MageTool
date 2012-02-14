<?php

/**
 * MageTool_Tool_Provider_MageTool adds command that provide information about MageTool
 *
 * @package MageTool_Providor
 * @author Alistair Stead
 **/
class MageTool_Tool_Provider_MageTool extends MageTool_Tool_Provider_Abstract
{
    /**
     * Mage tool version
     * @var string
     */
    protected $_version = '0.5.1beta';

    /**
     * Define the name of the provider
     *
     * @return string
     * @author Alistair Stead
     **/
    public function getName()
    {
        return 'MageTool';
    }

    /**
     * Display the version information for MageTool
     */
    public function version()
    {
        $this->_registry->getResponse()->appendContent(
            "MageTool {$this->_version}",
            array('color' => array('green'))
        );
    }
}
