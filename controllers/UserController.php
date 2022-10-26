<?php

    namespace app\controllers;

    //use yii\db\Connection;
    use yii\db\Expression;
    use yii\web\Controller;

    /**
        * Class UserController
        * @package app\controllers
    */

class UserController extends Controller
{
    public function actionIndex()
    {
       /*$db = new Connection([
          'dsn' => 'mysql:host=localhost; dbname=sajine',
          'username' => 'sajine',
          'password' => '1127',
          'charset' => 'utf8',
          'tablePrefix' => ''
      ]);*/

        $db = \Yii::$app->db;
        // Use {{%table_name}} to correctly quote the table and to user table prefix also
        $users = $db->createCommand("SELECT * FROM {{%user}}")->queryAll();
        
        echo '<pre>';
            var_dump($users);
        echo '</pre>';

        return "List of users";
    }

    public function actionView($id = 1)
    {
        $db = \Yii::$app->db;
        $command = $db->createCommand("SELECT * FROM user WHERE id = :id");
        $user2 = $command->bindParam('id', $id)->queryOne();

        echo '<pre>';
            var_dump($user2);
        echo '</pre>';

        $id = 5;
        $user3 = $command->bindParam('id', $id)->queryOne();

        echo '<pre>';
            var_dump($user3);
        echo '</pre>';
    }

    public function actionCreate()
    {
        $db = \Yii::$app->db;
        $result = $db->createCommand()->insert ('user', ['name' => 'Diana', 'surname' => 'Marin'])->execute();

        /*$result = $db->createCommand()->batchInsert('user', ['name'], [
            ['name' => 'user1'],
            ['username' => 'user2'],
        ])->execute();*/

        echo '<pre>';
            var_dump($result);
        echo '</pre>';
        
        return "User created";
    }

    public function actionUpdate()
    {
        /* $db->createCommand()->update('user', ['email' => 'user1@example.com'], ['id' => 5,])->execute();
        $db->createCommand()->update('user', ['email' => new Expression('username')], ['email' => null])->execute();
        $db->createCommand()->update('user', ['email' => new Expression('CONCAT(username, \'@example.com\')')], ['email' => null])->execute();*/

        $db = \Yii::$app->db;
        $db->createCommand()->update('user', ['surname' => 'Popescu'], ['id' => 2])->execute();

        return "User updated";
    }

    public function actionDelete($id)
    {
        $db = \Yii::$app->db;
        $db->createCommand()->delete('user', 'id = :id', ['id' => $id])->execute();

        return "User deleted";
    }

    public function actionUpsert()
    {
        $db = \Yii::$app->db;
        $db->createCommand()->upsert('user', ['name' => 'Petru', 'surname' => 'Balan'], ['surname' => 'Balan'])->execute();
        ///
        return "User upserted";
    }

   public function actionQuoting()
    {
        $db = \Yii::$app->db;
        // SELECT `name` from `user`
        // SELECT IFNULL(`surname`, `name`) FROM `user`;

        $db->createCommand("SELECT IFNULL([[surname]], [[name]]) FROM {{user}}")->execute();
    }
}