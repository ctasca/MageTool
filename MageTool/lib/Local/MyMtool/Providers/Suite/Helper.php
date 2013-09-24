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
class MyMtool_Providers_Suite_Helper extends MyMtool_Providers_Suite_Entity
{
    /**
     * Get provider name
     * @return string
     */
    public function getName()
    {
        return 'mage-suite-helper';
    }

    /**
     * Create helper
     *
     * @param string $targetModule in format of companyname/modulename
     * @param string $helperPath in format of mymodule/helper_path
     */
    public function create($targetModule = null, $helperPath = null)
    {
        $this->_createEntity(new MyMtool_Codegen_Entity_Suite_Helper(), 'helper', $targetModule, $helperPath);
    }
}
