<?php

namespace backend\controllers;

use Yii;
use mPDF;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
//Models
use common\models\ProjectJob;
use common\models\SearchProjectJob;

use common\models\ProjectjobPiss;
use common\models\ProjectjobIpi;
use common\models\ProjectjobAssignment;
use common\models\UserGroup;
use common\models\UserPermission;
use common\models\User;
use common\models\ProjectjobIpiTasks;
use common\models\ProjectjobPissTasks;
use common\models\ProjectjobSiteWalkActions;

use common\models\Company;
//Search Model
use common\models\SearchProjectjobIpi;
use common\models\SearchProjectjobPiss;
use common\models\SearchProjectjobIpiTasks;
use common\models\SearchProjectjobPissTasks;
use yii\swiftmailer\Mailer;
use yii\db\Command;

/**
 * ProjectJobController implements the CRUD actions for ProjectJob model.
 */

 /*
 Notes regarding the ProjectJob module (EDR)
 -Project Job module consist of numerous tables, all connected by the projectjob ID of the main project Job.
 -In the view page of the project job, there are two buttons, Pre-installation and Inspection tasks.
 -Please note that their logic comes from their respective controllers, projectjoIpITasks and ProjectjobPissTasks
 -If you need to change their forms or something go there.
 -Their views has been edited to render the view page of the main projectjob.
 */
