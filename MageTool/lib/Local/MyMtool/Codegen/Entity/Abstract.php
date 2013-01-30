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
     * Create new phtml entity
     *  
     * @param string $path 
     * @param string $filename
     */
    public function createPhtml($module, $path, $filename)
    {
        // Create phtml file
        $this->createDesignFile($module,$this->_createTemplate, $path, $filename);
    }
	
	/**
     * Create new phtml entity
     *  
     * @param string $path 
     * @param string $filename
     */
    public function createConfigEvent($module, $area, $event, $observer, $class, $method)
    {
        // Create event config node
        $this->createEventConfigNode($module, $area, $event, $observer, $class, $method);
    }
	
	/**
     * Create new phtml entity
     *  
     * @param string $path 
     * @param string $filename
     */
    public function setConfigVersion($module, $version)
    {
        // Create event config node
        $this->setConfigVersionNode($module, $version);
    }
	
	/**
     * Create new phtml entity
     *  
     * @param string $path 
     * @param string $filename
     */
    public function setConfigLayout($module, $area, $layout)
    {
        // Create event config node
        $this->setConfigLayoutNode($module, $area, $layout);
    }
	
	/**
     * Create design file
     * 
     * @param string $path in format: class_path_string 
     * @param string $template 
     * @param Mtool_Codegen_Entity_Module $module
     * @param array $params 
     * @return resulting class name
     */
    public function createDesignFile($module, $template, $path, $filename, $params = array())
    {

		$phtmlDir = 'app/design/' . $path ;
		$phtmlFilename = $filename . '.phtml';
        // Create class dir under design folder (when in Magento home dir)
		Mtool_Codegen_Filesystem::mkdir( $phtmlDir );
		$phtmlTemplate = new MyMtool_Codegen_Template($template);
		$defaultParams = array(
            'company_name' => $module->getCompanyName(),
            'module_name' => $module->getModuleName(),
            'year' => date('Y'),
        );
		$phtmlTemplate->setParams(array_merge($defaultParams, $params, $module->getTemplateParams()));
		$phtmlTemplate->move($phtmlDir, $phtmlFilename);
        return $phtmlDir;
    }
	
	public function createEventConfigNode ($module, $area, $event, $observer, $class, $method)
	{
		$config = new Mtool_Codegen_Config($module->getConfigPath('config.xml'));
		$configPath = "$area/events/$event/observers/$observer";
        $config->set($configPath . '/class', $class);
        $config->set($configPath . '/method', $method);
	}
	
	public function setConfigVersionNode ($module, $version)
	{
		$config = new Mtool_Codegen_Config($module->getConfigPath('config.xml'));
		$configPath = "modules/{$module->getName()}/version";
		$config->set($configPath, $version);
	}
	
	public function setConfigLayoutNode ($module, $area, $layout)
	{
		$config = new Mtool_Codegen_Config($module->getConfigPath('config.xml'));
		$lcModuleName = strtolower($module->getModuleName());
		$configPath = "$area/layout/updates/$lcModuleName";
        $config->set($configPath . '/file', $layout);
	}
}