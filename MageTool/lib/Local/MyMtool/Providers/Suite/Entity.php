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
 * @package    MyMtool_Providers
 * @copyright  Copyright (C) 2011 Oggetto Web ltd (http://oggettoweb.com/)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Mage entity provider
 *
 * @category   MyMtool
 * @package    MyMtool_Providers
 * @author     Carlo Tasca <carlo.tasca.mail@gmail.com>
 */
class MyMtool_Providers_Suite_Entity extends Mtool_Providers_Entity
{
    /**
     * Create entity
     *
     * @param Mtool_Codegen_Entity_Abstract $entity
     * @param string $name
     * @param string $targetModule in format of companyname/modulename
     * @param string $entityPath in format of mymodule/model_path
     */
    protected function _createEntity($entity, $name, $targetModule = null, $entityPath = null)
    {
        if ($targetModule == null) {
            $targetModule = $this->_ask('Enter the target module (in format of Mycompany/SuiteName/ModuleName)');
        }
        if ($entityPath == null) {
            $entityPath = $this->_ask("Enter the {$name} path (in format of suitename_modulename/{$name}_path)");
        }

        list($companyName, $suiteName, $moduleName) = explode('/', $targetModule);

        $module = new MyMtool_Codegen_Entity_Suite_Module(getcwd(), $moduleName, $suiteName, $companyName, $this->_getConfig());

        list($namespace, $entityName) = explode('/', $entityPath);

        $entity->create($namespace, $entityName, $module);

        $this->_answer('Done');
    }
}
