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
class MyMtool_Providers_FrontendPhtml extends MyMtool_Providers_Entity
{
    protected function _askPath ($name) 
	{
		return $this->_ask("Enter the {$name} path (in format of base/default/template)");
	}
	/**
     * Get provider name
     * @return string
     */
    public function getName()
    {
        return 'mage-frontend-phtml';
    }
	
	/**
     * Create block
     *
     * @param string $targetModule in format of companyname/modulename
     * @param string $blockPath in format of mymodule/block_path
     */
    public function create($targetModule = null, $path = null, $phtml = null)
    {
        $this->_createPhtmlEntity(new MyMtool_Codegen_Entity_Frontend_Phtml(), '.phtml file', $targetModule ,$path, $phtml);
    }
}
