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
 * Abstract code generator for suite modules
 *
 * @category   MyMtool
 * @package    MyMtool_Codegen
 * @author     Carlo Tasca <carlo.tasca.mail@gmail.com>
 */
abstract class MyMtool_Codegen_Entity_Suite_Abstract extends Mtool_Codegen_Entity_Abstract
{
    /**
     * Create new entity
     *
     * @param string  $namespace suitename_modulename_
     * @param string  $path
     * @param \Mtool_Codegen_Entity_Module|\MyMtool_Codegen_Entity_Suite_Module $module
     */
    public function create($namespace, $path, MyMtool_Codegen_Entity_Suite_Module $module)
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

    /**
     * Create class file
     *
     * @param string $path in format: class_path_string
     * @param string $template
     * @param Mtool_Codegen_Entity_Module $module
     * @param array $params
     * @return resulting class name
     */
    public function createClass($path, $template, $module, $params = array())
    {
        $pathSteps = $this->_ucPath(explode('_', $path));
        $className = implode('_', $pathSteps);
        $classFilename = array_pop($pathSteps) . '.php';
        // Create class dir under module
        $classDir = Mtool_Codegen_Filesystem::slash($module->getDir()) . $this->_folderName .
            DIRECTORY_SEPARATOR .
            implode(DIRECTORY_SEPARATOR, $pathSteps);
        Mtool_Codegen_Filesystem::mkdir($classDir);
        // Move class template file
        $classTemplate = new MyMtool_Codegen_Template($template);
        $resultingClassName = "{$module->getName()}_{$this->_entityName}_{$className}";
        $defaultParams = array(
            'company_name' => $module->getCompanyName(),
            'suite_name' => $module->getSuiteName(),
            'module_name' => $module->getModuleName(),
            'class_name' => $resultingClassName,
            'year' => date('Y'),
        );

        $classTemplate->setParams(array_merge($defaultParams, $params, $module->getTemplateParams()));
        $classTemplate
            ->move($classDir, $classFilename);

        return $resultingClassName;
    }
}