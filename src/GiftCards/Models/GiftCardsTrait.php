<?php

declare(strict_types=1);

namespace Marktic\Promotion\GiftCards\Models;

use ByTIC\Models\SmartProperties\RecordsTraits\HasStatus\RecordsTrait as HasStatusRecordsTrait;
use Marktic\Promotion\Base\Models\Behaviours\HasPool\RepositoryHasPool;
use Marktic\Promotion\Base\Models\Behaviours\Timestampable\TimestampableManagerTrait;
use Marktic\Promotion\Utility\PackageConfig;
use Marktic\Promotion\Utility\PromotionModels;
use Nip\Records\Traits\HasUuid\HasUuidRecordManagerTrait;

trait GiftCardsTrait
{
    use RepositoryHasPool;
    use HasUuidRecordManagerTrait;
    use HasStatusRecordsTrait;
    use TimestampableManagerTrait;

    /**
     * @return void
     */
    protected function initRelations()
    {
        parent::initRelations();
        $this->initRelationsPromotions();
    }

    protected function initRelationsPromotions(): void
    {
        $this->initRelationsPromotionPool();

        $this->belongsTo(
            'GiftProduct',
            ['class' => \get_class(PromotionModels::giftProducts()), 'fk' => 'product_id'],
        );
    }

    protected function generateTable(): string
    {
        return PackageConfig::tableName(PromotionModels::GIFT_CARDS, GiftCards::TABLE);
    }

    public function generateMorphName(): string
    {
        return GiftCards::CONTROLLER;
    }

    public function getUrlPK()
    {
        return 'uuid';
    }

    /**
     * @return string
     */
    public function getStatusesDirectory(): string
    {
        return dirname(__FILE__, 2) . DIRECTORY_SEPARATOR . 'CardStatuses';
    }

    /**
     * @return string
     */
    public function getStatusNamespace()
    {
        return '\Marktic\Promotion\GiftCards\CardStatuses\\';
    }

}
