# Codeception Symfony Module Tests
Minimal site containing functional tests for [Codeception Module Symfony](https://github.com/Codeception/module-symfony).

## Installation

1. Clone the repo
   ```shell
   git clone https://github.com/Codeception/symfony-module-tests.git
   ```
2. Install Composer dependencies
   ```shell
   composer update
   ```
3. Update database schema and load Doctrine fixtures
   ```shell
   php bin/console doctrine:schema:update --force
   
   php bin/console doctrine:fixtures:load --quiet
   ```

## Usage

```shell
vendor/bin/codecept run Functional
```

### Create Unit Suite or Acceptance Suite

To create [Unit Tests](https://codeception.com/docs/05-UnitTests) or [Acceptance Tests](https://codeception.com/docs/03-AcceptanceTests), you need to create the corresponding suite first:
```shell
vendor/bin/codecept generate:suite Unit
vendor/bin/codecept generate:suite Acceptance
```
