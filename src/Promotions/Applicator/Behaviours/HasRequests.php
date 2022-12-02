<?php

declare(strict_types=1);

namespace Marktic\Promotion\Promotions\Applicator\Behaviours;

use Marktic\Promotion\Promotions\Models\PromotionInterface;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectBundleInterface;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;

trait HasRequests
{
    protected function createRequest($class, PromotionSubjectInterface $subject, PromotionInterface $promotion)
    {
        $request = $class::create();
        $request->setSubject($subject);
        $request->setPromotion($promotion);

        return $request;
    }

    protected function unpackRequest($request): array
    {
        $subject = $request->getSubject();
        if ($subject instanceof PromotionSubjectBundleInterface) {
            $subjects = $subject->getPromotionSubjects();
        } else {
            $subjects = [$subject];
        }
        $array = [];
        foreach ($subjects as $subject) {
            $newRequest = clone $request;
            $newRequest->setSubject($subject);
            $array[] = $newRequest;
        }

        return $array;
    }
}
