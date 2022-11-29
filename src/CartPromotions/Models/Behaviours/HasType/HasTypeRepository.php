<?php

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
        return dirname(dirname(__DIR__)) . '/Types';
    }
}
