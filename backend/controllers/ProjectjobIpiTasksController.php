<?php

namespace backend\controllers;

use Yii;
use common\models\ProjectjobIpiTasks;
use common\models\SearchProjectjobIpiTasks;
use common\models\UserGroup;
use common\models\UserPermission;
use common\models\User;
use common\models\ProjectjobIpiTasksAction;
use common\models\Model;
use common\models\ProjectjobIpiCorrectiveActions;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\db\Command;
//use yii\base\Model;

/**
 * ProjectjobIpiTasksController implements the CRUD actions for ProjectjobIpiTasks model.
 */
class ProjectjobIpiTasksController extends Controller
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
            $permission = UserPermission::find()->where(['controller' => 'ProjectjobIpiTasks'])->andWhere(['user_group_id' => $uGId ] )->all();
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
     * Lists all ProjectjobIpiTasks models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchProjectjobIpiTasks();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProjectjobIpiTasks model.
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
     * Creates a new ProjectjobIpiTasks model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
      $dummy = new ProjectjobIpiTasksAction();
      $model = [new ProjectjobIpiTasks];

      $project = $id;
      $action = ProjectjobIpiTasksAction::find()->all();
    //  die('test');
      //$post =$model->load(Yii::$app->request->post());
      $dummy->description = 'test';
      if ($dummy->load(Yii::$app->request->post())   ) {

         $model = Model::createMultiple(ProjectjobIpiTasks::classname());
      //   var_dump($modelLine);die();
         Model::loadMultiple($model, Yii::$app->request->post());

      // validate all models

      $valid = Model::validateMultiple($model);
      //var_dump($valid);die();
      if ($valid) {
          $transaction = \Yii::$app->db->beginTransaction();
          try {

                  foreach ($model as $line)
                  {

                    $line->projectjob_id = $id;
                    $line->status_flag = 0;
                    $line->car_no = 0;
                    $line->date_created = date('Y-m-d h:i:s');
                    $line->created_by = Yii::$app->user->id;
                    $line->form_type= 'EPS';
                      if (! ($flag = $line->save(false))) {
                          $transaction->rollBack();
                          break;
                      }
                    $correct = new ProjectjobIpiCorrectiveActions();
                    $correct->projectjob_id = $id;
                    $correct->projectjob_task_id = $line->id;
                    $correct->serial_no = $line->serial_no;
                    $correct->car_no = $line->corrective_actions;
                    $correct->date_created = date('Y-m-d H:i:s');
                    $correct->created_by = Yii::$app->user->id;
                    $correct->form_type = 'EPS';
                    $correct->save(false);
                  /*      Yii::$app->db->createCommand()->
                        insert('projectjob_ipi_tasks',['projectjob_id'=>$id,
                        'form_type'=>'PW',
                        'serial_no'=>$line->serial_no,
                        'description'=>$line->description,
                        'corrective_actions'=>$line->corrective_actions,
                        'target_completion_date'=>$line->target_completion_date,
                        'status_flag'=> 0,
                        'car_no'=>0,
                        'date_updated'=>date('Y-m-d h:i:s'),
                        ])->execute();*/
                  }
                  $this->addPw($model,$id);

              if ($flag) {
                  $transaction->commit();
              //    $this->addCorrective($model);
                  Yii::$app->session->setFlash('success', "Inspection Tasks has been added!");
                  return $this->redirect(['project-job/view', 'id' => $id]);
              }
          } catch (Exception $e) {
              $transaction->rollBack();
          }
      }


      } else {
      //  Yii::$app->session->setFlash('success', "Inspection Tasks has been added!");

          return $this->render('create', [
              'action'=>  $action,
              'model'=> (empty($model)) ? [new ProjectjobIpiTasks] : $model,
              'dummy'=>$dummy
          ]);
      }

    }

    /**
     * Updates an existing ProjectjobIpiTasks model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $action = ProjectjobIpiTasksAction::find()->all();
    //    print_r($model->description);die();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->date_updated = date('Y-m-d h:i:s');
        //    $model->target_completion_date = date('Y-m-d', strtotime($model->target_completion_date));
            $corrective = ProjectjobIpiCorrectiveActions::find()->where(['projectjob_task_id'=>$model->id])->one();
      //      print_r($corrective);die();
            $corrective->serial_no = $model->serial_no;
            $corrective->car_no = $model->corrective_actions;
            $corrective->date_updated = date('Y-m-d h:i:s');
            $corrective->save(false);
            $model->save(false);

            Yii::$app->getSession()->setFlash('success', 'Inspection Task  has been updated!');
            return $this->redirect(['project-job/view', 'id' => $model->projectjob_id]);
            //return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'action'=>$action,
            ]);
        }
    }

    /**
     * Deletes an existing ProjectjobIpiTasks model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->active = self::STATUS_INACTIVE;
        if($model->update()){
            Yii::$app->session->setFlash('success', "Inspection task has been deleted");
          //  Yii::$app->session->setFlash('success', $id. ' HAS BEEN SET TO INACTIVE');
        }
        return $this->redirect(['project-job/view', 'id' => $model->projectjob_id]);

      //  return $this->redirect(['project-job/inde']);
    }

    protected function addPw($model,$id){
      foreach ($model as $line) {
        $data = new ProjectjobIpiTasks;
        $data->projectjob_id = $id;
        $data->status_flag = 0;
        $data->car_no = 0;
        $data->serial_no = $line->serial_no;
        $data->description = $line->description;
        $data->corrective_actions = $line->corrective_actions;
        $data->target_completion_date = $line->target_completion_date;
        $data->date_created = date('Y-m-d h:i:s');
        $data->form_type= 'PW';
        $data->created_by = Yii::$app->user->id;
        $data->save(false);
        $correct = new ProjectjobIpiCorrectiveActions();
        $correct->projectjob_id = $id;
        $correct->projectjob_task_id = $data->id;
        $correct->serial_no = $data->serial_no;
        $correct->car_no = $data->corrective_actions;
        $correct->date_created = date('Y-m-d H:i:s');
        $correct->form_type = 'PW';
        $correct->created_by = Yii::$app->user->id;
        $correct->save(false);
      }
    }

    /**
     * Finds the ProjectjobIpiTasks model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProjectjobIpiTasks the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */


    protected function findModel($id)
    {
        if (($model = ProjectjobIpiTasks::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
