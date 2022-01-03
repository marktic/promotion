<?php

use ByTIC\AdminBase\Actions\Dto\Action;
use ByTIC\AdminBase\Actions\Factories\ActionsCollectionsFactory;
use ByTIC\AdminBase\Actions\Factories\ActionsFactory;
use ByTIC\Icons\Icons;
use Marktic\Promotion\Utility\PromotionModels;

$actions = ActionsCollectionsFactory::from($actions ?? []);

$addURLParams = [
    'pool' => $this->pool,
    'pool_id' => $this->pool_id,
];
foreach ($this->actionCommands as $actionCommand) {
    $action = ActionsFactory::fromArray([
        'name' => Action::NAME_CREATE . '-' . $actionCommand->getName(),
        'label' => $this->modelManager->getLabel('add') . ' ' . PromotionModels::promotionActions()->translateType(
                $actionCommand->getName()
            ),
        'icon' => Icons::plus(),
        'url' => $this->modelManager->getAddURL(array_merge($addURLParams, ['type' => $actionCommand->getName()])),
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