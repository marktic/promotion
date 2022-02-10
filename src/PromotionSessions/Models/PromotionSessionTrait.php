<?php

namespace Marktic\Promotion\PromotionSessions\Models;

use Marktic\Promotion\Base\Models\Behaviours\HasConfiguration\RecordHasConfiguration;
use Marktic\Promotion\Base\Models\Behaviours\HasPromotion\RecordHasPromotion;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;
use Nip\Records\Record;

/**
 * @method PromotionSubjectInterface|Record getPromotionSubject()
 */
trait PromotionSessionTrait
{
    use RecordHasConfiguration;
    use RecordHasPromotion;

    public function getName(): ?string
    {
        return 'Promotion Session';
    }

    public function printValue()
    {
    }

    public function printReduction()
    {
    }

}
