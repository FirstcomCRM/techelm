<?php

namespace backend\controllers;

use Yii;
use common\models\ProjectjobSiteWalkActions;
use common\models\ProjectjobSiteWalkActionsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProjectjobSiteWalkActionsController implements the CRUD actions for ProjectjobSiteWalkActions model.
 */
class ProjectjobSiteWalkActionsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
      $userGroupArray = ArrayHelper::map(UserGroup::find()->all(), 'id', 'name');

            foreach ( $userGroupArray as $uGId => $uGName ){
                $permission = UserPermission::find()->where(['controller' => 'ProjectjobSiteWalkActions'])->andWhere(['user_group_id' => $uGId ] )->all();
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
                    'only' => ['index', 'create', 'update', 'view', 'delete'],
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
     * Lists all ProjectjobSiteWalkActions models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProjectjobSiteWalkActionsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProjectjobSiteWalkActions model.
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
     * Creates a new ProjectjobSiteWalkActions model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProjectjobSiteWalkActions();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ProjectjobSiteWalkActions model.
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
     * Deletes an existing ProjectjobSiteWalkActions model.
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
     * Finds the ProjectjobSiteWalkActions model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProjectjobSiteWalkActions the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProjectjobSiteWalkActions::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
