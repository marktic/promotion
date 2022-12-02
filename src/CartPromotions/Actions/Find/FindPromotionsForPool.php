<?php

declare(strict_types=1);

namespace Marktic\Promotion\CartPromotions\Actions\Find;

use Marktic\Promotion\CartPromotions\Models\CartPromotions;
use Marktic\Promotion\PromotionPools\Models\PromotionPoolsRecordTrait;
use Marktic\Promotion\Utility\PromotionModels;
use Nip\Records\Record;

class FindPromotionsForPool
{
    protected Record|PromotionPoolsRecordTrait $pool;
    protected CartPromotions $repository;

    protected string|null|array $type = null;

    final protected function __construct($pool, $repository = null)
    {
        $this->pool = $pool;
        $this->repository = $repository ?? PromotionModels::promotions();
    }

    public static function for($pool)
    {
        return new static($pool);
    }

    public function withType($type): static
    {
        $this->type = $type;

        return $this;
    }

    public function execute()
    {
        return $this->repository->findByParams($this->generateParams());
    }

    protected function generateParams(): array
    {
        $params = [
            'where' => [
                ['pool = ?', $this->pool->getManager()->getMorphName()],
                ['pool_id = ?', $this->pool->id],
            ],
        ];
        if ($this->type) {
            $params['where'][] = ['type = ?', $this->type];
        }

        return $params;
    }
}
