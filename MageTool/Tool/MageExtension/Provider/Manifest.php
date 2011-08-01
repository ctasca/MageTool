<?php
class MageTool_Tool_MageExtension_Provider_Manifest 
    implements Zend_Tool_Framework_Manifest_ProviderManifestable, Zend_Tool_Framework_Manifest_ActionManifestable
{
    /**
     * Register autoload for the tool
     */
    public function __construct()
    {
        exit('Deprecated configuration. Please amend your .zf.ini based on http://github.com/alistairstead/MageTool');
    }
    
    public function getProviders()
    {
        $providers = array();

        return $providers;
    }

    public function getActions()
    {
        $actions = array();

        return $actions;
    }
}