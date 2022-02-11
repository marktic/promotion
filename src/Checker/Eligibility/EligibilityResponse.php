<?php

declare(strict_types=1);

namespace Marktic\Promotion\Checker\Eligibility;

class EligibilityResponse
{
    protected bool $isEligible;

    protected $message = null;

    /**
     * @param bool $isEligible
     * @param null $message
     */
    public function __construct(bool $isEligible, $message = null)
    {
        $this->isEligible = $isEligible;
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
        return $this->isEligible == true;
    }

    public function isInvalid(): bool
    {
        return $this->isEligible == false;
    }

    public function isEligible(): bool
    {
        return $this->isEligible;
    }

    public function message(): ?string
    {
        return (string)$this->message;
    }
}
