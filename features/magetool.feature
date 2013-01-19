Feature: Developer uses MageTool providor
  As a developer
  In order to know which version of MageTool is being run
  I want a command line option that allows just that

  Scenario: version
    When I use the command "zf version mage-tool"
    Then I should see
    """
    MageTool 0.5.1beta
    """
