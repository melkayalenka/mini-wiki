<?php
/**
 * Created by PhpStorm.
 * User: Резеда
 * Date: 13.07.2019
 * Time: 17:44
 */

namespace app\models;


use yii\base\Model;

class AddPageForm extends Model
{
    public $name;
    public $title;
    public $body;
    public $isNewRecord = true;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['name', 'title',  'body'], 'required'],
        ];
    }

    public function isNewRecord() {
        return true;
    }
}