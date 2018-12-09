<?php


namespace tests\common\unit;


use frontend\models\ContactForm;
use tests\common\_support\FormTester;
use yii\base\Model;

class ContactFormTest extends FormTester
{

    /**
     * Provider for data as arrays with two keys: data and errCount
     * @return array
     */
    public function formProvider(): array
    {
        return [
            'err case' => [
                'data' => [],
                'errCount' => 5,
            ],
            'captcha error' => [
                'data' => [
                    'name' => 'test',
                    'email' => 'user@example.com',
                    'subject' => 'test',
                    'body' => 'test',
                ],
                'errCount' => 1,
            ]
        ];
    }

    /**
     * Creates and return new form/model with assigned data
     * @param array $data
     * @return Model
     */
    public function createModel(array $data): Model
    {
        return new ContactForm($data);
    }
}