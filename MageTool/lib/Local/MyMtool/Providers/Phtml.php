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
 * Phtml file provider
 *
 * @category   MyMtool
 * @package    MyMtool_Providers
 * @author     Carlo Tasca <carlo.tasca.mail@gmail.com>
 */
class MyMtool_Providers_Phtml extends MyMtool_Providers_Entity
{
    /**
     * Get provider name
     * @return string
     */
    public function getName()
    {
        return 'mage-phtml';
    }
	
	/**
     * Create block
     *
     * @param string $targetModule in format of companyname/modulename
     * @param string $blockPath in format of mymodule/block_path
     */
    public function create($targetModule = null, $blockPath = null, $phtml = null)
    {
        $this->_createPhtmlEntity(new MyMtool_Codegen_Entity_Phtml(), '.phtml file', $targetModule, $blockPath, $phtml);
    }
}
