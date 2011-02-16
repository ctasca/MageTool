<?php
interface MageTool_Lint_Interface
{
    public function run($xml);
    
    public function validate($xml);
    
    /**
     * Can this lint class validate this file
     *
     * @param string $filePath The path from which the file can be loaded.
     * @return bool
     * @author Alistair Stead
     **/
    public function canValidate($filePath);
}