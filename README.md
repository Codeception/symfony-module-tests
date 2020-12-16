# Codeception Symfony Module Tests
Minimal site containing functional tests for [Codeception Module Symfony](https://github.com/Codeception/module-symfony).

### Installation

1. Clone the repo:  
   If you're using this project to create a Pull Request to the Symfony Module (see `CONTRIBUTING.md`):
   1. Click on the "Fork" button here on this page.
   2. Then, in your terminal, do:
   ```shell
   git clone https://github.com/YourUserName/symfony-module-tests.git
   cd symfony-module-tests
   git remote add upstream https://github.com/Codeception/symfony-module-tests.git
   git pull upstream master
   git rebase upstream/master
   git checkout -b new_feature
   ```
   Otherwise:
   ```shell
   git clone https://github.com/Codeception/symfony-module-tests.git
   ```
2. Install Composer dependencies
   ```shell
   # PHP ^7.2
   composer update
   
   # PHP ^8.0
   composer update --ignore-platform-req=php
   ```
3. Update database schema and load Doctrine fixtures
   ```shell
   php bin/console doctrine:schema:update --force
   
   php bin/console doctrine:fixtures:load --quiet
   ```
### Usage
   ```shell
   vendor/bin/codecept run Functional
   ```

