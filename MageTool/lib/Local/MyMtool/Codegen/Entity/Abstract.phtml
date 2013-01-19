<?php
/**
 * Mage Tool
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category   MyMtool
 * @package    MyMtool_Codegen
 * @copyright  Copyright (C) 2011 Oggetto Web ltd (http://oggettoweb.com/)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Abstract code generator
 *
 * @category   MyMtool
 * @package    MyMtool_Codegen
 * @author     Carlo Tasca <carlo.tasca.mail@gmail.com>
 */
abstract class MyMtool_Codegen_Entity_Abstract extends Mtool_Codegen_Entity_Abstract
{
	/**
     * Create new entity
     * 
     * @param string $namespace 
     * @param string $path 
     * @param Mtool_Codegen_Entity_Module $module
     */
    public function createPhtml($namespace, $path, Mtool_Codegen_Entity_Module $module)
    {
        // Create class file
        $this->createClass($path, $this->_createTemplate, $module);

        // Create namespace in config if not exist
        $config = new Mtool_Codegen_Config($module->getConfigPath('config.xml'));
        $configPath = "global/{$this->_configNamespace}/{$namespace}/class";
        if (!$config->get($configPath)) {
            $config->set($configPath, "{$module->getName()}_{$this->_entityName}");
        }
    }
}