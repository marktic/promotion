<?php

declare(strict_types=1);

namespace Marktic\Promotion\GiftProducts\Models\Behaviours\HasType;

trait HasTypeRepository
{
    use \ByTIC\Models\SmartProperties\RecordsTraits\HasTypes\RecordsTrait;

    public function getTypeItemsRootNamespace(): string
    {
        return 'Marktic\Promotion\GiftProducts\Models\Types\\';
    }

    public function getTypeItemsDirectory(): string
    {
        return \dirname(__DIR__, 2) . '/Types';
    }
}
