# Codeception Symfony Module Tests
Minimal site containing functional tests for [Codeception Module Symfony](https://github.com/Codeception/module-symfony).

### Installation

1. Clone the repo
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

