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
 * Phtml file generator
 *
 * @category   MyMtool
 * @package    MyMtool_Codegen
 * @author     Carlo Tasca <carlo.tasca.mail@gmail.com>
 */
class MyMtool_Codegen_Entity_Adminhtml_Phtml extends MyMtool_Codegen_Entity_Phtml
{
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

		$phtmlDir = 'app/design/adminhtml/default/default/' . $path ;
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
}
