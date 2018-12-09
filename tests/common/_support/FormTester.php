<?php


namespace tests\common\_support;

use Codeception\Test\Unit;
use yii\base\Model;


/**
 * Class FormTester
 * @package tests\common\_support
 */
abstract class FormTester extends Unit
{

    /**
     * @param $data
     * @param $errCount
     *
     * @dataProvider formProvider
     */
    public function testForm($data, $errCount)
    {
        /** @var Model $form */
        $form = $this->createModel($data);
        $form->validate();
        $this->assertEquals($errCount, count($form->errors));
    }


    /**
     * Provider for data as arrays with two keys: data and errCount
     * @return array
     */
    abstract public function formProvider(): array;

    /**
     * Creates and return new form/model with assigned data
     * @param array $data
     * @return Model
     */
    abstract public function createModel(array $data): Model;

}