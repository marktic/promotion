<?php

use ByTIC\AdminBase\Screen\Actions\Dto\Action;
use ByTIC\AdminBase\Screen\Actions\Factories\ActionsCollectionsFactory;
use ByTIC\AdminBase\Screen\Actions\Factories\ActionsFactory;
use ByTIC\Icons\Icons;
use Marktic\Promotion\Bundle\Models\CartPromotions\CartPromotions;
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

$actionCommands = $this->get('actionCommands');
foreach ($actionCommands as $actionCommand) {
    $action = ActionsFactory::fromArray([
        'name' => Action::NAME_CREATE . '-' . $actionCommand->getName(),
        'label' => $modelManager->getLabel('add')
            . ' '
            . PromotionModels::promotionActions()->translateType($actionCommand->getName()),
        'icon' => Icons::plus(),
        'url' => $modelManager->compileURL(
            'add',
            array_merge($addURLParams, ['type' => $actionCommand->getName()])
        ),
    ]);
    $actions->add($action);
}

echo $this->load(
    '/abstract/index',
    [
        'add' => false,
        'actions' => $actions,
    ]
);