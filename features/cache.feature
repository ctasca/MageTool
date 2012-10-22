Feature: Cache
  In order to interact with Magento Cache
  As a Developer
  I want a cache command

  Scenario: list
    When I run command "bin/mt list"
    Then I should see
    """
    cache
      cache:clear     Clear Magento cache
      cache:disable   Disable Magento cache
      cache:enable    Enable Magento cache
      cache:flush     Flush Magento cache
      cache:status    View Magento cache status
    """
