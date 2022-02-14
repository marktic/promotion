<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionRules\Conditions;

use Marktic\Promotion\Base\Configurations\ModelConfiguration;
use Marktic\Promotion\Base\Validations\ValidationResult;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;

interface RuleConditionInterface
{
    /**
     * @param PromotionSubjectInterface $subject
     * @param array| ModelConfiguration $configuration
     * @return ValidationResult
     */
    public function validate(PromotionSubjectInterface $subject, $configuration): ValidationResult;

    public function describeConfiguration(ModelConfiguration $configuration): string;
}
