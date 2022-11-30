<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionCodes\Actions;

use Marktic\Promotion\PromotionCodes\Exceptions\InvalidPromotionalCode;
use Marktic\Promotion\PromotionCodes\Models\PromotionCode;
use Marktic\Promotion\PromotionCodes\Models\PromotionCodeInterface;
use Marktic\Promotion\PromotionCodes\Models\PromotionCodes;
use Marktic\Promotion\PromotionCodes\Models\PromotionCodesRepositoryInterface;
use Marktic\Promotion\PromotionCodes\Validations\CompositePromotionCodeValidationValidation;
use Marktic\Promotion\PromotionCodes\Validations\PromotionCodeValidationDurationLimitValidation;
use Marktic\Promotion\PromotionCodes\Validations\PromotionCodeValidationUsageLimitValidation;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;
use Marktic\Promotion\Utility\PromotionModels;
use Nip\I18n\TranslatableMessage;

use Nip\Records\AbstractModels\Record;

use function is_object;

class FindAndValidatePromotionCode
{
    /**
     * @var PromotionCodes|PromotionCodesRepositoryInterface
     */
    protected PromotionCodesRepositoryInterface $promotionCodeRepository;

    public function __construct(?PromotionCodesRepositoryInterface $promotionCodeRepository = null)
    {
        $this->promotionCodeRepository = $promotionCodeRepository ?? PromotionModels::promotionCodes();
    }

    /**
     * @throws InvalidPromotionalCode
     */
    public static function for(PromotionSubjectInterface $subject, string $promotionCode): ?PromotionCodeInterface
    {
        return (new self())->execute($subject, $promotionCode);
    }

    /**
     * @throws InvalidPromotionalCode
     */
    public function execute(PromotionSubjectInterface $subject, string $promotionCode): ?PromotionCodeInterface
    {
        $promotionCode = $this->findPromotionCode($promotionCode);
        $this->validatePromotionCode($subject, $promotionCode);

        return $promotionCode;
    }

    /**
     * @throws InvalidPromotionalCode
     */
    protected function findPromotionCode(string $promotionCode): PromotionCode|Record
    {
        $promotionCode = $this->promotionCodeRepository->findOneByCode($promotionCode);

        if (!is_object($promotionCode)) {
            throw new InvalidPromotionalCode(
                (string)TranslatableMessage::create('mkt_promotion_codes.messages.form.register.dnx')
            );
        }

        return $promotionCode;
    }

    /**
     * @throws InvalidPromotionalCode
     */
    protected function validatePromotionCode(
        PromotionSubjectInterface $subject,
        PromotionCodeInterface $promotionCode
    ): void {
        $checker = $this->buildEligibilityChecker();
        $response = $checker->validate($subject, $promotionCode);

        if ($response->isInvalid()) {
            throw new InvalidPromotionalCode($response->message());
        }
    }

    protected function buildEligibilityChecker(): CompositePromotionCodeValidationValidation
    {
        return new CompositePromotionCodeValidationValidation([
            new PromotionCodeValidationDurationLimitValidation(),
            new PromotionCodeValidationUsageLimitValidation(),
        ]);
    }
}
