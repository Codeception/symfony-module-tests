# Codeception Symfony Module Tests

[![Actions Status](https://github.com/Codeception/symfony-module-tests/workflows/CI/badge.svg)](https://github.com/Codeception/symfony-module-tests/actions)

Minimal site containing functional tests for [Codeception Module Symfony](https://github.com/Codeception/module-symfony).

## Usage

The main purpose of this project is to verify the proper functioning of the `Codeception Module Symfony` in a minimal Symfony installation.

You can use it to contribute new features or propose changes in the module and verify that nothing is broken in the process.
If that's your goal, be sure to follow [the contribution guides](https://github.com/Codeception/module-symfony/blob/master/CONTRIBUTING.md) for the module.

You can also **fork it** and use it to reproduce a bug or unexpected behavior for analysis.
If that's your case, just add a link to your fork next to the description of your issue in the module's repository.

Lastly, if you just want to see the module in action and run the tests yourself on your local machine just:

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

Then, go to the project directory and run:

```shell
vendor/bin/codecept run Functional
```

### Create Unit Suite or Acceptance Suite

To create [Unit Tests](https://codeception.com/docs/05-UnitTests) or [Acceptance Tests](https://codeception.com/docs/03-AcceptanceTests), you need to create the corresponding suite first:
```shell
vendor/bin/codecept generate:suite Unit
vendor/bin/codecept generate:suite Acceptance
```

### Using local code for tests

Assuming you have the following directory structure:
```
Codeception/
├─ module-symfony/
├─ symfony-module-tests/
│  ├─ composer.json
│  ├─ composer.lock
```

Add code listed below to the composer.json and run `composer update`.
```
{
  // ...
  "repositories": [
    {
      "type": "path",
      "url": "../module-symfony"
    }
  ]
}
```

Don't forget to revert composer.json and run `composer update` before commit changes.
