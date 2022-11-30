<?php

declare(strict_types=1);

namespace Marktic\Promotion\Base\Validations;

use Nip\I18n\TranslatableMessage;

class ValidationResult
{
    protected bool $valid;

    /**
     * @var string|TranslatableMessage|null
     */
    protected $message = null;

    /**
     * @param null $message
     */
    public function __construct(bool $valid, $message = null)
    {
        $this->valid = $valid;
        $this->message = $message;
    }

    public static function invalid(string|TranslatableMessage $message): self
    {
        return new self(false, $message);
    }

    public static function valid(): self
    {
        return new self(true);
    }

    public static function create(bool $isEligible, $message = null): self
    {
        return new self($isEligible, $message);
    }

    public function isValid(): bool
    {
        return true == $this->valid;
    }

    public function isInvalid(): bool
    {
        return false == $this->valid;
    }

    public function message(): ?string
    {
        return (string) $this->message;
    }
}
