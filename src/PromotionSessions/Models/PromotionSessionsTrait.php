<?php

declare(strict_types=1);

namespace Marktic\Promotion\PromotionSessions\Models;

use Marktic\Promotion\Base\Models\Behaviours\HasPromotion\RepositoryHasPromotion;
use Marktic\Promotion\Base\Models\Behaviours\Timestampable\TimestampableManagerTrait;
use Marktic\Promotion\PromotionSubjects\Models\PromotionSubjectInterface;
use Marktic\Promotion\Utility\PackageConfig;
use Marktic\Promotion\Utility\PromotionModels;
use Nip\Records\Collections\Collection;

/**
 * @method PromotionSession getNew()
 */
trait PromotionSessionsTrait
{
    use RepositoryHasPromotion;
    use TimestampableManagerTrait;

    public function findForSubject(PromotionSubjectInterface $subject): Collection
    {
        $params = [
            'where' => $this->queryWhereSubject($subject),
        ];
        $query = $this->paramsToQuery($params);

        return $this->findByQuery($query);
    }

    public function queryWhereSubject(PromotionSubjectInterface $subject): array
    {
        return [
            'subject_id = ?' => $subject->getId(),
            'subject_type = ?' => $subject->getManager()->getMorphName(),
        ];
    }

    /**
     * @return void
     */
    protected function initRelations()
    {
        parent::initRelations();
        $this->initRelationsTrait();
    }

    protected function initRelationsTrait(): void
    {
        $this->initRelationsPromotion();
        $this->initRelationsSubject();
    }

    protected function initRelationsSubject(): void
    {
        $this->morphTo(
            PromotionSessions::RELATION_SUBJECT,
            ['morphPrefix' => 'subject', 'morphTypeField' => 'subject']
        );
    }

    protected function generateTable(): string
    {
        return PackageConfig::tableName(PromotionModels::PROMOTION_SESSIONS, PromotionSessions::TABLE);
    }
}
