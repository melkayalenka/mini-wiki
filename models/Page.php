<?php
/**
 * Created by PhpStorm.
 * User: Резеда
 * Date: 13.07.2019
 * Time: 16:35
 */

namespace app\models;


use yii\db\ActiveRecord;

/**
 * This is the model class for table "travel".
 *
 * @property int $id
 * @property string $title
 * @property string $name
 * @property string $body
 */

class Page extends ActiveRecord
{



    public static function getDb()
    {
        // использовать компонент приложения "db2"
        return \Yii::$app->db;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'page';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'title'], 'required'],
            ['body', 'string'],
        ];
    }
    /**
     * @param $id
     * @return Page|null|\yii\db\ActiveRecord
     * @throws NotFoundHttpException
     */
    protected function findModel($name)
    {
        if (($model = Page::findOne(['name' => $name, 'deleted_at' => null])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public static function findAllPages() {

        $pages = Page::find()->where(['deleted_at' => null])->orderBy('id')->asArray()->all();
        return $pages;
    }
}