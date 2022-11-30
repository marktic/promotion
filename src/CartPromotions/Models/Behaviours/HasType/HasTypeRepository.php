<?php

declare(strict_types=1);

namespace Marktic\Promotion\CartPromotions\Models\Behaviours\HasType;

trait HasTypeRepository
{
    use \ByTIC\Models\SmartProperties\RecordsTraits\HasTypes\RecordsTrait;

    public function getTypeItemsRootNamespace(): string
    {
        return 'Marktic\Promotion\CartPromotions\Models\Types\\';
    }

    public function getTypeItemsDirectory(): string
    {
        return \dirname(__DIR__, 2) . '/Types';
    }
}
