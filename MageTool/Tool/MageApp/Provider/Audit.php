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
        /**
         * Error reporting
         */
        
        $this->_bootstrap();

        $deprecatedStaticMethods = array();
        $deprecatedMethods = array();

        $fileIterator = $this->_getFiles('./app/');

        foreach ($fileIterator as $filename => $fileinfo) {
            $class = null;
            $tokens = token_get_all(file_get_contents($filename));
            $numTokens = count($tokens);
            $classToken = false;
            foreach ($tokens as $token) {
                if (is_array($token)) {
                    if ($token[0] === T_CLASS) {
                        $classToken = true;
                    } else if ($classToken && $token[0] === T_STRING) {
                        $classToken = false;
                        try {
                            echo $token[1] . "\n";
                            echo $filename . "\n";
                            // include_once $filename;
                            if (class_exists($token[1])) {
                                $reflection = new ReflectionClass($token[1]);
                            }
                        } catch (Exception $e) {
                            echo $e->getMessage() . "\n";
                        }
                    }
                }
            }
        }
    }
    
    
    /**
     * Retrieve an array of file paths after recursively searching
     * the file system based on a regex pattern.
     *
     * @return RegexIterator
     * @author Alistair Stead
     **/
    protected function _getFiles($path = null, $pattern = null)
    {
        if (is_null($path)) {
            $path = '.';
        }
        if (is_null($pattern)) {
            $pattern = '/^.+\.php$/i';
        }
        
        $recursiveDirectoryIterator = new RecursiveDirectoryIterator($path);
        $recursiveIteratorIterator = new RecursiveIteratorIterator($recursiveDirectoryIterator);
        return new RegexIterator($recursiveIteratorIterator, $pattern, RecursiveRegexIterator::GET_MATCH);
    }
}