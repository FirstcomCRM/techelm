<?php
namespace  backend\controllers;


use Yii;
use mPDF;
use common\models\Servicejob;
use common\models\SearchServicejob;
use common\models\UserGroup;
use common\models\UserPermission;
use common\models\User;
use common\models\Service;
use common\models\ServicejobComplaintFault;
use common\models\ServicejobActionServiceRepair;
use common\models\ServicejobComplaintMobile;
use common\models\ServicejobCmCf;
use common\models\ServicejobCmAsr;
use common\models\ServicejobParts;
use common\models\ServicejobUploads;
use common\models\SearchServicejobParts;
use common\models\ServicejobRecordings;
use common\models\Company;
use common\models\Customer;
use common\models\Model;
use common\models\base30;
use common\models\ConvertPng;
use common\components\Fcm;
use common\models\Fcm_model;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
 * ServicejobController implements the CRUD actions for Servicejob model.
 */

class ServicejobController extends Controller
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
           $permission = UserPermission::find()->where(['controller' => 'Servicejob'])->andWhere(['user_group_id' => $uGId ] )->all();
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

     if (!empty($usergroup_id)) {
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
       }else{
         return [
             'access' => [
                 'class' => AccessControl::className(),
                 'rules' => [
                     [
                         'actions' => ['login', 'error','sign','c-form','mobile-email','pdf-service'],
                         'allow' => true,
                     ],
                     [
                         'actions' => ['logout', 'index','sign','c-form','mobile-email','pdf-service'],
                         'allow' => true,
                         'roles' => ['@'],
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

    }

    /**
     *Lists all Servicejob models.
     *return mixed
     */

    public function actionIndex()
    {

        $searchModel = new SearchServicejob();
      //  $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider = $searchModel->customSearch(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Servicejob model.
     * @param integer $id
     * @return mixed
     */

    public function actionView($id)
    {
        $model = $this->findModel($id);

        if (!empty($model->signature_web)) {
          $base = new ConvertPng();
          $test = $base->base30_to_jpeg($model->signature_web, 'signature.png');
          $model->signature_web = $test;
        }

        $modelComplaints = ServicejobComplaintMobile::find()->where(['servicejob_id' => $id])->all();
        $modelParts = ServicejobParts::find()->where(['servicejob_id'=>$id])->all();
        return $this->render('view', [
            'model' => $model,
            'modelComplaints'=>$modelComplaints,
            'modelParts'=>$modelParts,
        ]);

    }

    public function actionSign($id){
      $model = $this->findModel($id);
      $this->layout = 'c-main';
      $modelComplaints = ServicejobComplaintMobile::find()->where(['servicejob_id' => $id])->all();

      if ($model->load(Yii::$app->request->post() )  ) {
          $model->save(false);
          Yii::$app->session->setFlash('success', "Signature Added");

        return $this->redirect(['c-view',
        'id'=>$id,
        //'model' => $model,
        //'modelComplaints'=>$modelComplaints,
        ]);

      }else{
        return $this->render('sign',[
            'model'=>$model,
        ]);
      }

    }

    public function actionCView($id){
      $model = $this->findModel($id);
      $this->layout = 'c-main';
      if (!empty($model->signature_web)) {
        $base = new ConvertPng();
        $test = $base->base30_to_jpeg($model->signature_web, 'signature.png');
        $model->signature_web = $test;
      }

      $modelComplaints = ServicejobComplaintMobile::find()->where(['servicejob_id' => $id])->all();
      $modelParts = ServicejobParts::find()->where(['servicejob_id'=>$id])->all();
      return $this->render('c-view', [
          'model' => $model,
          'modelComplaints'=>$modelComplaints,
          'modelParts'=>$modelParts,
      ]);
    }

    public function actionCForm($id){
      $model = $this->findModel($id);
      $this->layout = 'c-main';
      if ($model->load(Yii::$app->request->post())    ) {

          if (!empty($model->signature_name) && $model->signature_customer_name != '') {
            $model->status = 3;
          //  $model->end_date = date('Y-m-d h:i:s');
          }
          $model->signature_customer_name_date	= date('Y-m-d H:i:s');
          $model->save(false);
          $attach = $this->actionPdfService($id,'email');
          $this->composeEmail($model,$attach);
          Yii::$app->session->setFlash('success', "Signature Added.");
          return $this->redirect(['c-view', 'id' => $id]);
      }else{
        return $this->render('c-form',['model'=>$model]);
      }

    }

    /**
     * Creates a new Servicejob model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    public function actionCreate()
    {

       $model = new Servicejob();
       $modelComplaints = [new ServicejobComplaintMobile];
       $modelServicejobCmCf = new ServicejobCmCf();
       $lastRecords = Servicejob::find()->select(['date_created'])->where(['active'=> 1])->orderby(['id'=> SORT_DESC])->asArray()->one();
      // $countPerMonth = Servicejob::find()->where(['active'=> 1, 'MONTH(date_created)'=> date('m')])->count();
        $countPerMonth = Servicejob::find()->where(['MONTH(date_created)'=> date('m')])->count();
       //$post =$model->load(Yii::$app->request->post());
        $model->service_date = date('Y-m-d');

       if ($model->load(Yii::$app->request->post())  ) {
          $modelComplaints = Model::createMultiple(ServicejobComplaintMobile::classname());

          Model::loadMultiple($modelComplaints, Yii::$app->request->post());

          $model->status = 0;
          $model->start_date = date('Y-m-d h:i:s');
          $model->service_no = sprintf('SEV'.date('Ym').'1%03d', ($countPerMonth+1));
          $model->date_created = date('Y-m-d h:i:s');

          $data = Service::find()->where(['id'=>$model->service_id])->one();
          if (!empty($data)) {
            $model->type_of_service = $data->service_name;

          }

          $data = Servicejob::find()->where(['service_no'=>$model->service_no])->one();
          if (empty($data->service_no)) {
            $model->service_no = sprintf('SEV'.date('Ym').'1%03d', ($countPerMonth+1));
          }else{
            $model->service_no = sprintf('SEV'.date('Ym').'1%03d', ($countPerMonth+2));
          }

          $data = null;
          $valid = $model->validate();
          $valid = Model::validateMultiple($modelComplaints) && $valid;
              //print_r($valid);die('test');
       if ($valid) {
           $transaction = \Yii::$app->db->beginTransaction();
           try {
               if ($flag = $model->save(false)) {
                   foreach ($modelComplaints as $line)
                   {
                       $line->servicejob_id = $model->id;
                       $line->date_created = date('Y-m-d H:i:s');
                       $line->active = 1;
                       $complaint_name= ServicejobComplaintFault::find()->where(['id'=>$line->complaint_id])->one();
                       $line->complaint_name = $complaint_name->complaint;

                       if (! ($flag = $line->save(false))) {
                           $transaction->rollBack();
                           break;
                       }
                    //   print_r($line->id);die();
                       Yii::$app->db->createCommand()->insert('servicejob_cm_cf',['servicejob_complaint_mobile_id'=>$line->id,
                       'servicejob_complaint_fault_id'=>$line->complaint_id, 'remarks'=>$line->complaint_remark])->execute();
                   }
               }
                 //print_r(count($modelComplaints));die();
               if ($flag) {
                   $transaction->commit();

                   //insert here Firebase
            /*       $message = $model->service_no.' has been assigned to you';
                    $user_id = $model->engineer_id;
                    $img_url = '';
                    $tag = '';//service_job_assigned
                    $data = User::find()->where(['id'=>$model->engineer_id])->one();
                    $fcm_id = $data->fcm_registered_id;
                    //  $fcm_id = 'p';
                    $this->send($fcm_id, $message, $img_url, $tag, $user_id,$model->id);*/
                    Yii::$app->session->setFlash('success', "Service Job created");
                    return $this->redirect(['view', 'id' => $model->id]);
               }
           } catch (Exception $e) {

               $transaction->rollBack();
           }
       }else{//edr

            $data = $model->getErrors();
          //  var_dump($data);die();
          //echo $model->service_no;
          //  Yii::$app->session->setFlash('success', $data['service_no'][0]);
            //  Yii::$app->session->setFlash('success', 'test');
            return $this->render('create', [
               'model' => $model,
               'modelComplaints'=> (empty($modelComplaints)) ? [new ServicejobComplaintMobile] : $modelComplaints,
               'modelServicejobCmCf' => $modelServicejobCmCf
           ]);
       }


       } else {
           return $this->render('create', [
               'model' => $model,
               'modelComplaints'=> (empty($modelComplaints)) ? [new ServicejobComplaintMobile] : $modelComplaints,
               'modelServicejobCmCf' => $modelServicejobCmCf
           ]);
       }

    }

    /**
     * Updates an existing Servicejob model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */

    public function actionUpdate($id)
    {

      $model = $this->findModel($id);
      //echo $model->engineer_id; die();
      $modelComplaints = ServicejobComplaintMobile::find()->where(['active'=>1, 'servicejob_id'=> $id])->all();
      $modelServicejobCmCf =  ServicejobCmCf::find()->where(['active'=>1, 'servicejob_complaint_mobile_id'=> $id])->all();
      //$modelParts = ServicejobParts::find()->where(['servicejob_id'=>$id])->all();
      $searchModel = new SearchServicejobParts();
      $modelParts = $searchModel->jobSearch($id);

      if ($model->load(Yii::$app->request->post()) ) {

            $oldIDs = ArrayHelper::map($modelComplaints, 'id', 'id');
            $oldDbcomp = ArrayHelper::map($modelComplaints, 'servicejob_category_id', 'complaint_id');
            $complaint = Model::createMultiple(ServicejobComplaintMobile::classname(), $modelComplaints);
            Model::loadMultiple($complaint, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($complaint, 'id', 'id')));

            $data = Service::find()->where(['id'=>$model->service_id])->one();
            if (!empty($data)) {
              $model->type_of_service = $data->service_name;

            }


            $valid = $model->validate();
            $valid = Model::validateMultiple($complaint) && $valid;
            //die($test);

            if ($valid) {

                $transaction = \Yii::$app->db->beginTransaction();

                try {
                    if ($flag = $model->save(false)) {
                        if (! empty($deletedIDs)) {
                            ServicejobComplaintMobile::deleteAll(['id' => $deletedIDs]);
                            ServicejobCmCf::deleteAll(['servicejob_complaint_mobile_id' => $deletedIDs]);
                        }

                        foreach ($complaint as $line) {
                          //for final Yii::$app->db->createCommand()->delete('servicejob_cm_cf', ['servicejob_complaint_mobile_id' => $line->id])->execute();

                           $line->servicejob_id = $model->id;
                           $line->date_created = date('Y-m-d H:i:s');
                           $line->active = 1;
                           $complaint_name= ServicejobComplaintFault::find()->where(['id'=>intval($line->complaint_id)])->one();
                           $line->complaint_name = $complaint_name->complaint;

                          if (! ($flag = $line->save(false))) {
                                $transaction->rollBack();
                                break;
                            }

                            $modelcmcf = ServicejobCmCf::find()->where(['active'=>1, 'servicejob_complaint_mobile_id'=> intval($line->id)])->one();

                            if (empty($modelcmcf)) {
                               Yii::$app->db->createCommand()->insert('servicejob_cm_cf',['servicejob_complaint_mobile_id'=>intval($line->id),
                               'servicejob_complaint_fault_id'=>$line->complaint_id, 'remarks'=>$line->complaint_remark])->execute();
                            }else {
                               Yii::$app->db->createCommand()->update('servicejob_cm_cf',['servicejob_complaint_fault_id'=>$line->complaint_id,
                              'remarks'=>$line->complaint_remark, 'servicejob_complaint_mobile_id'=>$line->id],['servicejob_complaint_mobile_id'=>intval($line->id)])->execute();
                            }
                        //    var_dump($test);

                          //use this for final     Yii::$app->db->createCommand()->insert('servicejob_cm_cf',['servicejob_complaint_mobile_id'=>$line->id,
                          //     'servicejob_complaint_fault_id'=>$line->complaint_id, 'remarks'=>$line->complaint_remark])->execute();
                        }

                    }
                    //  die();
                    if ($flag) {
                        $transaction->commit();
                    //    die();
                         Yii::$app->session->setFlash('success', "Service Job updated");
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }

            return $this->redirect(['view', 'id' => $model->ID]);
        } else {

            return $this->render('update', [
                'model' => $model,
                'modelComplaints' => (empty($modelComplaints)) ? [new ServicejobComplaintMobile] :  $modelComplaints,
                'modelServicejobCmCf' => $modelServicejobCmCf,
                'modelParts'=>$modelParts,
            ]);
        }
    }

    public function actionPdfJobs($id){
      $model = $this->findModel($id);
      $modelComplaints = ServicejobComplaintMobile::find()->where(['active'=>1, 'servicejob_id'=> $id])->all();
      $test = '';
      if (!empty($model->signature_web)) {
        $base = new ConvertPng();
        $test = $base->base30_to_jpeg($model->signature_web, 'signature.png');
      }
      $mpdf = new mPDF('utf-8');
      $mpdf->content = $this->renderPartial('pdf',[
          'model'=>$model,
          'modelComplaints'=>$modelComplaints,
          'test'=>$test,
      ]);
      //$mpdf->setHeader('{PAGENO}');

      $mpdf->setFooter('{PAGENO}');
      $mpdf->WriteHTML($mpdf->content);
      $mpdf->Output($model->service_no.'.pdf','I');
      exit;

    }

    public function actionPdfParts($id){
      $model = $this->findModel($id);
      //$modelParts = ServicejobParts::find()->where(['servicejob_id'=>$id])->all();
      $modelParts = ServicejobParts::find()->select(['parts_name','quantity','unit_price','total_price'])->where(['servicejob_id'=>$id])->asArray()->all();
      $company = Company::find()->one();
      $partsTotal=ServicejobParts::find()->where(['servicejob_id'=>$id])->sum('total_price');
      $mpdf = new mPDF('utf-8');
      $mpdf->content = $this->renderPartial('pdf-parts',[
          'model'=>$model,
          'modelParts'=>$modelParts,
          'company'=>$company,
          'partsTotal'=>$partsTotal
      ]);

      $mpdf->setFooter('{PAGENO}');
      $mpdf->WriteHTML($mpdf->content);
      $mpdf->Output($model->service_no.'.pdf','I');
      exit;
    }

    public function actionPdfService($id, $type=""){
      $model = $this->findModel($id);
      $modelParts = ServicejobParts::find()->where(['servicejob_id'=>$id])->all();
      $company = Company::find()->one();
      $modelComplaints = ServicejobComplaintMobile::find()->where(['active'=>1, 'servicejob_id'=> $id])->all();
      $uploads = ServicejobUploads::find()->where(['servicejob_id'=>$id])->all();
      $recordings = ServicejobRecordings::find()->where(['servicejob_id'=>$id])->all();
      $mpdf = new mPDF('utf-8', 'A4');
    //  die(print_r($recordings));
      $mpdf->content = $this->renderPartial('pdf-service_report',[
          'model'=>$model,
          'modelParts'=>$modelParts,
          'modelComplaints'=>$modelComplaints,
          'uploads'=>$uploads,
          'recordings'=>$recordings,
          'company'=>$company,
      ]);
      $mpdf->SetHeader("{$model->service_no}| |{$model->remarks}");
      $mpdf->setFooter('{PAGENO}');
      $mpdf->WriteHTML($mpdf->content);
      if ($type == "email") {
        return $mpdf->Output('','S');
      }else{
        $mpdf->Output($model->service_no.'.pdf','I');
        exit;
      }

    }

    public function actionMobilePage($id){
      $this->layout = 'mobile-layout';
      $model = $this->findModel($id);
      $modelParts = ServicejobParts::find()->where(['servicejob_id'=>$id])->all();
      $company = Company::find()->one();
      $modelComplaints = ServicejobComplaintMobile::find()->where(['active'=>1, 'servicejob_id'=> $id])->all();
      $uploads = ServicejobUploads::find()->where(['servicejob_id'=>$id])->all();
      $recordings = ServicejobRecordings::find()->where(['servicejob_id'=>$id])->all();
      return $this->render('mobile-page',[
        'model'=>$model,
        'modelParts'=>$modelParts,
        'modelComplaints'=>$modelComplaints,
        'uploads'=>$uploads,
        'recordings'=>$recordings,
        'company'=>$company,
      ]);
    }

    public function actionMobileEmail($id){

      $model = $this->findModel($id);
      $modelParts = ServicejobParts::find()->where(['servicejob_id'=>$id])->all();
      $company = Company::find()->one();
      $modelComplaints = ServicejobComplaintMobile::find()->where(['active'=>1, 'servicejob_id'=> $id])->all();
      $uploads = ServicejobUploads::find()->where(['servicejob_id'=>$id])->all();
      $recordings = ServicejobRecordings::find()->where(['servicejob_id'=>$id])->all();
      return $this->renderPartial('mobile-email',[
        'model'=>$model,
        'modelParts'=>$modelParts,
        'modelComplaints'=>$modelComplaints,
        'uploads'=>$uploads,
        'recordings'=>$recordings,
        'company'=>$company,
      ]);
    }

    public function actionTest($id){
      $model = $this->findModel($id);
      $message = $model->service_no.' has been assigned to you';
                  $user_id = $model->engineer_id;
                  $img_url = '';
                  $tag = '';
                  $data = User::find()->where(['id'=>$model->engineer_id])->one();
                  $fcm_id = 'p';
                  //die('test');
                  //$fcm_id = $data->fcm_registered_id;
          if(Fcm::send_gcm_notify($fcm_id, $message, $img_url, $tag, $user_id)){
                                  // die('test');
                 Yii::$app->session->setFlash('success', "Service Job created");
                                 //die($model->id);
                 return $this->redirect(['view', 'id' => $model->id]);
                                 //return $this->redirect(['servicejob/index']);
                          //       return Yii::$app->getResponse()->redirect(['view', 'id'=>$model->id]);
                                //   die('going in view pass return->$thisview');
                              }
    }

    public function actionFetchComplaints(){
      $test = new Servicejob();
      $out = [];
      if (isset($_POST['depdrop_parents'])) {
          $parents = $_POST['depdrop_parents'];
          if ($parents != null) {
              $cat_id = $parents[0];
            //  $list = $test->getSubCatList($cat_id);
              $list = ServicejobComplaintFault::find()->where(['servicejob_category_id'=>$cat_id])->select(['id','complaint'])->asArray()->all();
              foreach ($list as $i => $part) {
                $out[] = ['id' => $part['id'], 'name' => $part['complaint']];
              }
              echo Json::encode(['output'=>$out, 'selected'=>'']);

              return;
          }
      }
        echo Json::encode(['output'=>'', 'selected'=>'']);
      }

      public function actionGetComplaints(){
          $category_id = isset($_POST['category_id']) ? $_POST['category_id'] : 0;
          $data['categories'] = ServicejobComplaintFault::find()->where(['active'=> 1, 'servicejob_category_id'=> $category_id])->asArray()->all();
          echo json_encode(array('message'=> 'Success', 'code'=> 200, 'data'=> $data));
      }


    /*  public function actionGetActions(){
          $category_id = isset($_POST['category_id']) ? $_POST['category_id'] : 0;
          $data['categories'] = ServicejobActionServiceRepair::find()->where(['active'=> 1, 'servicejob_category_id'=> $category_id])->asArray()->all();

          echo json_encode(array('message'=> 'Success', 'code'=> 200, 'data'=> $data));
      }*/


    /**
     * Deletes an existing Servicejob model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */

     public function actionGetAddress($id){
        $data = Customer::find()->where(['id'=>$id])->one();
        echo $data->address;
    }

    public function actionDownloadImage($upload_name){
      $path = Yii::getAlias('@roots');
      //$path2 = Yii::getAlias('@api-image');
       $path2 = Yii::getAlias('@api-main');
      $path3 = $path.$path2.'/'.$upload_name;

      if (file_exists($path3) ) {
          $this->downloads($path3,$upload_name);
      }else{
        die('image does not exist');
      }

    }

    public function actionDownloadAudio($recording_name){

      $path = Yii::getAlias('@roots');
    //  $path2 = Yii::getAlias('@api-audio');
     $path2 = Yii::getAlias('@api-main');
      $path3 = $path.$path2.'/'.$recording_name;

      if (file_exists($path3) ) {
          $this->downloads($path3,$recording_name);
      }else{
        die('audio does not exist');
      }
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->active = self::STATUS_INACTIVE;
        //$model->service_no.='-D';
        if($model->update()){
          //  Yii::$app->session->setFlash('success', 'Service no: '. $id . ' has beend inactive');
           Yii::$app->session->setFlash('success', "Service Job deleted");
        }else{
           Yii::$app->session->setFlash('danger', 'Failed to delete!');
        }
        return $this->redirect(['index']);
    }



    /**
     * Finds the Servicejob model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Servicejob the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */

    protected function findModel($id)
    {
        if (($model = Servicejob::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

    }

    protected function downloads($path3,$upload_name){
      header('Content-Description: file Transfer');
      header('Content-Type: application/octet-stream');
      header('Content-Disposition: attachment; filename=' .($upload_name));
      header('Content-Transfer-Encoding: binary');
      header('Expires: 0');
      header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
      header('Pragma: public');
      header('Content-Length: ' . filesize($path3));
      ob_clean();
      flush();
      readfile($path3);
    }

    protected function composeEmail($model,$attach){
        $cust = Customer::find()->where(['id'=>$model->customer_id])->one();
        $eng = User::find()->where(['id'=>$model->engineer_id])->one();
        $message = "<p>Hi, {$cust->person_in_charge},</p>";
        $message .= '<p>Please find attached file.</p>';
        $message .= '<p>Thank you.</p>';
    //    $testcc = 'jasonchong@firstcom.com.sg';
  //      $testcc = 'eumerjoseph.ramos@yahoo.com';
        Yii::$app->mailer->compose()
        ->setTo($cust->email)
        ->setFrom([$eng->email => $eng->fullname])
  //      ->setCc($testcc) //temp
        ->setSubject('Service Job')
        ->setHtmlBody($message)
        ->setReplyTo([$eng->email])
        ->attachContent($attach,['fileName'=>$model->service_no.'.pdf','contentType' => 'application/pdf'])
        ->send();
    }

    protected function send($reg_id, $message, $img_url, $tag, $user_id,$id){
      define("GOOGLE_API_KEY", "AIzaSyAxewEiK97rX2fGNZ-USeIxWujL628u017Y"); // Techelm Mobile, ask richard for correct api key
      define("GOOGLE_GCM_URL", "https://fcm.googleapis.com/fcm/send");

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
          'Authorization: key=' . GOOGLE_API_KEY,
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
