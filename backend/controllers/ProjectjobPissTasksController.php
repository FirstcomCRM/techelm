<?php

namespace backend\controllers;

use Yii;
use common\models\ProjectjobPissTasks;
use common\models\SearchProjectjobPissTasks;
use common\models\Upload;
use common\models\UserGroup;
use common\models\UserPermission;
use common\models\User;
use yii\web\UploadedFile;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

/**
 * ProjectjobPissTasksController implements the CRUD actions for ProjectjobPissTasks model.
 */
class ProjectjobPissTasksController extends Controller
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
      $userGroupArray = ArrayHelper::map(UserGroup::find()->all(), 'id', 'name');

        foreach ( $userGroupArray as $uGId => $uGName ){
            $permission = UserPermission::find()->where(['controller' => 'ProjectjobPissTasks'])->andWhere(['user_group_id' => $uGId ] )->all();
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
     * Lists all ProjectjobPissTasks models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchProjectjobPissTasks();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProjectjobPissTasks model.
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
     * Creates a new ProjectjobPissTasks model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new ProjectjobPissTasks();
        $file = new Upload();
        $projectJobId = $id;
        $result = false;
        if ($model->load(Yii::$app->request->post())) {
            $post = Yii::$app->request->post('ProjectjobPissTasks');
            $files = UploadedFile::getInstances($model, 'drawing_before');
            foreach ($post['description'] as $k => $v) {
                $model = new ProjectjobPissTasks();
                $model->projectjob_id = $projectJobId;
              //  $model->projectjob_id = $post['projectjob_id'];
                $model->description = $post['description'][$k];
                //$file->imageFile = $files[$k];
                $model->drawing_before = "NO FILE UPLOADED";
                $model->status = 0;
                 $model->drawing_after = "NO FILE UPLOADED";
                //$model->serial_no = $post['serial_no'][$k];
                $model->date_updated = date('Y-m-d h:i:s');
                $model->date_created = date('Y-m-d h:i:s');
                $model->created_by = Yii::$app->user->id;
                $result = $model->save();
                $model->serial_no = $model->id;
                $model->save(false);
                if($result){
                        if($file->upload($model->id)){
                            $model->drawing_before = $file->uploadedPath;
                            $model->save();
                        }
                    }else{
                        print_r($model->getErrors());
                        Yii::$app->getSession()->setFlash('warning', 'Pre-installation task failed');
                        return $this->redirect(['project-job/view','id'=>  $projectJobId]);
                    }
                }

            if($result){
                Yii::$app->getSession()->setFlash('success', 'Pre-installation task addded!');
                return $this->redirect(['project-job/view','id'=>  $projectJobId]);
              //  return $this->redirect(['index']);
            }


        } else {
            return $this->render('create', [
                'model' => $model,

            ]);
        }
    }

    /**
     * Updates an existing ProjectjobPissTasks model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $file = new Upload();
        $result = false;
        if ($model->load(Yii::$app->request->post()) ) {
              $files = UploadedFile::getInstance($model, 'drawing_before');
              $file->imageFile = $files;
              $model->date_updated = date('Y-m-d h:i:s');
              $result = $model->save();
              if($result)
              {

                  if($file->upload($id)){
                      $model->drawing_before = $file->uploadedPath;
                      $model->save();
                  }
                  }else{
                      Yii::$app->getSession()->setFlash('warning', 'Pre-installation task update failed');
                      return $this->redirect(['project-job/view','id'=>  $projectJobId]);
              }

              if($result)
              {
                Yii::$app->getSession()->setFlash('success', 'Pre-installation task updated!');
                return $this->redirect(['project-job/view','id'=>  $model->projectjob_id]);
              }

        } else {

            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ProjectjobPissTasks model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->active = self::STATUS_INACTIVE;
        if($model->update()){
            Yii::$app->getSession()->setFlash('success', 'Pre-installation task deleted!');
          //  Yii::$app->session->setFlash('success', $id.' HAS BEEN DELETED!');
        }
        return $this->redirect(['project-job/view','id'=>$model->projectjob_id]);
    }

    /**
     * Finds the ProjectjobPissTasks model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProjectjobPissTasks the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProjectjobPissTasks::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
