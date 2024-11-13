<?php

declare(strict_types=1);

namespace Marktic\Promotion\Base\Models\Behaviours\HasPool;

trait RepositoryHasPool
{
    protected function initRelationsPromotionPool(): void
    {
        $this->morphTo(
            RepositoryHasPoolInterface::RELATION_POOL,
            ['morphPrefix' => 'pool', 'morphTypeField' => 'pool']
        );
    }
}
