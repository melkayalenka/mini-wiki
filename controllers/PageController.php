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
yii\helpers\VarDumper;

class PageController extends Controller
{
    /**
     * @param $name
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($name)
    {
        $model = $this->findModel($name);
        if($model == null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
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

        if (!$model->save()) {
            $msg = 'Cannot add Page. Given data = ' . VarDumper::export($formData['AddPageForm']);
            $msg = $msg . ' System error: ' . VarDumper::export($model->getErrors());
            \Yii::error($msg, __METHOD__);
            throw new HttpException();
        }
        if ($model->save()) {
            return $this->redirect(['view', 'name' => $model->name]);
        }
        $formModel = new AddPageForm();
        return $this->render('create', [
            'model' => $formModel,
        ]);
    }
    /**
     * @param $name
     * @throws NotFoundHttpException
     * @return \yii\web\Response|string
     */
    public function actionEdit($name)
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
                if (!$model->save()) {
                    $msg = 'Cannot update Page. Given data = ' . VarDumper::export($formData['Page']);
                    $msg = $msg . ' System error: ' . VarDumper::export($model->getErrors());
                    \Yii::error($msg, __METHOD__);
                    throw new HttpException();
                }
                return $this->redirect(['view', 'name' => $model->name]);
            }
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    /**
     * @param $name
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
                $msg = 'Cannot delete Page. Given data = ' . VarDumper::export($model);
                $msg = $msg . ' System error: ' . VarDumper::export($model->getErrors());
                \Yii::error($msg, __METHOD__);
            }
            return $this->redirect('/');
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
