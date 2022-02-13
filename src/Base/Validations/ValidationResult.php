<?php

declare(strict_types=1);

namespace Marktic\Promotion\Base\Validations;

use Nip\I18n\TranslatableMessage;

class ValidationResult
{
    protected bool $valid;

    /**
     * @var null|string|TranslatableMessage
     */
    protected $message = null;

    /**
     * @param bool $valid
     * @param null $message
     */
    public function __construct(bool $valid, $message = null)
    {
        $this->valid = $valid;
        $this->message = $message;
    }

    public static function invalid($message): self
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
        return $this->valid == true;
    }

    public function isInvalid(): bool
    {
        return $this->valid == false;
    }

    public function message(): ?string
    {
        return (string)$this->message;
    }
}
