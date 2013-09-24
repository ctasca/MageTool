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
class MyMtool_Codegen_Entity_Suite_Helper extends MyMtool_Codegen_Entity_Suite_Abstract
{
    /**
     * Entity folder name
     * @var string
     */
    protected $_folderName = 'Helper';

    /**
     * Create template name
     * @var string
     */
    protected $_createTemplate = 'suite_helper_blank';

    /**
     * Rewrite template name
     * @var string
     */
    protected $_rewriteTemplate = 'suite_helper_rewrite';

    /**
     * Entity name
     * @var string
     */
    protected $_entityName = 'Helper';

    /**
     * Namespace in config file
     * @var string
     */
    protected $_configNamespace = 'helpers';

    /**
     * TODO: implement rewrite in MyMtools. Just a copy from Mtool rewrite method at the mo.
     *
     * Rewrite Magento entity. Helpers have specific behavior - no alias in core configs.
     *
     * @param string  $originNamespace
     * @param string  $originPath
     * @param string  $path
     * @param \Mtool_Codegen_Entity_Module|\MyMtool_Codegen_Entity_Suite_Module $module
     */
    public function rewrite($originNamespace, $originPath, $path, MyMtool_Codegen_Entity_Suite_Module $module)
    {
        // Create own class
        $originPathSteps = $this->_ucPath(explode('_', $originPath));
        $originModuleName = ucfirst($originNamespace);
        $originClassName = implode('_', $originPathSteps);
        $params = array(
            'original_class_name' => "Mage_{$originModuleName}_{$this->_entityName}_{$originClassName}"
        );
        $className = $this->createClass($path, $this->_rewriteTemplate, $module, $params);

        // Register rewrite in config
        $config = new Mtool_Codegen_Config($module->getConfigPath('config.xml'));
        $config->set("global/{$this->_configNamespace}/{$originNamespace}/rewrite/{$originPath}", $className);
    }
}
