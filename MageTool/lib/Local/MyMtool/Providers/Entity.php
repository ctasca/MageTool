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
class MyMtool_Providers_Entity extends Mtool_Providers_Entity
{
	
	protected function _askPath ($name) 
	{
		return $this->_ask("Enter the {$name} path (in format of frontend/base/default/template)");
	}
	/**
     * Create entity
     *
     * @param Mtool_Codegen_Entity_Abstract $entity
     * @param string $name
	 * @param string $targetModule
     * @param string $entityPath in format of mymodule/model_path
     * @param string $filename in format of filename (without phtml extension)
     */
    protected function _createPhtmlEntity($entity, $name, $targetModule = null, $entityPath = null, $filename = null)
    {
        if ($targetModule == null) {
            $targetModule = $this->_ask('Enter the target module (in format of Mycompany/Mymodule)');
        }
        if ($entityPath == null) {
            $entityPath = $this->_askPath($name);
        }
		if ($filename == null) {
            $filename = $this->_ask("Enter the {$name} name (without .phtml extension)");
        }
		list($companyName, $moduleName) = explode('/', $targetModule);
        $module = new Mtool_Codegen_Entity_Module(getcwd(), $moduleName, $companyName, $this->_getConfig());
		$entity->createPhtml($module, $entityPath, $filename);
        $this->_answer('Done');
    }
	
	protected function _createConfigEvent($entity, $name, $targetModule = null, $area = null, $event = null, $observer = null, $class = null, $method = null)
	{
		if ($targetModule == null) {
            $targetModule = $this->_ask('Enter the target module (in format of Mycompany/Mymodule)');
        }
		if ($area == null) {
            $area = $this->_ask('Enter the event area (global, frontend, default or admin)');
        }
        if ($event == null) {
            $event = $this->_ask('Enter the event node (in format of controller_action_layout_render_before)');
        }
		if ($observer == null) {
            $observer = $this->_ask('Enter the observer node (in format of module_observer)');
        }
		if ($class == null) {
            $class = $this->_ask('Enter the observer model class (in format of module/observer)');
        }
		if ($method == null) {
            $method = $this->_ask('Enter the observer method (in format of observerMethod)');
        }
		list($companyName, $moduleName) = explode('/', $targetModule);
        $module = new Mtool_Codegen_Entity_Module(getcwd(), $moduleName, $companyName, $this->_getConfig());
		$entity->createConfigEvent($module, $area, $event, $observer, $class, $method);
        $this->_answer('Done');
	}
	
	protected function _setConfigVersion ($entity, $name, $targetModule = null, $version = null)
	{
		if ($targetModule == null) {
            $targetModule = $this->_ask('Enter the target module (in format of Mycompany/Mymodule)');
        }
		
		if ($version == null) {
            $version = $this->_ask('Enter the version number (e.g. 1.0.1)');
        }
		
		list($companyName, $moduleName) = explode('/', $targetModule);
        $module = new Mtool_Codegen_Entity_Module(getcwd(), $moduleName, $companyName, $this->_getConfig());
		$entity->setConfigVersion($module, $version);
        $this->_answer('Done');
	}
	
	protected function _setConfigLayout($entity, $name, $targetModule = null, $area = null, $layout = null)
	{
		if ($targetModule == null) {
            $targetModule = $this->_ask('Enter the target module (in format of Mycompany/Mymodule)');
        }
		if ($area == null) {
            $area = $this->_ask('Enter the layout area (frontend or adminhtml)');
        }
        if ($layout == null) {
            $layout = $this->_ask('Enter the layout file (in format of dir/filename.xml)');
        }
		list($companyName, $moduleName) = explode('/', $targetModule);
        $module = new Mtool_Codegen_Entity_Module(getcwd(), $moduleName, $companyName, $this->_getConfig());
		$entity->setConfigLayout($module, $area, $layout);
        $this->_answer('Done');
	}

}
