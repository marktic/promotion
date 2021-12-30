<?php

namespace Marktic\Promotion\Tests\PromotionActions\Presentation;

use Marktic\Promotion\Bundle\Models\PromotionActions\PromotionActions;
use Marktic\Promotion\PromotionActions\Commands\FixedDiscountActionCommand;
use Marktic\Promotion\PromotionActions\Models\PromotionAction;
use Marktic\Promotion\PromotionActions\Presentation\ActionHtml;
use Marktic\Promotion\Tests\AbstractTest;
use Nip\Records\Locator\ModelLocator;

class ActionHtmlTest extends AbstractTest
{
    public function test_render()
    {
        $repository = new PromotionActions();
        ModelLocator::set(PromotionActions::class, $repository);
        $this->loadFakeTranslator();

        $action = new PromotionAction();
        $action->type = FixedDiscountActionCommand::NAME;
        $action->getConfiguration()->set('amount', '10');

        $presentation = ActionHtml::for($action);

        self::assertSame(
            file_get_contents(TEST_FIXTURE_PATH . '/html/PromotionActions/base.html'),
            (string)$presentation
        );
    }
}