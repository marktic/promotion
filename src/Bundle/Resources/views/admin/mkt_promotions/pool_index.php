<?php

$actions = ActionsCollectionsFactory::from($actions ?? []);

$addURLParams = [
    'pool' => $this->pool,
    'pool_id' => $this->pool_id,
];
foreach ($this->actionCommands as $actionCommand) {
    $action = ActionsFactory::fromArray([
        'name' => $actionCommand,
        'label' => $this->modelManager->getLabel('add'),
        'icon' => Icons::plus(),
        'url' => $this->modelManager->getAddURL($addURLParams),
    ]);
    $actions->add($action);
}
echo $this->load(
    '/abstract/index',
    [
        'add' => false
        'actions' => $actions,
    ]
);