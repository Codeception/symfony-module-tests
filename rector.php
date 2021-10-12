<?php

declare(strict_types=1);

use Rector\Core\Configuration\Option;
use Rector\Core\ValueObject\PhpVersion;
use Rector\Doctrine\Set\DoctrineSetList;
use Rector\PHPUnit\Set\PHPUnitSetList;
use Rector\Set\ValueObject\SetList;
use Rector\Symfony\Set\SymfonySetList;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $config): void {
    $parameters = $config->parameters();

    $config->import(SetList::ACTION_INJECTION_TO_CONSTRUCTOR_INJECTION);
    $config->import(SetList::CODE_QUALITY);
    $config->import(SetList::CODING_STYLE);
    $config->import(SetList::FRAMEWORK_EXTRA_BUNDLE_50);
    $config->import(SetList::PHP_74);
    $config->import(SetList::PSR_4);
    $config->import(SetList::TYPE_DECLARATION);
    $config->import(SetList::TYPE_DECLARATION_STRICT);
    $config->import(SymfonySetList::SYMFONY_52);
    $config->import(SymfonySetList::SYMFONY_CODE_QUALITY);
    $config->import(SymfonySetList::SYMFONY_CONSTRUCTOR_INJECTION);
    $config->import(DoctrineSetList::DOCTRINE_ORM_29);
    $config->import(DoctrineSetList::DOCTRINE_DBAL_30);
    $config->import(DoctrineSetList::DOCTRINE_CODE_QUALITY);
    $config->import(DoctrineSetList::DOCTRINE_25);
    $config->import(PHPUnitSetList::PHPUNIT_91);
    $config->import(PHPUnitSetList::PHPUNIT_CODE_QUALITY);

    $parameters->set(Option::PHP_VERSION_FEATURES, PhpVersion::PHP_74);
};
