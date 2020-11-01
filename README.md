# Codeception Symfony Module Tests
Minimal site containing functional tests for [Codeception Module Symfony](https://github.com/Codeception/module-symfony).

### Installation

1. Clone the repo
   ```sh
   git clone https://github.com/TavoNiievez/codeception-symfony-tests.git
   ```
2. Install Composer dependencies
   ```sh
   composer install
   ```
3. Install Yarn packages and compile the assets
   ```sh
   yarn install
   
   yarn encore dev
   ```
4. Update database schema and load Doctrine fixtures
   ```sh
   symfony console d:s:u -f
   
   symfony console d:f:l -q
   ```
### Usage
   ```sh
   symfony serve -d
   
   vendor/bin/codecept run Functional
   ```
