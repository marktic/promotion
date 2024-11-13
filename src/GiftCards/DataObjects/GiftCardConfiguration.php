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
        $array['sender'] = GiftCardParty::from($array['sender'] ?? null);
        $array['recipient'] = GiftCardParty::from($array['recipient'] ?? null);
        parent::__construct($array, $flags, $iteratorClass);
    }


    public function offsetSet(mixed $key, mixed $value): void
    {
        if (in_array($key, ['sender', 'recipient'])) {
            $value = GiftCardParty::from($value);
        }
        parent::offsetSet($key, $value);
    }


    public function getSender(): ?GiftCardParty
    {
        return $this->get('sender');
    }

    public function getRecipient(): ?GiftCardParty
    {
        return $this->get('recipient');
    }

    public function setSender(null|GiftCardParty|array $sender): self
    {
        return $this->set('sender', GiftCardParty::from($sender));
    }

    public function setRecipient(null|GiftCardParty|array $recipient): self
    {
        return $this->set('recipient', GiftCardParty::from($recipient));
    }
}
