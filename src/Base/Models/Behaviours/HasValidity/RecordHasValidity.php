<?php

declare(strict_types=1);

namespace Marktic\Promotion\Base\Models\Behaviours\HasValidity;

use Carbon\Carbon;

trait RecordHasValidity
{
    protected ?string $valid_from = null;

    protected ?string $valid_to = null;

    /**
     * @return \DateTimeInterface|Carbon|null
     */
    public function getValidFrom(): ?\DateTimeInterface
    {
        return $this->getPropertyValue('valid_from');
    }

    /**
     * @param string|\DateTimeInterface $date
     */
    public function setValidFrom($date): void
    {
        $this->setPropertyValue('valid_from', $date);
    }

    /**
     * @return \DateTimeInterface|Carbon|null
     */
    public function getValidTo(): ?\DateTimeInterface
    {
        return $this->getPropertyValue('valid_to');
    }

    /**
     * @param string|\DateTimeInterface $date
     */
    public function setValidTo($date): void
    {
        $this->setPropertyValue('valid_to', $date);
    }

    public function registerValidityCast(): void
    {
        $this->casts = array_merge($this->casts, [
            'valid_to' => 'datetime',
            'valid_from' => 'datetime',
        ]);
    }
}
