<?php

namespace backend\controllers;

use Yii;
use common\models\Parts;
use common\models\SearchParts;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PartsController implements the CRUD actions for Parts model.
 */
class PartsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Parts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchParts();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Parts model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Parts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Parts();

        if ($model->load(Yii::$app->request->post())) {

            $model->quantity = 1;
            $model->status = 1;
            $model->created_at = date('Y-m-d H:i:s');
            $model->created_by = Yii::$app->user->identity->id;
            $model->updated_at = date('Y-m-d H:i:s');
            $model->updated_by = Yii::$app->user->identity->id;

            if($model->save()) {
                Yii::$app->getSession()->setFlash('success', 'Your record was successfully added in the database.');
                return $this->redirect(['index']);

            }else{

                $partsLastId = $model->getLastId();
                $yrNow = date('Y');
                $partsCode = 'PARTS' . $yrNow . sprintf('%004d', $partsLastId);

                return $this->render('create', [
                            'model' => $model,
                            'partsCode' => $partsCode,
                        ]);

            }

        } else {

            $partsLastId = $model->getLastId();
            $yrNow = date('Y');
            $partsCode = 'PARTS' . $yrNow . sprintf('%004d', $partsLastId);

            return $this->render('create', [
                        'model' => $model,
                        'partsCode' => $partsCode,
                    ]);
        }
    }

    /**
     * Updates an existing Parts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $model->updated_at = date('Y-m-d H:i:s');
            $model->updated_by = Yii::$app->user->identity->id;

            if($model->save()) {
                Yii::$app->getSession()->setFlash('success', 'Your record was successfully updated in the database.');
                return $this->redirect(['index']);
            }

        } else {

            $partsCode = $model->parts_code;

            return $this->render('update', [
                            'model' => $model,
                            'partsCode' => $partsCode,
                    ]);
        }
    }

    /**
     * Deletes an existing Parts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDeleteColumn($id)
    {
        $model = $this->findModel($id);
        $model->status = 0;
        $model->save();

        Yii::$app->getSession()->setFlash('success', 'Your record was successfully deleted in the database.');
        return $this->redirect(['index']);
    }

    /**
     * Finds the Parts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Parts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Parts::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
