Feature: Compiled to Phar
  In order to make distribution and installation simple
  As a Developer
  I want MageTool compiled to mt.phar

  Scenario: Compiler
    Given I have compiled the mt.phar
    When I run command "php mt.phar"
    Then I should see
    """
    MageTool
    """
    And I should not see
    """
    @package_version@
    """
