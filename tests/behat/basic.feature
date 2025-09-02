@local @local_confetti
Feature: Basic tests for Confetti

  @javascript
  Scenario: Plugin local_confetti appears in the list of installed additional plugins
    Given I log in as "admin"
    When I navigate to "Plugins > Plugins overview" in site administration
    And I follow "Additional plugins"
    Then I should see "Confetti"
    And I should see "local_confetti"
