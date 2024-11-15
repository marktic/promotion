<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class MktPromotionGiftCardsTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $table_name = 'mkt_gift_cards';
        $exists = $this->hasTable($table_name);
        if ($exists) {
            return;
        }
        $table = $this->table($table_name);
        $table
            ->addColumn('pool_id', 'integer', ['null' => true])
            ->addColumn('pool', 'string', ['null' => true])
            ->addColumn('promotion_id', 'integer')
            ->addColumn('code_id', 'integer')
            ->addColumn('configuration', 'json', ['null' => true])
            ->addColumn('updated_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'update' => 'CURRENT_TIMESTAMP',
            ])
            ->addColumn('created_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
            ])
            ->save();

        $table
            ->addIndex(['pool_id'])
            ->addIndex(['pool'])
            ->addIndex(['promotion_id'])
            ->addIndex(['code_id'])
            ->save();

        $table
            ->addForeignKey(
                'promotion_id',
                'mkt_promotions',
                'id',
                [
                    'constraint' => 'mkt_promotions_gifts_promotion_id',
                    'delete' => 'NO_ACTION',
                    'update' => 'NO_ACTION',
                ]
            )
            ->addForeignKey(
                'code_id',
                'mkt_promotions_codes',
                'id',
                [
                    'constraint' => 'mkt_promotions_gifts_code_id',
                    'delete' => 'NO_ACTION',
                    'update' => 'NO_ACTION',
                ]
            )
            ->save();
    }
}
