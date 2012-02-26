Feature: Developer uses MageApp.App providor
  As a developer
  In order to know which version of MageTool is being run
  I want a command line option that allows just that

  Scenario: version
    When I use the command "zf version mage-app"
    Then I should see
    """
    1.0.0.0
    """
