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
        SetList::CODE_QUALITY_STRICT,
        SetList::CODING_STYLE,
        SetList::DEAD_CODE,
        SetList::DEFLUENT,
        SetList::EARLY_RETURN,
        SetList::FRAMEWORK_EXTRA_BUNDLE_50,
        SetList::MONOLOG_20,
        SetList::NAMING,
        SetList::PHP_73,
        SetList::PSR_4,
        SetList::TYPE_DECLARATION,
        SetList::TYPE_DECLARATION_STRICT,
        SetList::UNWRAP_COMPAT,
    ]);
};
