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
 * @category   Mtool
 * @package    Mtool_Providers
 * @copyright  Copyright (C) 2011 Oggetto Web ltd (http://oggettoweb.com/)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Module provider
 *
 * @category   MyMtool
 * @package    MyMtool_Providers
 * @author     Daniel Kocherga <dan@oggettoweb.com>
 */
class MyMtool_Providers_Suite_Module extends Mtool_Providers_Abstract
{
    /**
     * Get provider name
     * @return string
     */
    public function getName()
    {
        return 'mage-suite-module';
    }

    /**
     * Create module
     * @param string $name in format of companyname/modulename
     */
    public function create($name = null)
    {
        if ($name == null) {
            $companyName = $this->_ask('Enter the company name');
            $suiteName = $this->_ask('Enter the suite name');
            $moduleName = $this->_ask('Enter the module name');
        }
        else list($companyName, $suiteName, $moduleName) = explode('/', $name);

        $module = new MyMtool_Codegen_Entity_Suite_Module(getcwd(), $moduleName, $suiteName, $companyName, $this->_getConfig());
        $module->createDummy();

        $this->_answer('Done');
    }

}
