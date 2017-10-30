<?php

namespace backend\controllers;

use Yii;
use common\models\Tasks;
use common\models\SearchTasks;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TasksController implements the CRUD actions for Tasks model.
 */
class TasksController extends Controller
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
     * Lists all Tasks models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchTasks();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tasks model.
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
     * Creates a new Tasks model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tasks();

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

                $tasksLastId = $model->getLastId();
                $yrNow = date('Y');
                $tasksCode = 'TASK' . $yrNow . sprintf('%004d', $tasksLastId); 

                return $this->render('create', [
                            'model' => $model,
                            'tasksCode' => $tasksCode,
                        ]);    
            
            }

        } else {

            $tasksLastId = $model->getLastId();
                $yrNow = date('Y');
                $tasksCode = 'TASK' . $yrNow . sprintf('%004d', $tasksLastId); 

            return $this->render('create', [
                        'model' => $model,
                        'tasksCode' => $tasksCode,
                    ]);
        }
    }

    /**
     * Updates an existing Tasks model.
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

            $tasksCode = $model->tasks_code;

            return $this->render('update', [
                            'model' => $model,
                            'tasksCode' => $tasksCode,
                    ]);
        }
    }

    /**
     * Deletes an existing Tasks model.
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
     * Finds the Tasks model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tasks the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tasks::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
