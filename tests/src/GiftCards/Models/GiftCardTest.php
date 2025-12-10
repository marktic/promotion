<?php

namespace Marktic\Promotion\Tests\GiftCards\Models;

use Marktic\Promotion\GiftCards\CardStatuses\Draft;
use Marktic\Promotion\GiftCards\DataObjects\GiftCardConfiguration;
use Marktic\Promotion\GiftCards\Models\GiftCard;
use Marktic\Promotion\Tests\Base\Models\AbstractRecordTest;
use Marktic\Promotion\Tests\Base\Models\Behaviours\HasConfiguration\RecordHasConfigurationTestTrait;
use Marktic\Promotion\Tests\Base\Models\Behaviours\HasPool\RecordHasPoolTestTrait;

/**
 * @method GiftCard newRecordInstance($data = [])
 */
class GiftCardTest extends AbstractRecordTest
{
    use RecordHasPoolTestTrait;
    use RecordHasConfigurationTestTrait;

    public function test_getDefaultStatus()
    {
        $record = $this->newRecordInstance(['status' => null]);
        $status = $record->getStatus();
        self::assertSame(Draft::NAME, $status->getName());

        $record = $this->newRecordInstance(['status' => '']);
        $status = $record->getStatus();
        self::assertSame(Draft::NAME, $status->getName());
    }

    public function test_getConfigurationParties(): void
    {
        $record = $this->newRecordInstance(['configuration' => '{}']);
        $configuration = $record->getConfiguration();
        self::assertInstanceOf(GiftCardConfiguration::class, $configuration);
        self::assertTrue($configuration->getSender()->isNull());
        self::assertTrue($configuration->getRecipient()->isNull());

        $record = $this->newRecordInstance();
        $configurationArray = [
            'sender' => [
                'first_name' => 'John',
                'last_name' => 'Sende',
                'email' => 'john@yahoo.com',
                'phone' => '123456'
            ],
            'recipient' => [
                'first_name' => 'Jane',
                'last_name' => 'Reci',
                'email' => 'jane@yahoo.com',
                'phone' => '654321'
            ],
        ];
        $record->setConfiguration($configurationArray);

        $configuration = $record->getConfiguration();
        self::assertInstanceOf(GiftCardConfiguration::class, $configuration);
        self::assertSame('John', $configuration->getSender()->getFirstName());
        self::assertSame('Sende', $configuration->getSender()->getLastName());
        self::assertSame('john@yahoo.com', $configuration->getSender()->getEmail());
        self::assertSame('Jane', $configuration->getRecipient()->getFirstName());
        self::assertSame('Reci', $configuration->getRecipient()->getLastName());
        self::assertSame('jane@yahoo.com', $configuration->getRecipient()->getEmail());

        $json = json_encode($record->getConfiguration());
        self::assertSame(json_encode($configurationArray), $json);
    }

    protected function getRecordClass(): string
    {
        return GiftCard::class;
    }
}
