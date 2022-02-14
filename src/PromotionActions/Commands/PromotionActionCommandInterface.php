<?php

namespace Marktic\Promotion\PromotionActions\Commands;

use Marktic\Promotion\Base\Configurations\ModelConfiguration;
use Marktic\Promotion\Promotions\Models\PromotionInterface;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;

interface PromotionActionCommandInterface
{
    public function execute(
        PromotionSubjectInterface $subject,
        array $configuration,
        PromotionInterface $promotion
    ): bool;

    public function revert(
        PromotionSubjectInterface $subject,
        array $configuration,
        PromotionInterface $promotion
    ): void;

    public function describeConfiguration(ModelConfiguration $configuration): string;

}