class ProjectJobController extends Controller
{
    /**
     * @inheritdoc
     */
    private $from = "no-reply@firstcom.sg";
    public function behaviors()
    {

$userGroupArray = ArrayHelper::map(UserGroup::find()->all(), 'id', 'name');

      foreach ( $userGroupArray as $uGId => $uGName ){
          $permission = UserPermission::find()->where(['controller' => 'ProjectJob'])->andWhere(['user_group_id' => $uGId ] )->all();
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
     * Lists all ProjectJob models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchProjectJob();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionTest(){
        $result = Yii::$app->mailer->compose()
                    ->setFrom($this->from)
                    ->setTo('ronaldallanpatawaran@gmail.com')
                    ->setSubject('Message subject')
                    ->setTextBody('Plain text content')
                    ->setHtmlBody('<b>Send</b>')
                    ->send();


        if($result){
            echo "Sent";
        }else{
            echo "Failed";
        }
    }

    /**
     * Displays a single ProjectJob model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $SearchProjectJobIpi= new SearchProjectjobIpi();
        $SearchProjectJobIpi->projectjob_id = $id;
        $ProjectJobIpiData = $SearchProjectJobIpi->search(Yii::$app->request->queryParams);

        $SearchProjectJobPiss= new SearchProjectjobPiss();
        $SearchProjectJobPiss->projectjob_id = $id;
        $piss = $SearchProjectJobPiss->search(Yii::$app->request->queryParams);

        $ProjectJobPissData = $SearchProjectJobPiss->search(Yii::$app->request->queryParams);
        $PissJoinTask = SearchProjectJob::searchJoinTasks($id);
        $engineers = ProjectjobAssignment::dataProvider($id);

        $serchProjectJobIpiTask = new SearchProjectjobIpiTasks();
        $serchProjectJobIpiTask->projectjob_id = $id;
        $ProjectJobIpiTask =$serchProjectJobIpiTask->search(Yii::$app->request->queryParams);

        $searchProjectJobPissTask = new SearchProjectjobPissTasks();
        $searchProjectJobPissTask->projectjob_id = $id;
        $ProjectJobPissTask = $searchProjectJobPissTask->search(Yii::$app->request->queryParams);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'SearchProjectJobIpi' => $SearchProjectJobIpi,
            'SearchProjectJobPiss' => $SearchProjectJobPiss,
            'ProjectJobIpiData' => $ProjectJobIpiData,
            'PissJoinTask' => $PissJoinTask,
            'engineers' => $engineers,
            'ProjectJobIpiTask'=>  $ProjectJobIpiTask,
            'ProjectJobPissTask'=> $ProjectJobPissTask,
            'piss'=>$piss,
        ]);
    }

    /**
     * Creates a new ProjectJob model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProjectJob();
        $model1 = new ProjectjobPiss();
        $model3 = new ProjectjobIpi();
        $model4 = new ProjectjobIpi();
        $model5 = new ProjectjobSiteWalkActions();
        $model_assignment = new ProjectjobAssignment();
        if ($model->load(Yii::$app->request->post()) && $model1->load(Yii::$app->request->post()) && $model3->load(Yii::$app->request->post()) && $model4->load(Yii::$app->request->post())) {
            $model3->form_type = "EPS";
            $model4->form_type = "PW";
            $model->start_date = date('Y-m-d', strtotime(Yii::$app->request->post('Projectjob')['start_date']));
            $model->date_created = date('Y-m-d H:i:s');
            $model->created_by = (string)Yii::$app->user->id;
          //  $model->end_date = date('Y-m-d', strtotime(Yii::$app->request->post('Projectjob')['end_date']));
            if($model->save()){
                $model->project_ref = sprintf('PRJ%06d',$model->id);
                $res = $model->update();
                $model3->projectjob_id = $model->id;
                $model4->projectjob_id = $model->id;
                $model1->projectjob_id = $model->id;

                $model1->date_created = date('Y-m-d H:i:s');
                $model1->created_by =(string)Yii::$app->user->id;

                $model3->date_created = date('Y-m-d H:i:s');
                $model3->created_by =(string)Yii::$app->user->id;
                $model4->date_created = date('Y-m-d H:i:s');
                $model4->created_by =(string)Yii::$app->user->id;

                $data = ProjectjobSiteWalkActions::find()->all();
                //die(print_r($data));
                foreach ($data as $key => $value) {
                    $piss = new ProjectjobPissTasks();
                    $piss->projectjob_id = $model->id;
                    $piss->description = $value->action;
                    $piss->status = 0;
                    $piss->date_created = date('Y-m-d h:i:s');
                    $piss->created_by = Yii::$app->user->id;
                    $piss->save(false);
                    $piss->serial_no = $piss->id;
                    $piss->save(false);
                }

                $model1->save();
                $model4->save();
                $model3->save();
                #Save Assignments
                foreach (Yii::$app->request->post('ProjectjobAssignment')['engineer_id'] as $key => $value) {
                    $assignment = new ProjectjobAssignment();
                    $assignment->projectjob_id = $model->id; #project_job_id
                    $assignment->engineer_id = $value; # engineers_id
                    $assignment->date_created = date('Y-m-d H:i:s');
                    $result = $assignment->save();

                    $message = $model->project_ref.' has been created.';
                    $user_id = $assignment->engineer_id;
                    $img_url = '';
                    $tag = 'project_job_assigned';
                    $data = User::find()->where(['id'=>$assignment->engineer_id])->one();
                    $fcm_id = $data->fcm_registered_id;
                    $this->send($fcm_id, $message, $img_url, $tag, $user_id,$model->id);
                  //  $this->_sentNotification($result, $assignment->engineer_id);
                }

                if($result){
                  Yii::$app->session->setFlash('success', "Project job created");
                  return $this->redirect(['view', 'id' => $model->id]);
                }



            }else{
                print_r($model->getErrors()) ;
                return $this->render('create', [
                    'model' => $model,
                    'model1'=> $model1,
                    'model3'=> $model3,
                    'assignment' => $model_assignment
                ]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'model1'=> $model1,
                'model3'=> $model3,
                'assignment' => $model_assignment
            ]);
        }
    }

    private function _sentNotification($result,$id){
        if($result){
            $email = User::find()->where(['id'=> $id])->one();
                $result = Yii::$app->mailer->compose()
                ->setFrom($this->from)
                ->setTo($email['email'])
                ->setSubject('Message subject')
                ->setTextBody('You been asigned for project job tasks')
                ->send();
        }

    }

    /**
     * Updates an existing ProjectJob model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model1 = ProjectjobPiss::findOne(['projectjob_id'=>$id]); // Pre-installation Process
        $model3 = ProjectjobIpi::findOne(['projectjob_id'=>$id, 'form_type'=> 'PW']);
        $model4 = ProjectjobIpi::findOne(['projectjob_id'=>$id, 'form_type'=> 'EPS']);
        $engineers = ProjectjobAssignment::findOne(['projectjob_id'=> $id]);



      //  $engineers = ProjectjobAssignment::find()->where(['projectjob_id'=> $id])->all();
    //     print_r(count($engineers));die();
        if ($model->load(Yii::$app->request->post()) && $model1->load(Yii::$app->request->post()) && $model3->load(Yii::$app->request->post())) {
            $model3->form_type = "EPS";
            $model4->form_type = "PW";
            $model4->sub_contractor = $model3->sub_contractor; //edr
            $model->start_date = date('Y-m-d', strtotime(Yii::$app->request->post('Projectjob')['start_date']));
            $model->date_updated = date('Y-m-d H:i:s');
            $model1->date_updated = date('Y-m-d H:i:s');
        //    $model3->date_updated = date('Y-m-d H:i:s');
          //  $model4->date_updated = date('Y-m-d H:i:s');
            if($model->save()&&$model1->save()&&$model3->save()&&$model4->save()){
                $model->project_ref = sprintf('PRJ%06d',$model->id);
                $res = $model->update();
                $model3->projectjob_id = $model->id;
                $model4->projectjob_id = $model->id;
                $model1->projectjob_id = $model->id;
                #Save Assignments
                $resu = Yii::$app->request->post('ProjectjobAssignment')['engineer_id'];
                Yii::$app->db->createCommand()->delete('projectjob_assignment', ['projectjob_id' => $id])->execute();
                foreach (Yii::$app->request->post('ProjectjobAssignment')['engineer_id'] as $key => $value) {
                    //$engineers = ProjectjobAssignment::find;
                    //$engineers->projectjob_id = $model->id; #project_job_id
                  //  $engineers->engineer_id = $value; # engineers_id
                //    $engineers->date_created = date('Y-m-d H:i:s');
                //    echo  $engineers->engineer_id .'<br>';
                //    $result = $engineers->save();

                    $eng = new ProjectjobAssignment();
                    $eng->projectjob_id = $model->id;
                    $eng->engineer_id = $value;
                    $eng->date_created = date('Y-m-d H:i:s');
                    $result = $eng->save();
                  //  $this->_sentNotification($result, $engineers->engineer_id);
                }
                // die();
              //  var_dump($result);die();
                if($result){
                  Yii::$app->session->setFlash('success', "Project job updated");
                  return $this->redirect(['view', 'id' => $model->id]);
                }
            }else{
               return $this->render('update', [
                    'model'  => $model,
                    'model1' => $model1,
                    'model3' => $model3,
                    'assignment' => $engineers

                ]);
            }
        } else {
            return $this->render('update', [
                'model'  => $model,
                'model1' => $model1,
                'model3' => $model3,
                'assignment' => $engineers
            ]);
        }
    }

    /**
     * Deletes an existing ProjectJob model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->active = 0;
        $model->update();
        Yii::$app->session->setFlash('success', "Project job deleted");
        return $this->redirect(['index']);
    }

    public function actionMobilePage($id){
      $this->layout = 'mobile-layout';
      $model = $this->findModel($id);
      $piss = ProjectjobPiss::find()->where(['projectjob_id'=>$id])->one();
      $ipi = ProjectjobIpi::find()->where(['projectjob_id'=>$id])->one();
      $assign = ProjectjobAssignment::find()->where(['projectjob_id'=>$id])->all();
      $ipiTask = ProjectjobIpiTasks::find()->where(['projectjob_id'=>$id])->all();
      $pissTask =ProjectjobPissTasks::find()->where(['projectjob_id'=>$id])->all();
      $company = Company::find()->one();
    //  print_r($piss->id);die();
      return $this->render('mobile-page',[
        'model'=>$model,
        'piss'=>$piss,
        'ipi'=>$ipi,
        'assign'=>$assign,
        'ipiTask'=>$ipiTask,
        'pissTask'=>$pissTask,
        'company'=>$company,
      ]);
    }

    public function actionSiteWalk($id){
      $model = $this->findModel($id);
      $piss = ProjectjobPiss::find()->where(['projectjob_id'=>$id])->one();
      $company = Company::find()->one(); //edr
      $pissTask =ProjectjobPissTasks::find()->where(['projectjob_id'=>$id])->orderBy(['id'=>SORT_DESC])->all();
      $assign = ProjectjobAssignment::find()->where(['projectjob_id'=>$id])->all();

      $mpdf = new mPDF('utf-8');
      $mpdf->content = $this->renderPartial('site-pdf',[
          'model'=>$model,
          'piss'=>$piss,
          'pissTask'=>$pissTask,
          'assign'=>$assign,
          'company'=>$company
      ]);
      $mpdf->setFooter('{PAGENO}');
      $mpdf->WriteHTML($mpdf->content);
      $mpdf->Output($model->id.'.pdf','I');
      exit;
    }

    public function actionProjectjobPdf($id){
      $model = $this->findModel($id);
      $piss = ProjectjobPiss::find()->where(['projectjob_id'=>$id])->one();
      $ipi = ProjectjobIpi::find()->where(['projectjob_id'=>$id])->one();
      $assign = ProjectjobAssignment::find()->where(['projectjob_id'=>$id])->all();
      $ipiTask = ProjectjobIpiTasks::find()->where(['projectjob_id'=>$id])->all();
      $pissTask =ProjectjobPissTasks::find()->where(['projectjob_id'=>$id])->all();
      $company = Company::find()->one();
      $mpdf = new mPDF('utf-8');
      $mpdf->content =  $this->renderPartial('projectjob-pdf',[
        'model'=>$model,
        'piss'=>$piss,
        'ipi'=>$ipi,
        'assign'=>$assign,
        'ipiTask'=>$ipiTask,
        'pissTask'=>$pissTask,
        'company'=>$company,
      ]);
      $mpdf->setFooter('{PAGENO}');
      $mpdf->WriteHTML($mpdf->content);
      $mpdf->Output($model->id.'.pdf','I');
      exit;
    }

    public function actionUnlock($id){
      $model = $this->findModel($id);
      $model->status_flag = 0;
      $model->locked_to_user = 0;
      $model->save(false);
      Yii::$app->session->setFlash('success', "Job unlock!");
      return $this->redirect(['view', 'id' => $id]);
    }

    public function actionMobileEmail($id){
      $model = $this->findModel($id);
      return $this->renderPartial('mobile-email',[
        'model'=>$model,

      ]);
    }

    /**
     * Finds the ProjectJob model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProjectJob the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProjectJob::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function send($reg_id, $message, $img_url, $tag, $user_id,$id){
      //if (!defined('constant')) define('constant', 'value');
      if (!defined('GOOGLE_API_KEYS')) {
          define("GOOGLE_API_KEYS", "AIzaSyAxewEiK97rX2fGNZ-USeIxWujL68uA78Y");
      }

      if (!defined('GOOGLE_GCM_URLS')) {
          define("GOOGLE_GCM_URLS", "https://fcm.googleapis.com/fcm/send");
      }
    //  define("GOOGLE_API_KEYS", "AIzaSyAxewEiK97rX2fGNZ-USeIxWujL68uA78Y"); // Techelm Mobile
    //  define("GOOGLE_GCM_URLS", "https://fcm.googleapis.com/fcm/send");

      $data = array(
        'title'=>'Android Learning',
        'message'=>$message,
        'image'=>$img_url,
        'tag'=>$tag,
        'user_id'=>$user_id,
      );

      $fields = array(
          'to'  						=> $reg_id ,
          'priority'					=> "high",
          //'data'						=> array("title" => "Android Learning", "message" => $message, "image"=> $img_url, "tag" => $tag)
          'data'						=> $data,
      );

      $headers = array(
          //GOOGLE_GCM_URL,
          'Content-Type: application/json',
          'Authorization: key=' . GOOGLE_API_KEYS,
      );

        $ch = curl_init();
        curl_setopt_array($ch, [
           CURLOPT_POST           => true,
           CURLOPT_URL =>'https://android.googleapis.com/gcm/send',
           CURLOPT_SSL_VERIFYPEER => false,
           CURLOPT_BINARYTRANSFER => true,
           CURLOPT_RETURNTRANSFER => true,
           CURLOPT_HEADER         => false,
           CURLOPT_FRESH_CONNECT  => false,
           CURLOPT_FORBID_REUSE   => false,
           CURLOPT_HTTPHEADER     => $headers,
            CURLOPT_POSTFIELDS     => json_encode($fields),
        ]);
        $result = curl_exec($ch );



    curl_close( $ch );
     $result = json_decode($result , true);

     Yii::$app->session->setFlash('success', "Service Job created");
     return $this->redirect(['view', 'id' => $id]);

    }

}
