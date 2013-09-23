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
 * @package    Mtool_Codegen
 * @copyright  Copyright (C) 2011 Oggetto Web ltd (http://oggettoweb.com/)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * File template class
 *
 * @category   Mtool
 * @package    Mtool_Codegen
 * @author     Daniel Kocherga <dan@oggettoweb.com>
 */
class MyMtool_Codegen_Config extends Mtool_Codegen_Config
{
	protected function _fixCDATA($string)
	{
		$find[] = '&lt;![CDATA[';
		$replace[] = '<![CDATA[';

		$find[] = ']]&gt;';
		$replace[] = ']]>';

		return $string = str_replace($find, $replace, $string);
	}
	
	protected function _toHtml($string)
	{
		$find[] = '&lt;';
		$replace[] = '<';

		$find[] = '&gt;';
		$replace[] = '>';

		return $string = str_replace($find, $replace, $string);
	}
	
	

	/**
	 * Set config value
	 *
	 * @param string $path separated by slash (/)
	 * @param string $value
	 * @param bool $cdata
	 */
	public function set($path, $value, $cdata = false)
	{
		$segments = explode('/', $path);
		$node = $this->_xml;
		foreach ($segments as $_key => $_segment) {
			if (!$node->$_segment->getName()) {
				$node->addChild($_segment);
			}

			if ($_key == count($segments) - 1) {
				if ($cdata) {
					$node->$_segment = '<![CDATA[' . $value . ']]>';
				} else {
					$node->$_segment = $value;
				}
			}

			$node = $node->$_segment;
		}

		Mtool_Codegen_Filesystem::write($this->_path, $this->asPrettyXML($cdata));
	}

    /**
     * Format xml with indents and line breaks
     *
     * @param bool $cdata
     * @return string
     * @author Gary Malcolm
     */
    public function asPrettyXML($cdata = false)
    {
		if ($cdata) {
			$string = $this->_fixCDATA($this->_xml->asXML());
		} else {
			$string = $this->_xml->asXML();
		}
        // put each element on it's own line
        $string =preg_replace("/>\s*</",">\n<",$string);

        // each element to own array
        $xmlArray = explode("\n",$string);

        // holds indentation
        $currIndent = 0;

        $indent = "    ";
        // set xml element first by shifting of initial element
        $string = array_shift($xmlArray) . "\n";
        foreach($xmlArray as $element)
        {
            // find open only tags... add name to stack, and print to string
            // increment currIndent
            if (preg_match('/^<([\w])+[^>\/]*>$/U',$element))
            {
               $string .=  str_repeat($indent, $currIndent) . $element . "\n";
               $currIndent += 1;
            } // find standalone closures, decrement currindent, print to string
            elseif ( preg_match('/^<\/.+>$/',$element))
            {
               $currIndent -= 1;
               $string .=  str_repeat($indent, $currIndent) . $element . "\n";
            } // find open/closed tags on the same line print to string
            else
               $string .=  str_repeat($indent, $currIndent) . $element . "\n";
        }
        return $string;
    }

}