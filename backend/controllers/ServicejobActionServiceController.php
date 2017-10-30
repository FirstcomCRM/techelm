<?php

namespace backend\controllers;

use Yii;
use common\models\ServicejobActionServiceRepair;
use common\models\ServicejobActionServiceRepairSearch;
use common\models\UserGroup;
use common\models\UserPermission;
use common\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

/**
 * ServicejobActionServiceController implements the CRUD actions for ServicejobActionServiceRepair model.
 */
class ServicejobActionServiceController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
      $userGroupArray = ArrayHelper::map(UserGroup::find()->all(), 'id', 'name');

      foreach ( $userGroupArray as $uGId => $uGName ){
          $permission = UserPermission::find()->where(['controller' => 'ServicejobActionService'])->andWhere(['user_group_id' => $uGId ] )->all();
          $actionArray = [];
          foreach ( $permission as $p )  {
              $actionArray[] = $p->action;
          }

          $allow[$uGName] = false;
          $action[$uGName] = $actionArray;
          if ( ! empty( $action[$uGName] ) ) {
              $allow[$uGName] = true;
          }

      }
      $usergroup_id = User::find()->where(['id'=>Yii::$app->user->id])->one();
      $groupname = UserGroup::find()->where(['id'=>$usergroup_id->user_group_id])->one();
      return [
          'access' => [
              'class' => AccessControl::className(),
              // 'only' => ['index', 'create', 'update', 'view', 'delete'],
              'rules' => [
                      [
                          'actions' => $action[$groupname->name],
                          'allow' => $allow[$groupname->name],
                          'roles' => [$groupname->name],
                      ],
                    ],

          ],
          'verbs' => [
              'class' => VerbFilter::className(),
              'actions' => [
                  'logout' => ['post'],
              ],
          ],
      ];
    }

    /**
     * Lists all ServicejobActionServiceRepair models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ServicejobActionServiceRepairSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
      //  print_r($searchModel->arrange);die();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ServicejobActionServiceRepair model.
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
     * Creates a new ServicejobActionServiceRepair model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ServicejobActionServiceRepair();

        if ($model->load(Yii::$app->request->post()) && $model->validate()  ) {
            $model->date_created = date('Y-m-d');
            $model->active = 1;
            $model->save(false);
            Yii::$app->session->setFlash('success', "Service Action created");
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ServicejobActionServiceRepair model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "Service Action updated");
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ServicejobActionServiceRepair model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', "Service Action deleted");
        return $this->redirect(['index']);
    }

    /**
     * Finds the ServicejobActionServiceRepair model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ServicejobActionServiceRepair the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ServicejobActionServiceRepair::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
