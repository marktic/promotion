<?php

namespace Marktic\Promotion\Base\Models\Behaviours\HasValidity;

use Carbon\Carbon;
use DateTime;

trait RecordHasValidity
{
    protected ?string $valid_from;

    protected ?string $valid_to;

    /**
     * @return DateTime|Carbon|null
     */
    public function getValidFrom(): ?DateTime
    {
        return $this->getPropertyValue('valid_from');
    }

    /**
     * @param string|DateTime $date
     */
    public function setValidFrom($date): void
    {
        $this->setPropertyValue('valid_from', $date);
    }

    /**
     * @return DateTime|Carbon|null
     */
    public function getValidTo(): ?DateTime
    {
        return $this->getPropertyValue('valid_to');
    }

    /**
     * @param string|DateTime $date
     */
    public function setValidTo($date): void
    {
        $this->setPropertyValue('valid_to', $date);
    }

    public function registerValidityCast()
    {
        $this->casts = array_merge($this->casts, [
            'valid_to' => 'datetime',
            'valid_from' => 'datetime',
        ]);
    }
}