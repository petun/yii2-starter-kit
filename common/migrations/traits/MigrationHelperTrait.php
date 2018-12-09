<?php
declare(strict_types=1);

namespace common\migrations\traits;

use yii\db\ColumnSchemaBuilder;

/**
 * This trait must be used in migration files.
 *
 * Trait MigrationHelperTrait
 *
 * @package core\migrations\traits
 */
trait MigrationHelperTrait
{
    /**
     * Add foreign keys to $table.
     *
     * @param string $table table name
     * @param array $fields , for example
     * [['sale_point_id', 'sale_point', 'id], ['user_id', 'user', 'id]]
     * @param string $delete
     * @param string $update
     */
    public function addForeignKeys(string $table, array $fields, $delete = 'CASCADE', $update = 'CASCADE'): void
    {
        foreach ($fields as $field) {
            $this->addForeignKey(
                $this->getKeyName($table, $field[0]),
                $table,
                $field[0],
                $field[1],
                $field[2],
                $delete,
                $update
            );
        }
    }

    /**
     * Drop fk from table.
     *
     * @param string $table
     * @param array $keys
     */
    public function dropForeignKeys(string $table, array $keys): void
    {
        foreach ($keys as $key) {
            $value = \is_array($key) ? $key[0] : $key;
            $this->dropForeignKey($this->getKeyName($table, $value), $table);
        }
    }

    /**
     * Добавляет уникальный индекс для полей.
     *
     * @param string $table
     * @param string[] $fields
     */
    public function addUniqueIndex(string $table, array $fields): void
    {
        $this->createIndex(
            $this->makeUniqueIndexName($table, $fields),
            $table,
            $fields,
            true
        );
    }

    /**
     * Удаляет уникальный индекс
     *
     * @param string $table
     * @param array $fields
     */
    public function dropUniqueIndex(string $table, array $fields): void
    {
        $this->dropIndex($this->makeUniqueIndexName($table, $fields), $table);
    }

    /**
     * Creates a uuid column.
     * This parameter will be ignored if not supported by the DBMS.
     *
     * @return ColumnSchemaBuilder the column instance which can be further customized.
     */
    public function uuid(): ColumnSchemaBuilder
    {
        return $this->getDb()->getSchema()->createColumnSchemaBuilder('UUID');
    }

    /**
     * @return ColumnSchemaBuilder
     */
    public function createdAtField(): ColumnSchemaBuilder
    {
        return $this->bigInteger()->comment('Дата создания');
    }

    /**
     * @return ColumnSchemaBuilder
     */
    public function updatedAtField(): ColumnSchemaBuilder
    {
        return $this->bigInteger()->comment('Дата обновления');
    }

    /**
     * @return ColumnSchemaBuilder
     */
    public function deletedField(): ColumnSchemaBuilder
    {
        return $this->boolean()->defaultValue(false)->notNull()->comment('Запись удалена');
    }

    /**
     * @return ColumnSchemaBuilder
     */
    public function enabledField(): ColumnSchemaBuilder
    {
        return $this->boolean()->defaultValue(true)->notNull()->comment('Запись включена');
    }

    /**
     * Формирует название уникального индекса.
     *
     * @param string $tableName
     * @param array $columnNames
     *
     * @return string
     */
    private function makeUniqueIndexName(string $tableName, array $columnNames): string
    {
        \sort($columnNames);

        return \sprintf('unique_%s_%s', $tableName, \implode('_', $columnNames));
    }

    /**
     * Get name by table and field names.
     *
     * @param string $name
     * @param string $field
     *
     * @return mixed
     */
    private function getKeyName(string $name, string $field)
    {
        return \sprintf('fk_%s_%s', $name, $field);
    }
}
