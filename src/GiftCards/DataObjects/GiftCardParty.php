<?php

declare(strict_types=1);

namespace Marktic\Promotion\GiftCards\DataObjects;

use ByTIC\DataObjects\Behaviors\Serializable\SerializableTrait;
use JsonSerializable;
use Serializable;

class GiftCardParty implements JsonSerializable, Serializable
{
    use SerializableTrait;


    protected ?string $first_name = null;
    protected ?string $last_name = null;
    protected ?string $email = null;
    protected ?string $phone = null;

    public static function from(GiftCardParty|array|null $recipient)
    {
        if ($recipient instanceof GiftCardParty) {
            return $recipient;
        }
        if (is_array($recipient)) {
            return self::fromArray($recipient);
        }
        return null;
    }

    private static function fromArray(GiftCardParty|array $recipient)
    {
        $party = new self();
        $party->populateFromArray($recipient);
        return $party;
    }

    public function populateFromArray(array $data)
    {
        $this->setFirstName($data['first_name'] ?? null);
        $this->setLastName($data['last_name'] ?? null);
        $this->setEmail($data['email'] ?? null);
        $this->setPhone($data['phone'] ?? null);
        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(?string $first_name): void
    {
        $this->first_name = $first_name;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(?string $last_name): void
    {
        $this->last_name = $last_name;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }

    public function toArray(): array
    {
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
        ];
    }

    /**
     * Get the array that should be JSON serialized.
     * @return array
     */
    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}
