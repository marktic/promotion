<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CartPromotionsTable extends AbstractMigration
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
        $table_name = 'mkt_promotions';
        $exists = $this->hasTable($table_name);
        if ($exists) {
            return;
        }
        $table = $this->table($table_name);
        $table
            ->addColumn('pool_id', 'integer', ['null' => true])
            ->addColumn('pool', 'string', ['null' => true])
            ->addColumn('code', 'string', ['limit' => 255, 'null' => false])
            ->addColumn('name', 'string', ['limit' => 255, 'null' => false])
            ->addColumn('priority', 'integer', [])
            ->addColumn('exclusive', 'integer', ['limit' => 1, 'null' => false, 'default' => 1])
            ->addColumn('usage_limit', 'integer', ['null' => true])
            ->addColumn('used', 'integer', [])
            ->addColumn('valid_from', 'datetime', ['null' => true])
            ->addColumn('valid_to', 'datetime', ['null' => true])
            ->addColumn('updated_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'update' => 'CURRENT_TIMESTAMP',
            ])
            ->addColumn('created_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
            ]);

        $table
            ->addIndex(['pool_id'])
            ->addIndex(['pool'])
            ->addIndex(['priority'])
            ->addIndex(['code'], ['unique' => true]);

        $table->save();
    }
}
