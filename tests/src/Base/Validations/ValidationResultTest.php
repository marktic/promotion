<?php

declare(strict_types=1);

namespace Marktic\Promotion\Tests\Base\Validations;

use Marktic\Promotion\Base\Validations\ValidationResult;
use Marktic\Promotion\Tests\AbstractTest;
use Nip\I18n\TranslatableMessage;

class ValidationResultTest extends AbstractTest
{
    public function testCanReceiveTranslatableMessages(): void
    {
        $response = ValidationResult::invalid(TranslatableMessage::create('test'));

        self::assertSame('test', $response->message());
    }
}
