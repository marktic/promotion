<?php

namespace Marktic\Promotion\Tests\Base\Validations;

use Marktic\Promotion\Base\Validations\ValidationResult;
use Marktic\Promotion\Tests\AbstractTest;
use Nip\I18n\TranslatableMessage;

class ValidationResultTest extends AbstractTest
{
    /** @test */
    public function can_receive_translatable_messages()
    {
        $response = ValidationResult::invalid(TranslatableMessage::create('test'));

        self::assertSame('test', $response->message());
    }
}
