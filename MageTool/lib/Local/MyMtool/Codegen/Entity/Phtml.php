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
class MyMtool_Codegen_Entity_Phtml extends MyMtool_Codegen_Entity_Abstract
{
    /**
     * Entity folder name
     * @var string
     */
    protected $_folderName = 'Block';

    /**
     * Create template name
     * @var string
     */
    protected $_createTemplate = 'block_blank';

    /**
     * Rewrite template name
     * @var string
     */
    protected $_rewriteTemplate = 'block_rewrite';

    /**
     * Entity name
     * @var string
     */
    protected $_entityName = 'Block';

    /**
     * Namespace in config file
     * @var string
     */
    protected $_configNamespace = 'blocks';
}
