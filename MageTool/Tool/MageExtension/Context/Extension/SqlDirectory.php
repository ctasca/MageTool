<?php

class MageTool_Tool_MageExtension_Context_Extension_SqlDirectory extends Zend_Tool_Project_Context_Filesystem_Directory
{

    /**
     * @var string
     */
    protected $_filesystemName = 'sql';

    /**
     * getName()
     *
     * @return string
     */
    public function getName()
    {
        return 'SqlDirectory';
    }

}