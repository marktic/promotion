<?php

namespace Marktic\Promotion\Tests\Fixtures\Application\Models\Checker\Eligibility;

use Marktic\Promotion\Checker\Eligibility\EligibilityResponse;
use Marktic\Promotion\Tests\AbstractTest;
use Nip\I18n\TranslatableMessage;

class EligibilityResponseTest extends AbstractTest
{
    /** @test */
    public function can_receive_translatable_messages()
    {
        $response = EligibilityResponse::invalid(TranslatableMessage::create('test'));

        self::assertSame('test', $response->message());
    }
}
