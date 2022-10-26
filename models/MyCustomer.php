<?php

    namespace app\models;

    use yii\db\ActiveRecord;

    class MyCustomer extends ActiveRecord
    {
        public static function tableName()
        {
            return '{{%customer}}';
        }
        public function rules()
        {
            return [[['username', 'email'], 'required']];
        }
    }
