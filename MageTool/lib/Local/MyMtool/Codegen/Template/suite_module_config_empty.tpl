<?xml version="1.0" encoding="UTF-8"?>
<!--
/**
 * #{company_name} extension for Magento
 *
 * Long description of this file (if any...)
 *
 * NOTICE OF LICENSE
 *
#{license}
 * 
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade
 * the #{company_name} #{suite_name} #{module} module to newer versions in the future.
 * If you wish to customize the #{company_name} #{suite_name} #{module} module for your needs
 * please refer to http://www.magentocommerce.com for more information.
 *
 * @category   #{company_name}
 * @package    #{module_name}
 * @copyright  Copyright (C) #{year} #{copyright_company}
 * @license    #{license_short}
 */
-->
<config>
    <default>
        <web>
            <routers>
                <suite>
                    <area>frontend</area>
                    <class>#{suite_standard_router}</class>
                </suite>
                <suiteadmin>
                    <area>admin</area>
                    <class>#{suite_admin_router}</class>
                </suiteadmin>
            </routers>
        </web>
     </default>
</config>
