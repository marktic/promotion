<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionActions\Presentation;

use Marktic\Promotion\PromotionActions\Models\PromotionAction;
use Marktic\Promotion\Utility\PromotionModels;

class ActionHtml
{
    /**
     * @var PromotionAction
     */
    protected $action;

    /**
     * @param PromotionAction $action
     */
    protected function __construct($action)
    {
        $this->action = $action;
    }

    public static function for($action): self
    {
        return new self($action);
    }

    public function __toString()
    {
        return $this->render();
    }

    protected function render(): string
    {
        return sprintf(
            '<span class="badge bg-success">
    <strong>%s</strong>:<br />
    %s
</span>',
            $this->renderTypeLabel(),
            $this->renderConfiguration()
        );
    }

    protected function renderTypeLabel(): string
    {
        return PromotionModels::promotionActions()->translate('type.' . $this->action->getType());
    }

    protected function renderConfiguration(): string|false
    {
        return json_encode($this->action->getConfiguration()->jsonSerialize());
    }
}
