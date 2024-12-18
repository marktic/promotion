<?php

declare(strict_types=1);

namespace Marktic\Promotion\Bundle\Forms\AbstractBase\GiftCards;


use Marktic\Promotion\GiftCards\DataObjects\GiftCardParty;
use Marktic\Promotion\GiftCards\Models\GiftCard;
use Marktic\Promotion\Utility\PromotionModels;

/**
 * @method GiftCard getModel()
 */
trait BuyFormTrait
{
    protected const PARTY_FIELDS = ['first_name', 'last_name', 'email'];

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
        foreach (self::PARTY_FIELDS as $field) {
            $name = $this->generatePartyFieldName($type, $field);
            $this->addInput(
                $name,
                $this->getModelManager()->getLabel('form.' . $name),
                true
            );
        }
    }

    protected function getDataFromModel()
    {
        parent::getDataFromModel();
        $configuration = $this->getModel()->getConfiguration();
        foreach (GiftCardParty::TYPES as $type) {
            $party = $configuration->getParty($type);
            $this->getDataFromModelPartyFields($party, $type);
        }
    }

    protected function getDataFromModelPartyFields(GiftCardParty $party, $type): void
    {
        $data = $party->toArray();
        foreach (self::PARTY_FIELDS as $field) {
            $name = $this->generatePartyFieldName($type, $field);
            $element = $this->getElement($name);
            $element->getDataFromModel($data[$field] ?? null);
        }
    }

    public function saveToModel(): void
    {
        parent::saveToModel();

        $this->saveToModelConfiguration();
    }


    public function getModelManager()
    {
        return PromotionModels::giftCards();
    }

    protected function generatePartyFieldName($type, $field): string
    {
        return 'party_' . $type . '_' . $field;
    }

    /**
     * @return void
     */
    protected function saveToModelConfiguration(): void
    {
        $configuration = $this->getModel()->getConfiguration();
        foreach (GiftCardParty::TYPES as $type) {
            $partyData = [];
            foreach (self::PARTY_FIELDS as $field) {
                $name = $this->generatePartyFieldName($type, $field);
                $partyData[$field] = $this->getElement($name)->getValue('model');
            }
            $party = $configuration->getParty($type);
            $party->populateFromArray($partyData);
        }

        $this->getModel()->setConfiguration($configuration);
    }
}
