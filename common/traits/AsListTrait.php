<?php
declare(strict_types=1);


namespace common\traits;


use yii\helpers\ArrayHelper;

/**
 *
 * Uses in ActiveQuery classes. Helps get list of values (uses in views most of all)
 *
 * Trait AsListTrait
 * @package common\traits
 */
trait AsListTrait
{

    /**
     * @param string $id
     * @param string $name
     * @return array
     */
    public function asList($id = 'id', $name = 'name')
    {
        return ArrayHelper::map($this->all(), $id, $name);
    }

}