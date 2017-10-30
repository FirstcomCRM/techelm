<?php



namespace frontend\controllers;



use Yii;
use mPDF;
use common\models\Servicejob;
use common\models\SearchServicejob;
use common\models\UserGroup;
use common\models\UserPermission;
use common\models\User;
use common\models\ServicejobComplaintFault;
use common\models\ServicejobActionServiceRepair;
use common\models\ServicejobComplaintMobile;
use common\models\ServicejobCmCf;
use common\models\ServicejobCmAsr;
use common\models\Model;
use common\models\base30;
use common\models\ConvertPng;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
//use yii\base\Model;

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
     *Lists all Servicejob models.
     *return mixed
     */

    public function actionIndex()
    {
        $searchModel = new SearchServicejob();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /*
     * Displays a single Servicejob model.
     * @param integer $id
     * @return mixed
     */

    public function actionView($id)
    {
        $model= $this->findModel($id);
        if (!empty($model->signature_web)) {
          $base = new ConvertPng();
          $test = $base->base30_to_jpeg($model->signature_web, 'signature.png');
          $model->signature_web = $test;
        }

        $modelComplaints = ServicejobComplaintMobile::find()->where(['servicejob_id' => $id])->all();
        return $this->render('view', [
            'model' => $model,
            'modelComplaints'=>$modelComplaints,

        ]);

    }

    public function actionSign($id){
      $model = $this->findModel($id);
      $modelComplaints = ServicejobComplaintMobile::find()->where(['servicejob_id' => $id])->all();

      if ($model->load(Yii::$app->request->post() )&& $model->save()  ) {
          $base = new ConvertPng();
          $test = $base->base30_to_jpeg($model->signature_web, 'signature.png');
          $model->signature_web = $test;
          Yii::$app->session->setFlash('success', "Signature Added");
          return $this->render('view', [
            'model' => $model,
            'modelComplaints'=>$modelComplaints,
        ]);
      }
      return $this->render('sign',[
          'model'=>$model,
      ]);
    }



    public function actionPdf($id){
      $model = $this->findModel($id);
      $modelComplaints = ServicejobComplaintMobile::find()->where(['active'=>1, 'servicejob_id'=> $id])->all();
      $mpdf = new mPDF('utf-8');
      $mpdf->content = $this->renderPartial('pdf',[
          'model'=>$model,
          'modelComplaints'=>$modelComplaints,
      ]);
      $mpdf->setFooter('{PAGENO}');
    //  $mpdf->setHeader($model->service_no.'| |{DATE Y-m-d}');
      $mpdf->WriteHTML($mpdf->content);
      $mpdf->Output($model->service_no.'.pdf','I');
      exit;

    }


    protected function findModel($id)

    {

        if (($model = Servicejob::findOne($id)) !== null) {

            return $model;

        } else {

            throw new NotFoundHttpException('The requested page does not exist.');

        }

    }

}
