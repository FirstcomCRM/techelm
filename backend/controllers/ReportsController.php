<?php

namespace backend\controllers;

use Yii;
use mPDF;
use common\models\Company;
use common\models\CompanySearch;
use common\models\Reports;
use common\models\User;
use common\models\UserPermission;
use common\models\UserGroup;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
/**
 * CompanyController implements the CRUD actions for Company model.
 */
class ReportsController extends Controller
{
    /**
     * @inheritdoc
     */


    public function behaviors()
    {
      $userGroupArray = ArrayHelper::map(UserGroup::find()->all(), 'id', 'name');

      foreach ( $userGroupArray as $uGId => $uGName ){
          $permission = UserPermission::find()->where(['controller' => 'Reports'])->andWhere(['user_group_id' => $uGId ] )->all();
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
    *Report A - Handles the servicejob header only.
    */
    public function actionReportA()
    {
        $searchModel = new Reports();
      //  $dataProvider = $searchModel->report_a(Yii::$app->request->queryParams);
        $dataProvider = $searchModel->report_a(Yii::$app->request->post());
        $x = 'hide';

        $session = Yii::$app->session;
        if (!$session->isActive) {
           $session->open();
        }
        $session['report-a'] = Yii::$app->request->post();

        if (Yii::$app->request->post() ) {
          $x = 'show';
        }

        return $this->render('a-report', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'x'=>$x,
        ]);
    }

    public function actionPdfA(){
      $searchModel = new Reports();

      $dataProvider = $searchModel->report_a(Yii::$app->session->get('report-a'));
      $path = Yii::getAlias('@vendor/bower/bootstrap/dist/css/bootstrap.css');
      $pathtest = Yii::getAlias('@webroot/css/reports.css');

      ini_set('max_execution_time', 180);
      ini_set("memory_limit", "512M");

      $mpdf = new mPDF('utf-8','A4-L');
      $mpdf->content = $this->renderPartial('a-pdf',[
        'searchModel'=>$searchModel,
        'dataProvider' => $dataProvider,
      ]);

    //  $mpdf->simpleTables = true;
      $mpdf->packTableData = true;
      $mpdf->useSubstitutions=false;

      $mpdf->setFooter('{PAGENO}');
      $stylesheet1 = file_get_contents($pathtest);
      $stylesheet = file_get_contents($path);
      $mpdf->writeHTML($stylesheet,1);
      $mpdf->writeHTML($stylesheet1,1);
      $mpdf->writeHTML($mpdf->content);

      $mpdf->Output('Report-A.pdf','I');
      exit;

    }

    /**
    *Report B - Handles the servicejob header and servicejob_mobile_complaint via inner join
    */
    public function actionReportB()
    {
        $searchModel = new Reports();
      //  $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider = $searchModel->report_b(Yii::$app->request->post());
        $x = 'hide';

        $session = Yii::$app->session;
        if (!$session->isActive) {
           $session->open();
        }
        $session['report-b'] = Yii::$app->request->post();


        if (Yii::$app->request->post() ) {
          $x = 'show';
        }

        //echo '<pre>';
        //print_r($dataProvider);
        //echo '</pre>';
      //  die();
        return $this->render('b-report_bak1', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'x'=>$x,
        ]);
    }

    public function actionPdfB(){
      $searchModel = new Reports();

      $dataProvider = $searchModel->report_b(Yii::$app->session->get('report-b'));
      $path = Yii::getAlias('@vendor/bower/bootstrap/dist/css/bootstrap.css');
      $pathtest = Yii::getAlias('@webroot/css/reports.css');

      ini_set('max_execution_time', 180);
      ini_set("memory_limit", "512M");

      $mpdf = new mPDF('utf-8','A4-L');
      $mpdf->content = $this->renderPartial('b-pdf_bak1',[
        'searchModel'=>$searchModel,
        'dataProvider' => $dataProvider,
      ]);

    //  $mpdf->simpleTables = true;
      $mpdf->packTableData = true;
      $mpdf->useSubstitutions=false;

      $mpdf->setFooter('{PAGENO}');
      $stylesheet1 = file_get_contents($pathtest);
      $stylesheet = file_get_contents($path);
      $mpdf->writeHTML($stylesheet,1);
      $mpdf->writeHTML($stylesheet1,1);
      $mpdf->writeHTML($mpdf->content);
      $mpdf->Output('Report-B.pdf','I');

      exit;
    }

    /**
    *Report C - Handles the servicejob header and servicejob_mobile_complaint via inner join
    * And probably the servicejob_cm_asr
    */
    public function actionReportC()
    {
        $searchModel = new Reports();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $session = Yii::$app->session;
        if (!$session->isActive) {
           $session->open();
        }
        $session['report-b'] = Yii::$app->request->post();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
    *Report D - Handles the servicejob header and service_parts via inner join
    */
    public function actionReportD()
    {
        $searchModel =  new Reports();
      //  $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider = $searchModel->report_d(Yii::$app->request->post());
        $x = 'hide';

        if (Yii::$app->request->post() ) {
          $x = 'show';
        }

        $session = Yii::$app->session;
              if (!$session->isActive) {
               $session->open();
            }
        $session['report-d'] = Yii::$app->request->post();

        return $this->render('d-report', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'x'=>$x,
        ]);
    }

    public function actionPdfD(){
      $searchModel = new Reports();

      $dataProvider = $searchModel->report_d(Yii::$app->session->get('report-d'));
      $path = Yii::getAlias('@vendor/bower/bootstrap/dist/css/bootstrap.css');
      $pathtest = Yii::getAlias('@webroot/css/reports.css');

      ini_set('max_execution_time', 180);
      ini_set("memory_limit", "512M");

      $mpdf = new mPDF('utf-8','A3');
      $mpdf->content = $this->renderPartial('d-pdf',[
        'searchModel'=>$searchModel,
        'dataProvider' => $dataProvider,
      ]);

    //  $mpdf->simpleTables = true;
      $mpdf->packTableData = true;
      $mpdf->useSubstitutions=false;

      $mpdf->setFooter('{PAGENO}');
      $stylesheet1 = file_get_contents($pathtest);
      $stylesheet = file_get_contents($path);
      $mpdf->writeHTML($stylesheet,1);
      $mpdf->writeHTML($stylesheet1,1);
      $mpdf->writeHTML($mpdf->content);

      $mpdf->Output('Report-D.pdf','I');
      exit;
    }

    protected function findModel($id)
    {
        if (($model = Company::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
