<?php
require_once 'Zend/Tool/Framework/Manifest/ProviderManifestable.php';
require_once 'Zend/Tool/Framework/Manifest/ActionManifestable.php';
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
            $basePath . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'MTool'
         );
        
        $incPaths = implode(PATH_SEPARATOR, $paths);
        set_include_path($incPaths . PATH_SEPARATOR . get_include_path());
        $autoloader = Zend_Loader_Autoloader::getInstance();
        $autoloader->registerNamespace('Mtool_');
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
            );

        return $providers;
    }

    public function getActions()
    {
        $actions = array();

        return $actions;
    }
    
    /**
     * Converts PHP errors into PHPCheckApi\Reporter\Result\Error
     * 
     * @param integer $errno
     * @param string  $errstr
     * @param string  $errfile
     * @param integer $errline
     * 
     * @return void|boolean
     */
    public static function errorHandler($errno, $errstr, $errfile, $errline)
    {
        if (!($errno & error_reporting())) {
            return;
        }

        $backtrace = debug_backtrace();
        array_shift($backtrace);

        var_dump(
            $errstr, $errno, $errfile, $errline, $backtrace
        );

        return true;
    }
}