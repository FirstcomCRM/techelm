<?php

namespace backend\controllers;

use Yii;
use common\models\ProjectPii;
use common\models\SearchProjectPii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use common\models\ProjectTasklist;

/**
 * ProjectPiiController implements the CRUD actions for ProjectPii model.
 */
class ProjectPiiController extends Controller
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
     * Lists all ProjectPii models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchProjectPii();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProjectPii model.
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
     * Creates a new ProjectPii model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProjectPii();

        if ($model->load(Yii::$app->request->post())) {
            
            $model->date_sitewalk = date('Y-m-d', strtotime(Yii::$app->request->post('ProjectPii')['date_sitewalk']));
            $model->project_condition = 'In Progress';
            $model->status = 1;
            $model->created_at = date('Y-m-d H:i:s');
            $model->created_by = Yii::$app->user->identity->id;
            $model->updated_at = date('Y-m-d H:i:s');
            $model->updated_by = Yii::$app->user->identity->id;

            if($model->save()) {

                $taskList = Yii::$app->request->post('ProjectTasklist')['task_id'];

                foreach($taskList as $tRow){
                    $pTList = new ProjectTasklist();

                    $pTList->project_id = $model->id;
                    $pTList->task_id = $tRow;
                    $pTList->project_condition = 'In Progress';
                    $pTList->status = 1;
                    $pTList->created_at = date('Y-m-d H:i:s');
                    $pTList->created_by = Yii::$app->user->identity->id;
                    $pTList->updated_at = date('Y-m-d H:i:s');
                    $pTList->updated_by = Yii::$app->user->identity->id;

                    $pTList->save();
                }

                Yii::$app->getSession()->setFlash('success', 'Your record was successfully added in the database.');
                return $this->redirect(['index']);
            
            }else{
                $projectLastId = $model->getLastId();
                $projectreferenceCode = 'PROJ' . sprintf('%005d', $projectLastId);
                $cpCode = 'CP' . ' ' . sprintf('%005d', $projectLastId);

                return $this->render('create', [
                            'model' => $model,
                            'projectreferenceCode' => $projectreferenceCode,
                        'cpCode' => $cpCode,
                        ]);    
            
            }

        } else {

            $projectLastId = $model->getLastId();
            $projectreferenceCode = 'PROJ' . sprintf('%005d', $projectLastId);
            $cpCode = 'CP' . ' ' . sprintf('%005d', $projectLastId);

            return $this->render('create', [
                        'model' => $model,
                        'projectreferenceCode' => $projectreferenceCode,
                        'cpCode' => $cpCode,
                    ]);
        }
    }

    /**
     * Updates an existing ProjectPii model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ProjectPii model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProjectPii model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProjectPii the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProjectPii::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
