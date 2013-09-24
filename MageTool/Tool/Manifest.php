<?php
class MageTool_Tool_Manifest 
    implements Zend_Tool_Framework_Manifest_ProviderManifestable, Zend_Tool_Framework_Manifest_ActionManifestable
{
    /**
     * Register autoload for the tool
     */
    public function __construct()
    {
        $basePath = dirname(__FILE__);
        /**
         * Set include path
         */
         $paths = array(
            $basePath . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'MTool',
            $basePath . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'Local'
         );
        
        $incPaths = implode(PATH_SEPARATOR, $paths);
        set_include_path($incPaths . PATH_SEPARATOR . get_include_path());
        $autoloader = Zend_Loader_Autoloader::getInstance();
        $autoloader->registerNamespace('Mtool_');
        $autoloader->registerNamespace('MyMtool_');
        $autoloader->registerNamespace('MageTool_');
    }
    
    public function getProviders()
    {
        $providers = array(
                new MageTool_Tool_MageApp_Provider_Admin_User(),
                new MageTool_Tool_MageApp_Provider_Core_Cache(),
                new MageTool_Tool_MageApp_Provider_Core_Compiler(),
                new MageTool_Tool_MageApp_Provider_Core_Indexer(),
                new MageTool_Tool_MageApp_Provider_Core_Resource(),
                new MageTool_Tool_MageApp_Provider_Core_Config(),
                new MageTool_Tool_MageApp_Provider_App(),
                new MageTool_Tool_MageExtension_Provider_Extension(),
                new Mtool_Providers_Module(),
                new Mtool_Providers_Model(),
                new Mtool_Providers_Rmodel(),
                new Mtool_Providers_Helper(),
                new Mtool_Providers_Block(),
                new MyMtool_Providers_Phtml(),
                new MyMtool_Providers_FrontendPhtml(),
                new MyMtool_Providers_AdminhtmlPhtml(),
				new MyMtool_Providers_Config_Event(),
				new MyMtool_Providers_Config_Version(),
				new MyMtool_Providers_Config_Layout(),
				new MyMtool_Providers_Config_System_Default(),
                new MyMtool_Providers_Suite_Module(),
                new MyMtool_Providers_Suite_Block()
            );

        return $providers;
    }

    public function getActions()
    {
        $actions = array();

        return $actions;
    }
}