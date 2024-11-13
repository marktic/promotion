<?php

declare(strict_types=1);

namespace Marktic\Promotion\GiftCards\Models;

use Marktic\Promotion\Base\Models\Behaviours\HasActions\RepositoryHasPromotionActions;
use Marktic\Promotion\Base\Models\Behaviours\HasPool\RepositoryHasPool;
use Marktic\Promotion\Base\Models\Behaviours\HasRules\RepositoryHasPromotionRules;
use Marktic\Promotion\Base\Models\Behaviours\Timestampable\TimestampableManagerTrait;
use Marktic\Promotion\GiftCards\Events\GiftCardCreated;
use Marktic\Promotion\GiftCards\Observers\DeletePromotionCodes;
use Marktic\Promotion\GiftCards\Observers\UpdatePromotionCodes;
use Marktic\Promotion\Utility\PackageConfig;
use Marktic\Promotion\Utility\PromotionModels;
use Nip\Records\EventManager\Events\Event;

trait GiftCardsTrait
{
    use RepositoryHasPool;
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
    }

    protected function generateTable(): string
    {
        return PackageConfig::tableName(PromotionModels::GIFT_CARDS, GiftCards::TABLE);
    }
}
