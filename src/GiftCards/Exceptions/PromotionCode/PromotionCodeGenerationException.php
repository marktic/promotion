<?php

declare(strict_types=1);

namespace Marktic\Promotion\GiftCards\Exceptions\PromotionCode;

class PromotionCodeGenerationException extends \Exception
{
    public const MESSAGE_GENERATED = 'already_generated';

    public const MESSAGE_STATUS_INVALID = 'status_invalid';
}

