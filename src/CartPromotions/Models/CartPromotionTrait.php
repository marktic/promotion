<?php

declare(strict_types=1);

namespace Marktic\Promotion\CartPromotions\Models;

use Marktic\Promotion\Base\Models\Behaviours\HasActions\RecordHasPromotionActions;
use Marktic\Promotion\Base\Models\Behaviours\HasCode\RecordHasCode;
use Marktic\Promotion\Base\Models\Behaviours\HasId\RecordHasId;
use Marktic\Promotion\Base\Models\Behaviours\HasPool\RecordHasPool;
use Marktic\Promotion\Base\Models\Behaviours\HasRules\RecordHasPromotionRules;
use Marktic\Promotion\Base\Models\Behaviours\HasUsage\RecordHasUsage;
use Marktic\Promotion\Base\Models\Behaviours\HasValidity\RecordHasValidity;
use Marktic\Promotion\Base\Models\Behaviours\Timestampable\TimestampableTrait;
use Marktic\Promotion\Base\Models\PromotionPools\PromotionPoolWithCurrencies;
use Marktic\Promotion\PromotionActions\Models\PromotionAction;
use Marktic\Promotion\PromotionCodes\Models\PromotionCode;
use Marktic\Promotion\PromotionSessions\Models\PromotionSession;
use Nip\Records\AbstractModels\Record;
use Nip\Records\Collections\Collection;

/**
 * Trait CartPromotionTrait.
 *
 * @method Record|PromotionPoolWithCurrencies getPromotionPool()
 * @method PromotionCode[]|Collection         getPromotionCodes()
 * @method PromotionAction[]|Collection       getPromotionActions()
 * @method PromotionSession[]|Collection      getPromotionSessions()
 */
trait CartPromotionTrait
{
    use Behaviours\HasType\HasTypeRecord;

    use RecordHasCode;
    use RecordHasId;
    use RecordHasPool;
    use RecordHasPromotionActions;
    use RecordHasPromotionRules;
    use RecordHasUsage;
    use RecordHasValidity;
    use TimestampableTrait;

    protected ?string $name = null;

    protected string $description;

    protected ?int $priority = null;

    protected bool $exclusive = false;

    public function __construct(array $data = null)
    {
        parent::__construct($data);
        $this->registerValidityCast();
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getPriority(): ?int
    {
        return $this->priority;
    }

    public function setPriority(?int $priority): void
    {
        $this->priority = $priority;
    }

    public function isExclusive(): bool
    {
        return true === $this->exclusive;
    }

    public function setExclusive(?bool $exclusive): void
    {
        $this->exclusive = (true === $exclusive);
    }
}
