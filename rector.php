<?php

declare(strict_types=1);

use Rector\Core\Configuration\Option;
use Rector\Set\ValueObject\SetList;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $config): void
{
    $parameters = $config->parameters();

    $parameters->set(Option::SETS, [
        SetList::ACTION_INJECTION_TO_CONSTRUCTOR_INJECTION,
        SetList::CODE_QUALITY,
        SetList::CODING_STYLE,
        SetList::DEAD_CODE,
        SetList::DOCTRINE_CODE_QUALITY,
        SetList::DOCTRINE_25,
        SetList::FRAMEWORK_EXTRA_BUNDLE_50,
        SetList::NAMING,
        SetList::PERFORMANCE,
        SetList::PHP_CODE_SNIFFER_30,
        SetList::PHP_DI_DECOUPLE,
        SetList::PHP_74,
        SetList::PHPSTAN,
        SetList::PRIVATIZATION,
        SetList::PSR_4,
        SetList::SOLID,
        SetList::SYMFONY_CODE_QUALITY,
        SetList::SYMFONY_CONSTRUCTOR_INJECTION,
        SetList::SYMFONY_50,
        SetList::SYMFONY_50_TYPES,
        SetList::TWIG_UNDERSCORE_TO_NAMESPACE,
        SetList::TYPE_DECLARATION,
        SetList::UNWRAP_COMPAT
    ]);
};
