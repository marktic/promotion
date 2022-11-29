<?php

use ByTIC\AdminBase\Screen\Actions\Dto\Action;
use ByTIC\AdminBase\Screen\Actions\Dto\DropdownAction;
use ByTIC\AdminBase\Screen\Actions\Factories\ActionsCollectionsFactory;
use ByTIC\AdminBase\Screen\Actions\Factories\ActionsFactory;
use ByTIC\Icons\Icons;
use Marktic\Promotion\Bundle\Models\CartPromotions\CartPromotions;
use Marktic\Promotion\CartPromotions\Models\Types\Automatic;
use Marktic\Promotion\CartPromotions\Models\Types\CouponCode;
use Marktic\Promotion\Utility\PromotionModels;
use Nip\View\View;

/** @var View $this */
$actions = ActionsCollectionsFactory::from($actions ?? []);

/** @var CartPromotions $modelManager */
$modelManager = $this->get('modelManager');

$addURLParams = [
    'pool' => $this->get('pool'),
    'pool_id' => $this->get('pool_id'),
];
foreach ([CouponCode::NAME, Automatic::NAME] as $promotionTypeName) {
    $promotionType = PromotionModels::promotions()->getType($promotionTypeName);
    $actionCommands = $this->get('actionCommands');
    $action = null;
    foreach ($actionCommands as $actionCommand) {
        $actionArray = [
            'name' => Action::NAME_CREATE . '-' . $promotionTypeName . '-' . $actionCommand->getName(),
            'label' => $modelManager->getLabel('add'),
            'icon' => Icons::plus(),
            'class' => 'add-promotion-' . $actionCommand->getName(),
            'url' => $modelManager->compileURL(
                'add',
                array_merge($addURLParams, [
                    'type' => $promotionTypeName,
                    'action_type' => $actionCommand->getName()
                ])
            ),
        ];
        $action = $action ?? ActionsFactory::fromArray(
            array_merge($actionArray, [
                'label' => $promotionType->translate('add'),
                'type' => DropdownAction::TYPE,
            ])
        );
        $action->isButton(true);
        $action->addMenuItem(
            ActionsFactory::fromArray(
                array_merge($actionArray, [
                    'label' => $actionArray['label'] . ' ' . PromotionModels::promotionActions()->translateType(
                            $actionCommand->getName()
                        ),
                ])
            )
        );
    }
    if ($action) {
        $actions->add($action);
    }
}

echo $this->load(
    '/abstract/index',
    [
        'add' => false,
        'actions' => $actions,
    ]
);