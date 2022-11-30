<?php

declare(strict_types=1);

namespace Marktic\Promotion\CartPromotions\Models;

use Marktic\Promotion\Base\Models\Behaviours\HasActions\RepositoryHasPromotionActions;
use Marktic\Promotion\Base\Models\Behaviours\HasRules\RepositoryHasPromotionRules;
use Marktic\Promotion\Base\Models\Behaviours\Timestampable\TimestampableManagerTrait;
use Marktic\Promotion\CartPromotions\Events\CartPromotionCreated;
use Marktic\Promotion\CartPromotions\Observers\DeletePromotionCodes;
use Marktic\Promotion\CartPromotions\Observers\UpdatePromotionCodes;
use Marktic\Promotion\Utility\PackageConfig;
use Marktic\Promotion\Utility\PromotionModels;
use Nip\Records\EventManager\Events\Event;

trait CartPromotionsTrait
{
    use Behaviours\HasType\HasTypeRepository;

    use RepositoryHasPromotionActions;
    use RepositoryHasPromotionRules;
    use TimestampableManagerTrait;

    protected function bootCartPromotionsTrait(): void
    {
        static::created(function ($event) {
            /** @var Event $event */
            $model = $event->getRecord();
            event(new CartPromotionCreated($model));
            UpdatePromotionCodes::for($model);
        });

        static::deleting(function ($event) {
            /** @var Event $event */
            DeletePromotionCodes::for($event->getRecord());
        });
        static::updating(function ($event) {
            /** @var Event $event */
            UpdatePromotionCodes::for($event->getRecord());
        });
    }

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
        $this->initRelationsPromotionCodes();
        $this->initRelationsPromotionActions();
        $this->initRelationsPromotionRules();
        $this->initRelationsPromotionSessions();
    }

    protected function initRelationsPromotionPool(): void
    {
        $this->morphTo(CartPromotions::RELATION_POOL, ['morphPrefix' => 'pool', 'morphTypeField' => 'pool']);
    }

    protected function initRelationsPromotionCodes(): void
    {
        $this->hasMany(CartPromotions::RELATION_CODES, ['class' => \get_class(PromotionModels::promotionCodes())]);
    }

    protected function initRelationsPromotionSessions(): void
    {
        $this->hasMany(CartPromotions::RELATION_SESSIONS, ['class' => \get_class(PromotionModels::promotionSessions())]);
    }

    public function generatePrimaryFK()
    {
        return 'promotion_id';
    }

    protected function generateTable(): string
    {
        return PackageConfig::tableName(PromotionModels::PROMOTIONS, CartPromotions::TABLE);
    }
}
