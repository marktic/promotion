<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CartCodesTable extends AbstractMigration
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
        $table_name = 'mkt_promotions_codes';
        $exists = $this->hasTable($table_name);
        if ($exists) {
            return;
        }
        $table = $this->table($table_name);
        $table
            ->addColumn('promotion_id', 'integer')
            ->addColumn('code', 'string', ['limit' => 255, 'null' => false])
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
            ])
            ->save();

        $table
            ->addIndex(['promotion_id'])
            ->addIndex(['code'], ['unique' => true])
            ->save();

        $table
            ->addForeignKey(
                'promotion_id',
                'mkt_promotions',
                'id',
                ['constraint' => 'mkt_promotions_codes_promotion_id', 'delete' => 'NO_ACTION', 'update' => 'NO_ACTION']
            )
            ->save();
    }
}
