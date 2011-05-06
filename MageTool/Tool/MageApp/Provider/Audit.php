<?php

/**
 * @see MageTool_Tool_MageApp_Provider_Abstract
 */
require_once 'MageTool/Tool/MageApp/Provider/Abstract.php';
require_once 'Zend/Tool/Framework/Provider/Pretendable.php';

/**
 * MageTool_Tool_MageApp_Provider_Audit adds commands to audit the project code
 *
 * @package MageTool_MageApp_Providor
 * @author Alistair Stead
 **/
class MageTool_Tool_MageApp_Provider_Audit extends MageTool_Tool_MageApp_Provider_Abstract 
    implements Zend_Tool_Framework_Provider_Pretendable
{
    /**
     * Define the name of the provider
     *
     * @return string
     * @author Alistair Stead
     **/
    public function getName()
    {
        return 'MageAudit';
    }
    
    /**
     * Search for deprecated methods in the codebase.
     * Then search for these methods being called in other locations
     *
     * @return void
     * @author Alistair Stead
     **/
    public function deprecated()
    {
        $this->_bootstrap();
        
        $deprecatedStaticMethods = array();
        $deprecatedMethods = array();

        $recursiveDirectoryIterator = new RecursiveDirectoryIterator('.');
        $recursiveIteratorIterator = new RecursiveIteratorIterator($recursiveDirectoryIterator);
        $regexIterator = new RegexIterator($recursiveIteratorIterator, '/^.+\.php$/i', RecursiveRegexIterator::GET_MATCH);

        foreach ($regexIterator as $filename => $fileinfo) {
            $class = null;
            $tokens = token_get_all(file_get_contents($filename));
            $numTokens = count($tokens);
            $classToken = false;
            foreach ($tokens as $token) {
                if (is_array($token)) {
                    if ($token[0] === T_CLASS) {
                        $classToken = true;
                    } else if ($classToken && $token[0] === T_STRING) {
                        include_once $filename;
                        $reflection = new ReflectionClass($token[1]);
                        $class_token = false;
                    }
                }       
            }
        }
    }
}