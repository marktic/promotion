<?php

namespace Marktic\Promotion\PromotionSessions\Models;

use ByTIC\DataObjects\Behaviors\Timestampable\TimestampableTrait;
use Marktic\Promotion\Base\Models\Behaviours\HasConfiguration\RecordHasConfiguration;
use Marktic\Promotion\Base\Models\Behaviours\HasPromotion\RecordHasPromotion;
use Marktic\Promotion\PromotionActions\Models\PromotionAction;
use Marktic\Promotion\PromotionActions\Models\PromotionActionInterface;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;
use Nip\Records\Record;

/**
 * @method PromotionSubjectInterface|Record getPromotionSubject()
 */
trait PromotionSessionTrait
{
    use RecordHasConfiguration;
    use RecordHasPromotion;
    use TimestampableTrait;

    /**
     * @var string
     */
    protected static $createTimestamps = ['created'];

    /**
     * @var string
     */
    protected static $updateTimestamps = ['modified'];

    public function getName(): ?string
    {
        return 'Promotion Session';
    }

    public function populateFromSubject(PromotionSubjectInterface $subject)
    {
        $this->setPropertyValue('subject_id', $subject->getId());
        $this->setPropertyValue('subject', $subject->getManager()->getMorphName());
    }

    /**
     * @param PromotionActionInterface[]|PromotionAction[] $actions
     * @return void
     */
    public function setAppliedActions($actions)
    {
        $actions = array_map(function ($action) {
            return [
                'id' => $action->getId(),
                'type' => $action->getType()
            ];
        }, $actions);

        $this->getConfiguration()->set('applied_actions', $actions);
    }

    public function printValue()
    {
    }

    public function printReduction()
    {
    }

}
