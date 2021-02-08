<?php

declare(strict_types=1);

use Rector\Core\Configuration\Option;
use Rector\Set\ValueObject\SetList;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $config): void
{
    $parameters = $config->parameters();

    $parameters->set(Option::SETS, [
        SetList::CODE_QUALITY,
        SetList::CODE_QUALITY_STRICT,
        SetList::CODING_STYLE,
        SetList::DEAD_CODE,
        SetList::DEFLUENT,
        SetList::DOCTRINE_25,
        SetList::DOCTRINE_CODE_QUALITY,
        SetList::EARLY_RETURN,
        SetList::FRAMEWORK_EXTRA_BUNDLE_50,
        SetList::NAMING,
        SetList::PHP_74,
        SetList::PHPUNIT_90,
        SetList::PHPUNIT_CODE_QUALITY,
        SetList::PHPUNIT_EXCEPTION,
        SetList::PSR_4,
        SetList::SYMFONY_50,
        SetList::SYMFONY_50_TYPES,
        SetList::SYMFONY_CODE_QUALITY,
        SetList::SYMFONY_CONSTRUCTOR_INJECTION,
        SetList::TWIG_UNDERSCORE_TO_NAMESPACE,
        SetList::TYPE_DECLARATION,
        SetList::UNWRAP_COMPAT
    ]);
};
