<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionRules\Validations;

use Marktic\Promotion\Base\Validations\ValidatesPromotion;
use Marktic\Promotion\Base\Validations\ValidationResult;
use Marktic\Promotion\PromotionRules\Models\PromotionRule;
use Marktic\Promotion\PromotionRules\Models\PromotionRuleInterface;
use Marktic\Promotion\PromotionRules\Services\RuleConditionsServiceInterface;
use Marktic\Promotion\Promotions\Models\PromotionInterface;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;
use Marktic\Promotion\Utility\PromotionServices;
use Nip\Records\Collections\Collection;

class ValidatePromotionRules implements ValidatesPromotion
{
    protected ?RuleConditionsServiceInterface $ruleConditionsService = null;

    public function __construct(?RuleConditionsServiceInterface $rulesRegistry = null)
    {
        $this->ruleConditionsService = $rulesRegistry ?? PromotionServices::ruleConditions();
    }

    public function validate(
        PromotionSubjectInterface $promotionSubject,
        PromotionInterface $promotion
    ): ValidationResult {
        if ($promotion->hasPromotionRules()) {
            return $this->validatePromotionRules($promotion->getPromotionRules(), $promotionSubject);
        }

        return ValidationResult::valid();
    }

    /**
     * @param PromotionRule[]|Collection $rules
     */
    protected function validatePromotionRules($rules, PromotionSubjectInterface $promotionSubject): ValidationResult
    {
        foreach ($rules as $rule) {
            $check = $this->validatePromotionRule($promotionSubject, $rule);
            if ($check->isInvalid()) {
                return $check;
            }
        }

        return ValidationResult::valid();
    }

    private function validatePromotionRule(
        PromotionSubjectInterface $subject,
        PromotionRuleInterface $rule
    ): ValidationResult {
        $ruleCondition = $this->ruleConditionsService->get($rule->getType());

        return $ruleCondition->validate($subject, $rule->getConfiguration());
    }
}
