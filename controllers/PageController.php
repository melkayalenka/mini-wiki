<?php
/**
 * Created by PhpStorm.
 * User: Резеда
 * Date: 13.07.2019
 * Time: 16:29
 */

namespace app\controllers;

use app\models\AddPageForm;
use app\commons\Common;
use yii\db\Exception;
use yii\web\Controller;
use app\models\Page;
use yii\web\NotFoundHttpException;

class PageController extends Controller
{
    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($name)
    {
        $model = $this->findModel($name);
        return $this->render('page', compact('model'));
    }
    /**
     * @return string|\yii\web\Response
     */
    public function actionAdd()
    {
        $model = new Page();
        $formData = \Yii::$app->request->post();
        $formData['AddPageForm']['body'] = common::convertText($formData['AddPageForm']['body']);
        $model->attributes = $formData['AddPageForm'];

        if ($model->save()) {
            return $this->redirect(['view', 'name' => $model->name]);
        }
        $formModel = new AddPageForm();
        return $this->render('create', [
            'model' => $formModel,
        ]);
    }
    /**
     * @param $id
     * @throws NotFoundHttpException
     * @return \yii\web\Response|string
     */
    public function actionUpdate($name)
    {
        if (($model = Page::findOne($name)) !== null) {
            $formData = \Yii::$app->request->post();
            if(count($formData) == 0) {
                $form = new AddPageForm();
                return $this->render('create', [
                    'form' => $form,
                    'model' => $model
                ]);
            } else {
                $updatedData = $formData['Page'];
                $updatedData['body'] = common::convertText($updatedData['body']);
                $model->attributes = $updatedData;
                if ($model->save()) {
                    return $this->redirect(['view', 'name' => $model->name]);
                }
            }
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     * @throws Exception
     */
    public function actionDelete($id)
    {
        if (($model = Page::findOne($id)) !== null) {
            $model->deleted_at = date("Y-m-d H:i:s");
            $model->deleted_at = date("Y-m-d H:i:s");
            if(!$model->save()) {
                throw new Exception("Error while page deleting");
            }
            return $this->redirect('/');
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
