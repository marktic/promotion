<?php

declare(strict_types=1);

namespace Marktic\Promotion\GiftCards\DataObjects;

use ByTIC\DataObjects\Casts\Metadata\Metadata;

/**
 * Class ModelConfiguration.
 */
class GiftCardConfiguration extends Metadata
{
    public function __construct(object|array $array = [], int $flags = 0, string $iteratorClass = "ArrayIterator")
    {
        foreach (GiftCardParty::TYPES as $type) {
            $array[$type] = GiftCardParty::from($array[$type] ?? []);
        }
        parent::__construct($array, $flags, $iteratorClass);
    }

    public function offsetSet(mixed $key, mixed $value): void
    {
        if (in_array($key, GiftCardParty::TYPES)) {
            $value = GiftCardParty::from($value);
        }
        parent::offsetSet($key, $value);
    }

    public function getParty($type): ?GiftCardParty
    {
        return $this->get($type);
    }

    public function getSender(): ?GiftCardParty
    {
        return $this->get(GiftCardParty::TYPE_SENDER);
    }

    public function getRecipient(): ?GiftCardParty
    {
        return $this->get(GiftCardParty::TYPE_RECIPIENT);
    }

    public function setSender(null|GiftCardParty|array $sender): self
    {
        return $this->set(GiftCardParty::TYPE_SENDER, GiftCardParty::from($sender));
    }

    public function setRecipient(null|GiftCardParty|array $recipient): self
    {
        return $this->set(GiftCardParty::TYPE_RECIPIENT, GiftCardParty::from($recipient));
    }
}
