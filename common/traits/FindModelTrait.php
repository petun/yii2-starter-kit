<?php


namespace common\traits;


use common\models\BaseAppActiveRecord;
use yii\web\NotFoundHttpException;

/**
 * Uses in controllers for find
 *
 * Trait FindModelTrait
 * @package common\traits
 */
trait FindModelTrait
{

    /**
     * @param $class
     * @param $id
     * @return BaseAppActiveRecord
     * @throws NotFoundHttpException
     */
    public function findModel($class, $id)
    {
        $model = $class::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException();
        }

        return $model;
    }

}