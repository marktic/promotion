<?php

declare(strict_types=1);

namespace Marktic\Promotion\Bundle\Forms\Frontend\GiftCards;


use Marktic\Promotion\GiftCards\DataObjects\GiftCardParty;
use Marktic\Promotion\Utility\PromotionModels;

class BuyForm extends AbstractForm
{
    public const ID = 'mkt-promotion-giftProducts-buyForm';

    public function initialize()
    {
        parent::initialize();
        $this->setAttrib('id', self::ID);

        foreach (GiftCardParty::TYPES as $type) {
            $this->initializePartyFields($type);
        }
        $this->addButton('save', translator()->trans('submit'));
    }

    protected function initializePartyFields($type)
    {
        $name = 'party_' . $type . '_first_name';
        $this->addText(
            $name,
            $this->getModelManager()->getLabel('form.' . $name),
        );
        $name = 'party_' . $type . '_last_name';
        $this->addText(
            $name,
            $this->getModelManager()->getLabel('form.' . $name),
        );
        $name = 'party_' . $type . '_email';
        $this->addText(
            $name,
            $this->getModelManager()->getLabel('form.' . $name),
        );
    }

    public function getModelManager()
    {
        return PromotionModels::giftCards();
    }
}
