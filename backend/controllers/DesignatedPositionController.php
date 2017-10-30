<?php

namespace backend\controllers;

use Yii;
use common\models\DesignatedPosition;
use common\models\SearchDesignatedPosition;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DesignatedPositionController implements the CRUD actions for DesignatedPosition model.
 */
class DesignatedPositionController extends Controller
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
     * Lists all DesignatedPosition models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchDesignatedPosition();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DesignatedPosition model.
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
     * Creates a new DesignatedPosition model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DesignatedPosition();

        if ($model->load(Yii::$app->request->post())) {

            $model->status = 1;
            $model->created_at = date('Y-m-d H:i:s');
            $model->created_by = Yii::$app->user->identity->id;
            $model->updated_at = date('Y-m-d H:i:s');
            $model->updated_by = Yii::$app->user->identity->id;

            if($model->save()) {
                Yii::$app->getSession()->setFlash('success', 'Your record was successfully added in the database.');
                return $this->redirect(['index']);

            }else{
                return $this->render('create',
                            ['model' => $model,
                        ]);

            }

        } else {
            return $this->render('create',
                        ['model' => $model,
                    ]);
        }
    }

    /**
     * Updates an existing DesignatedPosition model.
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
            return $this->render('update',
                        ['model' => $model,
                    ]);
        }
    }

    /**
     * Deletes an existing DesignatedPosition model.
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
     * Finds the DesignatedPosition model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DesignatedPosition the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DesignatedPosition::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
