<?php

declare(strict_types=1);

namespace Marktic\Promotion\Base\Actions\Behaviours;

use Nip\Records\Record;

trait ActionHasPool
{
    protected ?Record $poolRecord = null;
    protected ?string $pool = null;
    protected ?int $pool_id = null;

    public static function forPool($pool)
    {
        $action = new static();
        $action->setPoolRecord($pool);
        return $action;
    }

    public function setPoolRecord(?Record $poolRecord): self
    {
        $this->poolRecord = $poolRecord;
        $this->pool = $poolRecord->getManager()->getMorphName();
        $this->pool_id = method_exists($poolRecord, 'getId') ? $poolRecord->getId() : $poolRecord->id;
        return $this;
    }

    public function setPool(?string $pool): void
    {
        $this->pool = $pool;
    }

    public function setPoolId(?int $pool_id): void
    {
        $this->pool_id = $pool_id;
    }
}
