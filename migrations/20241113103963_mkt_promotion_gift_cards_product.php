<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class MktPromotionGiftCardsProduct extends AbstractMigration
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
        $table = $this->table($table_name);
        $table
            ->addColumn('product_id', 'integer', ['after' => 'id'])
            ->save();

        $table
            ->addIndex(['product_id'])
            ->save();

        $table
            ->addForeignKey(
                'product_id',
                'mkt_gift_products',
                'id',
                ['constraint' => 'mkt_gift_cards_mkt_gift_products_id', 'delete' => 'NO_ACTION', 'update' => 'NO_ACTION']
            )
            ->save();
    }
}
