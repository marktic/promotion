<?php

declare(strict_types=1);

namespace Marktic\Promotion\GiftCards\CardStatuses;

/**
 *
 */
class Issued extends AbstractStatus
{
    public const NAME = 'issued';

    public function canGeneratePromotion(): bool
    {
        return true;
    }

    /** @noinspection PhpMissingParentCallCommonInspection
     * @inheritDoc
     */
    public function getColorClass()
    {
        return 'primary';
    }

}