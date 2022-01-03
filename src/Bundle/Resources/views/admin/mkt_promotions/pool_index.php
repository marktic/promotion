<?php

use ByTIC\AdminBase\Actions\Factories\ActionsCollectionsFactory;
use ByTIC\AdminBase\Actions\Factories\ActionsFactory;
use Marktic\Promotion\Utility\PromotionModels;
use ByTIC\Icons\Icons;

$actions = ActionsCollectionsFactory::from($actions ?? []);

$addURLParams = [
    'pool' => $this->pool,
    'pool_id' => $this->pool_id,
];
foreach ($this->actionCommands as $actionCommand) {
    $action = ActionsFactory::fromArray([
        'name' => \ByTIC\AdminBase\Actions\Dto\Action::NAME_CREATE . '-' . $actionCommand->getName(),
        'label' => $this->modelManager->getLabel('add') . '' . PromotionModels::promotionActions()->translateType(
                $actionCommand->getName()
            ),
        'icon' => Icons::plus(),
        'url' => $this->modelManager->getAddURL($addURLParams),
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