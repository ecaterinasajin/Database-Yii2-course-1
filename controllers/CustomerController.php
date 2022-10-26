<?php

    namespace app\controllers;

use app\models\Customer;
use app\models\MyCustomer;
use yii\base\Controller;

    class CustomerController extends Controller
    {
        public function actionIndex()
        {
          $customer = MyCustomer::find()->all();

          echo '<pre>';
            var_dump($customer);
          echo '</pre>';
        }

        public function actionView($id = 2)
        {
           //$customer = MyCustomer::find()->where("id = :id", ['id' => $id])->one();
            $customer = MyCustomer::findOne($id);
        
            echo '<pre>';
                var_dump($customer->username);
            echo '</pre>';
        }

    public function actionSave()
    {
        $customer = new MyCustomer();
        $customer->username = 'Loredana';
        $customer->email = 'loredana@gmail.com';
        //$customer->save();

        if ($customer->save()){
            echo '<pre>';
                var_dump("SUCCESS");
            echo '</pre>';
        } else {
            echo '<pre>';
                var_dump("FAIL ", $customer->errors);
            echo '</pre>';
        }
    }

   public function actionUpdate($id = 1)
    {
        $customer = MyCustomer::findOne($id);
        $customer->email = 'something@example.com';

        if ($customer->save()){
            echo '<pre>';
                var_dump("SUCCESS");
            echo '</pre>';
        } else {
            echo '<pre>';
                var_dump("FAIL ", $customer->errors);
            echo '</pre>';
        }
    }

    public function actionDelete($id = 1)
    {
        $customer = MyCustomer::findOne($id);
        if ($customer->delete()){
            echo '<pre>';
                var_dump("SUCCESS");
            echo '</pre>';
        } else{
            echo '<pre>';
                var_dump("FAIL ", $customer->errors);
            echo '</pre>';
        }
    }
  }