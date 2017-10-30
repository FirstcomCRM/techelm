<?php

namespace backend\controllers;

use Yii;
use common\models\ServicejobParts;
use common\models\SearchServicejobParts;
use common\models\UserGroup;
use common\models\UserPermission;
use common\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

/**
 * ServicejobPartsController implements the CRUD actions for ServicejobParts model.
 */
class ServicejobPartsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
      $userGroupArray = ArrayHelper::map(UserGroup::find()->all(), 'id', 'name');

      foreach ( $userGroupArray as $uGId => $uGName ){
          $permission = UserPermission::find()->where(['controller' => 'ServicejobParts'])->andWhere(['user_group_id' => $uGId ] )->all();
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
            /*  'rules' => [
                  [
                      'actions' => $action['admin'],
                      'allow' => $allow['admin'],
                      'roles' => ['admin'],
                  ],

                  [
                      'actions' => $action['engineer'],
                      'allow' => $allow['engineer'],
                      'roles' => ['engineer'],
                  ],
                  [
                      'actions' => $action['mechanic'],
                      'allow' => $allow['mechanic'],
                      'roles' => ['mechanic'],
                  ],
                  [
                      'actions' => $action['purchasing'],
                      'allow' => $allow['purchasing'],
                      'roles' => ['purchasing'],
                  ],
                  [
                      'actions' => $action['inspector'],
                      'allow' => $allow['inspector'],
                      'roles' => ['inspector'],
                  ],
                  [
                      'actions' => $action['contractor'],
                      'allow' => $allow['contractor'],
                      'roles' => ['contractor'],
                  ],
                  [
                      'actions' => $action['client'],
                      'allow' => $allow['client'],
                      'roles' => ['client'],
                  ],
              ],*/
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
     * Lists all ServicejobParts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchServicejobParts();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ServicejobParts model.
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
     * Creates a new ServicejobParts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ServicejobParts();
        $model->date_added = date("Y/m/d H:i:s");
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "Service job part created");
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ServicejobParts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "Service job part updated");
          //  return $this->redirect(['view', 'id' => $model->id]);
            return $this->redirect(['servicejob/update', 'id' => $model->servicejob_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ServicejobParts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', "Service job part deleted");
        //return $this->redirect(['index']);
        return $this->redirect(['servicejob/update', 'id' => $model->servicejob_id]);

    }

    /**
     * Finds the ServicejobParts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ServicejobParts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ServicejobParts::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
