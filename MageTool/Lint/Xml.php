<?php

class MageTool_Lint_Xml
    extends MageTool_Lint_Abstract
{
    /**
     * Validate the XML config is correctly structured
     *
     * @return void
     * @author Alistair Stead
     **/
    public function validate($config)
    { 
        try {
            // Retrieve an array of modules
            $modules = $config->loadModules()->getNode('modules')->children();
            foreach ($modules as $modName => $module) {
                if ($module->is('active')) {
                    // Find all configuration within the module
                    $configFiles = glob($config->getModuleDir('etc', $modName).DS.'*.xml');
                    while ($filePath = next($configFiles)) {
                        $configString = file_get_contents($filePath);
                        new SimpleXMLElement($configString);
                    }
                }
            }
        } catch (Exception $e) {
            throw new MageTool_Lint_Exception($e->getMessage());
        }
    }
}