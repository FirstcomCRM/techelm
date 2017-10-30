<?php

namespace backend\controllers;

use Yii;
use mPDF;
use common\models\ProjectjobSiteInspection;
use common\models\ProjectjobSiteInspectionSearch;
use common\models\ProjectjobIpiTasks;
use common\models\ProjectjobIpiCorrectiveActions;
use common\models\Company;
use common\models\UserGroup;
use common\models\UserPermission;
use common\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
/**
 * ProjectjobSiteInspectionController implements the CRUD actions for ProjectjobSiteInspection model.
 */
class ProjectjobSiteInspectionController extends Controller
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
     * Lists all ProjectjobSiteInspection models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProjectjobSiteInspectionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProjectjobSiteInspection model.
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
     * Creates a new ProjectjobSiteInspection model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProjectjobSiteInspection();
        $model->date_inspection = date('Y-m-d');
        if ($model->load(Yii::$app->request->post()) && $model->validate() ) {
            $model->date_created = date('Y-m-d H:s:i');
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ProjectjobSiteInspection model.
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
     * Deletes an existing ProjectjobSiteInspection model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionInspectionPdf($id){
  //    die('inspection');
  //  $this->layout = 'mobile-layout';
      $model = $this->findModel($id);
      $company = Company::find()->one();
    //  $pissTask = ProjectjobIpiTasks::find()->where(['projectjob_id'=>$model->project_ref, 'form_type'=>$model->field_type])->all();
    //  $correct = ProjectjobIpiCorrectiveActions::find()->where(['projectjob_id'=>$model->project_ref, 'form_type'=>$model->field_type])->all();
      $mpdf = new mPDF('utf-8');
      $mpdf->content = $this->renderPartial('inspection-pdf',[
        'model'=>$model,
        'company'=>$company,
      //  'pissTask'=>$pissTask,
    //    'correct'=>$correct,
      ]);
      $mpdf->setFooter('{PAGENO}');
      $mpdf->WriteHTML($mpdf->content);
      $mpdf->Output($model->id.'.pdf','I');
      exit;
    }

    /**
     * Finds the ProjectjobSiteInspection model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProjectjobSiteInspection the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProjectjobSiteInspection::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}